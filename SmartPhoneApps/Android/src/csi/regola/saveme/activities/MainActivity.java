package csi.regola.saveme.activities;

import java.util.Date;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.location.Location;
import android.location.LocationListener;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.provider.Settings.Secure;
import android.telephony.TelephonyManager;
import android.telephony.gsm.GsmCellLocation;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.view.animation.AlphaAnimation;
import android.view.animation.Animation;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;
import csi.regola.saveme.R;
import csi.regola.saveme.helper.LocationHelper;
import csi.regola.saveme.helper.MacroConfiguration;
import csi.regola.saveme.helper.PhoneHelper;
import csi.regola.saveme.service.CSIClient;
import csi.regola.saveme.service.SaveMeClient;
import csi.regola.saveme.service.SaveMeClient.CallData;

public class MainActivity extends Activity {
	private Location lastPosition;
	private TextView mTxtLocation;
	private SharedPreferences mSharedPreferences;
	private long mT1;
	private CallData callData;
	private TextView testModeMessage;

	protected void toast(String message) {
		toast(message, 1);
	}

	protected void toast(String message, int times) {
		Toast.makeText(this, message, Toast.LENGTH_LONG).show();
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		final boolean customTitleSupported = requestWindowFeature(Window.FEATURE_CUSTOM_TITLE);
		setContentView(R.layout.activity_main);

		mSharedPreferences = PreferenceManager
				.getDefaultSharedPreferences(MainActivity.this);
		Bundle b = getIntent().getExtras();
		if (b != null && b.getBoolean("AfterSplashScreen", false)
				&& mSharedPreferences.getBoolean("ShowHelp", true)) {
			Intent intent = new Intent(MainActivity.this, HelpActivity.class);
			startActivity(intent);
			finish();
		}

		if (customTitleSupported)
			getWindow().setFeatureInt(Window.FEATURE_CUSTOM_TITLE,
					R.layout.custom_titlebar);

		testModeMessage = (TextView) findViewById(R.id.testModeMessageId);
		blink(testModeMessage);

		mTxtLocation = (TextView) findViewById(R.id.txtLocation);

		// Invio della prima chiamata
		Handler handler = new Handler();
		handler.post(new Runnable() {
			@Override
			public void run() {
				initCall();
			}
		});

		((Button) findViewById(R.id.button1))
				.setOnClickListener(new OnClickListener() {
					@Override
					public void onClick(View v) {
						macro(Macros.Emergency118);
					}
				});

		int[] macroIds = new int[] { R.id.button2, R.id.button3, R.id.button4 };
		int macroOffset = 1;
		for (int id : macroIds) {
			//
			Button btn = (Button) findViewById(id);
			btn.setTag(macroOffset++);

			//
			btn.setOnClickListener(new OnClickListener() {
				@Override
				public void onClick(View v) {
					macro(Macros.values()[(Integer) v.getTag()]);
				}
			});
		}
	}

	private void blink(TextView t) {
		AlphaAnimation anim = new AlphaAnimation(0.0f, 1.0f);
		anim.setDuration(2200);
		anim.setStartOffset(20);
		anim.setRepeatMode(Animation.REVERSE);
		anim.setRepeatCount(Animation.INFINITE);
		t.startAnimation(anim);
	}

	private boolean isTestModeEnabled() {
		return mSharedPreferences.getBoolean("TestMode", false);
	}

	private void macro(Macros m) {

		String userID = getUserId();
		if (userID.length() == 0) {
			showDialog(4);
		} else {
			MacroConfiguration conf = new MacroConfiguration(userID,
					isTestModeEnabled());
			switch (m) {
			case Emergency118: {
				conf.Level = 1;

				if (isTestModeEnabled())
					toast(getResources().getString(R.string.testModeEnabled));
				else if (PhoneHelper.canCall(MainActivity.this))
					PhoneHelper.placeCall(MainActivity.this, "118", "");
				else
					toast(getResources().getString(R.string.cannot_place_call));
			}
				break;

			case Macro1:
				conf.Level = 2;
				conf.IsOnBehalf = false;
				break;
			case Macro2:
				conf.Level = 3;
				conf.IsOnBehalf = false;
				break;
			case Macro3:
				conf.Level = 4;
				conf.IsOnBehalf = true;
				break;

			default:
				toast("Macro " + m.ordinal() + " in elaborazione..");
				break;
			}

			// Invio della Macro al CSI
			mT1 = new Date().getTime();
			showDialog(2);
			new CSICommTask().execute(conf);
		}
	}

	private String getUserId() {
		return mSharedPreferences.getString("CSI_ID", "");
	}

	@Override
	protected Dialog onCreateDialog(int id) {
		Dialog res = null;
		AlertDialog.Builder builder;
		switch (id) {
		case 2:
			builder = new AlertDialog.Builder(this);
			builder.setTitle(getResources().getString(R.string.loading))
					.setMessage(
							getResources().getString(
									R.string.loading_in_progress))
					.setCancelable(false);
			res = builder.create();
			break;
		case 3:
			// Alert la chiamata non Ž gestita
			builder = new AlertDialog.Builder(this);
			builder.setTitle(getResources().getString(R.string.attenzione))
					.setMessage(
							getResources().getString(
									R.string.csiErrorCommunication))
					.setCancelable(false)
					.setNeutralButton(R.string.ok,
							new DialogInterface.OnClickListener() {

								@Override
								public void onClick(DialogInterface dialog,
										int which) {
									dismissDialog(3);
								}
							});
			res = builder.create();
			break;
		case 4:
			builder = new AlertDialog.Builder(this);
			builder.setTitle(getResources().getString(R.string.attenzione))
					.setMessage(getResources().getString(R.string.userIdNotSet))
					.setCancelable(false)
					.setNegativeButton(R.string.cancel,
							new DialogInterface.OnClickListener() {

								@Override
								public void onClick(DialogInterface dialog,
										int which) {
									dismissDialog(4);
								}
							})
					.setPositiveButton(R.string.ok,
							new DialogInterface.OnClickListener() {

								@Override
								public void onClick(DialogInterface dialog,
										int which) {
									Intent intent = new Intent(MainActivity.this, SettingsActivity.class);
									startActivity(intent);
								}
							});
			res = builder.create();
			break;
		default:
			res = null;
			break;
		}

		return res;
	}

	enum Macros {
		Emergency118, Macro1, Macro2, Macro3
	};

	class CSICommTask extends AsyncTask<MacroConfiguration, Void, Boolean> {

		@Override
		protected Boolean doInBackground(MacroConfiguration... params) {
			MacroConfiguration macro = (MacroConfiguration) params[0];
			boolean res = new CSIClient().send(macro, lastPosition);

			// Sleep
			long mT2 = new Date().getTime();
			long timeout = 3000;
			long diff = mT2 - mT1;
			if (diff < timeout) {
				try {
					Thread.sleep(timeout - diff);
				} catch (InterruptedException e) {
					e.printStackTrace();
				}
			}
			return res;
		}

		@Override
		protected void onPostExecute(Boolean result) {
			dismissDialog(2);
			if (!result) {
				showDialog(3);
			}

		}
	}

	@Override
	protected void onResume() {
		super.onResume();

		LocationHelper location = new LocationHelper();
		location.startAcquireLocation(this, locationListener);

		Log.d(SaveMeClient.APP_TAG, "onResume() "
				+ (isTestModeEnabled() ? "TRUE" : "FALSE"));
		show(testModeMessage, isTestModeEnabled());
		if (!isTestModeEnabled()) {
			testModeMessage.clearAnimation();
		}
	}

	private void initCall() {
		TelephonyManager telephonyManager = (TelephonyManager) this
				.getSystemService(Context.TELEPHONY_SERVICE);

		String cellID = "";
		String deviceID = "";
		try {
			deviceID = Secure.getString(this.getContentResolver(),
					Secure.ANDROID_ID);
			cellID = Integer.toString(((GsmCellLocation) telephonyManager
					.getCellLocation()).getCid());
		} catch (Exception e) {
		}

		callData = new SaveMeClient().CreateCall(
				mSharedPreferences.getString("PhoneNumber", "undefined"),
				deviceID, cellID);
	}

	LocationListener locationListener = new LocationListener() {

		@Override
		public void onStatusChanged(String provider, int status, Bundle extras) {
		}

		@Override
		public void onProviderEnabled(String provider) {
		}

		@Override
		public void onProviderDisabled(String provider) {
			mTxtLocation.setText(getResources().getString(
					R.string.location_unavailable));
		}

		@Override
		public void onLocationChanged(Location location) {
			MainActivity.this.lastPosition = location;
			mTxtLocation.setText(String.format("Pos %.6fN / %.6fE",
					location.getLatitude(), location.getLongitude()));

			if (null != callData)
				new SaveMeClient().SetCallPosition(callData.rowID, location);
		}
	};

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_main, menu);
		return true;
	}

	@Override
	public boolean onMenuItemSelected(int featureId, MenuItem item) {
		Class nextActivity = null;
		switch (item.getItemId()) {
		case R.id.menu_settings:
			nextActivity = SettingsActivity.class;
			break;
		case R.id.menu_about:
			nextActivity = AboutActivity.class;
			break;
		case R.id.menu_help:
			nextActivity = HelpActivity.class;
			break;
		}

		Intent intent = new Intent(MainActivity.this, nextActivity);
		startActivity(intent);

		return super.onMenuItemSelected(featureId, item);
	}

	public static void show(View v, boolean b) {
		if (null == v)
			return;
		v.setVisibility(b ? View.VISIBLE : View.GONE);
	}
}
