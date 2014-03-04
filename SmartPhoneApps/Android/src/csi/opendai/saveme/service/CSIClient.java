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

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Locale;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;

import android.location.Location;
import android.preference.PreferenceManager;
import android.text.TextUtils;
import android.util.Log;

import com.google.gson.Gson;

import csi.opendai.saveme.activities.MainActivity;
import csi.opendai.saveme.helper.CsiResult;
import csi.opendai.saveme.helper.MacroConfiguration;
import csi.opendai.saveme.helper.SaveMeSettings;

public class CSIClient {
	static final String TAG = CSIClient.class.getCanonicalName();

	public boolean send(MacroConfiguration macro, Location point)
	{
		boolean res = true;
		
		// Create a new HttpClient and Post Header
		HttpClient httpclient = new DefaultHttpClient();
		HttpPost httppost = new HttpPost(SaveMeSettings.CSISeviceURL);
		httppost.setHeader("Authorization", "Bearer Q7Eb8k6oUBe6O4nP10sEgzZREMMa");
		httppost.setHeader("Content-Type", "application/x-www-form-urlencoded");

		try {

			// Formattazione della data
			String format = "yyyy-MM-dd HH:mm:ss";
			SimpleDateFormat dateFormatter = new SimpleDateFormat(format, Locale.getDefault());

			// Add your data
			List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>();
			nameValuePairs.add(new BasicNameValuePair("Time", dateFormatter.format(new Date())));
			if (point != null)
			{
				nameValuePairs.add(new BasicNameValuePair("Longitude",  (""+point.getLongitude()).replace(".", ",")));
				nameValuePairs.add(new BasicNameValuePair("Latitude", (""+point.getLongitude()).replace(".", ",")));
			}
			nameValuePairs.add(new BasicNameValuePair("Level", ""+ macro.Level));
			nameValuePairs.add(new BasicNameValuePair("isTest", macro.IsTestMode?"1":"0"));
			nameValuePairs.add(new BasicNameValuePair("isOnBehalf", macro.IsOnBehalf?"1":"0"));
			nameValuePairs.add(new BasicNameValuePair("userID", macro.UserId));

			httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs));

			// Execute HTTP Post Request
			Log.d(SaveMeClient.APP_TAG, "send() in corso..");
			HttpResponse response = httpclient.execute(httppost);
			String responseString = toString(response.getEntity());
			Log.d(SaveMeClient.APP_TAG, "send() response: " + responseString);

			//
			CsiResult csiResultItem =  new Gson().fromJson(responseString, CsiResult.class);
			res = csiResultItem!=null && !TextUtils.isEmpty(csiResultItem.message) && csiResultItem.message.contains("correctly");
			if (!res)
			{
				Log.d(SaveMeClient.APP_TAG, "send() mmhh il Level non Ž gestito da CSI");
			}

		} catch (Exception e) {
			res = false;
			Log.e(SaveMeClient.APP_TAG, "send() error: ", e);
		}
		return res;
	}

	private String toString(HttpEntity e) {
		StringBuilder builder = new StringBuilder();
		try{
			BufferedReader reader = new BufferedReader(new InputStreamReader(e.getContent(), "UTF-8"));
			for (String line = null; (line = reader.readLine()) != null;) 
				builder.append(line).append("\n");
			return builder.toString();
		}catch(Exception x){}
		return " Errore parsing della risposta.";
	}
}
