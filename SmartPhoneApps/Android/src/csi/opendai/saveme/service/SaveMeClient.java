/*******************************************************************************
 * Copyright (c) 2013, CSI-Piemonte
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:
 * 
 * 1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
 * 
 * 2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
 * 
 * 3. Neither the name of the copyright holder nor the names of its contributors may be used to endorse or promote products derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 ******************************************************************************/
package csi.opendai.saveme.service;

import org.json.JSONObject;

import android.location.Location;
import android.util.Log;
import csi.opendai.saveme.helper.HttpClientHelper;
import csi.opendai.saveme.helper.SaveMeSettings;

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
