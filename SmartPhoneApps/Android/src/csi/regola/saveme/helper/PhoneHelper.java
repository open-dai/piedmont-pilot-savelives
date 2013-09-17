package csi.regola.saveme.helper;

import android.content.Context;
import android.content.Intent;
import android.content.res.Resources.Theme;
import android.net.Uri;
import android.telephony.TelephonyManager;
import android.util.Log;
import android.widget.Toast;

public class PhoneHelper {
	static final String TAG = PhoneHelper.class.getName();

	public static String getPhoneNumber(Context context) {
		String res = "";
		try {
			TelephonyManager telephonyManager = (TelephonyManager) context
					.getSystemService(Context.TELEPHONY_SERVICE);
			res = telephonyManager.getLine1Number();
		} catch (Exception e) {
			Log.e(TAG, e.getMessage());
		}
		return res;
	}

	public static boolean canCall(Context context) {
		TelephonyManager telephonyManager = (TelephonyManager) context
				.getSystemService(Context.TELEPHONY_SERVICE);
		return telephonyManager.getSimState() == telephonyManager.SIM_STATE_READY;
	}

	public static void placeCall(Context context, String numberToCall,
			String dtmfs) {
		Intent i = new Intent(Intent.ACTION_CALL);
		i.setData(Uri.parse("tel:" + numberToCall));
		context.startActivity(i);
	}
}
