package csi.regola.saveme.service;

import org.json.JSONObject;

import android.location.Location;
import android.util.Log;
import csi.regola.saveme.helper.HttpClientHelper;
import csi.regola.saveme.helper.SaveMeSettings;

public class SaveMeClient {

	public static final String APP_TAG = "SaveMe";

	public CallData CreateCall(String phoneNumber, String deviceID,
			String GsmCellID) {
		String url = String.format("/%s/%s/%s/CreateCall", phoneNumber,
				deviceID, GsmCellID);
		url = SaveMeSettings.SaveMeSeviceURL + url.replace("//", "/unknown/");
		JSONObject response = null;
		CallData res = null;
		try {
			String s = HttpClientHelper.GetURL(url);
			response = new JSONObject(s);
			res = new CallData();
			res.rowID = response.getString("rowID");
			res.callID = response.getString("callID");
		} catch (Exception e) {
			Log.e("CreateCall " + url, e.toString());
		}
		return res;
	}

	public boolean UpdateCall(String rowID,String phoneNumber, String deviceID,
			String GsmCellID) {
		boolean res = false;

		String url = String.format("/%s/%s/%s/%s/UpdateCallData",rowID, phoneNumber,
				deviceID, GsmCellID);
		url =  SaveMeSettings.SaveMeSeviceURL + url.replace("//", "/unknown/");
		try {
			String response = HttpClientHelper.GetURL(url);
			res = response == "True";
		} catch (Exception e) {
			Log.e("UpdateCall " + url, e.toString());
		}
		return res;
	}

	public boolean SetCallPosition(String rowID, Location location) {
		boolean res=false;
		try {
			String url = String.format("/%s/%s/%s/%s/%s/%s/%s/SetCallPosition",
					rowID, location.getProvider(), location.getAccuracy(),
					location.getBearing(), location.getAltitude(),
					location.getLatitude(), location.getLongitude());
			url =  SaveMeSettings.SaveMeSeviceURL + url.replace("//", "/unknown/");
			try {
				String response = HttpClientHelper.GetURL(url);
				res= response == "True";
			} catch (Exception e) {
				Log.e("SetCallPosition" + url, e.toString());
			}

		} catch (Exception e) {
			// TODO: handle exception
		}
		return res;
	}

	public class CallData {
		public String rowID;
		public String callID;
	}
}
