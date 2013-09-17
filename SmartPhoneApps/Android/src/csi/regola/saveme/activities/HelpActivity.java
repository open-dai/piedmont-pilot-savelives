package csi.regola.saveme.activities;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.Window;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.CompoundButton.OnCheckedChangeListener;
import csi.regola.saveme.R;

public class HelpActivity extends Activity {
	SharedPreferences mSharedPreferences ;
	
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		
		final boolean customTitleSupported = requestWindowFeature(Window.FEATURE_CUSTOM_TITLE);

		setContentView(R.layout.activity_help);
		if (customTitleSupported) {
            getWindow().setFeatureInt(Window.FEATURE_CUSTOM_TITLE,
                    R.layout.custom_titlebar);}

		
		mSharedPreferences = PreferenceManager
				.getDefaultSharedPreferences(HelpActivity.this);
		
		CheckBox cbxShowHelp=(CheckBox) findViewById(R.id.showHelp);
		cbxShowHelp.setChecked(!mSharedPreferences.getBoolean("ShowHelp", true));
		
		cbxShowHelp.setOnCheckedChangeListener(new OnCheckedChangeListener() {

					@Override
					public void onCheckedChanged(CompoundButton buttonView,
							boolean isChecked) {
						
						Editor edit=mSharedPreferences.edit();
						edit.putBoolean("ShowHelp", !isChecked);
						edit.commit();
					}
				});
		
		((Button)findViewById(R.id.close)).setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				Intent intent = new Intent(HelpActivity.this, MainActivity.class);
				intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
				startActivity(intent);
				finish();
			}
		});
	}
}
