package csi.regola.saveme.service;

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

import csi.regola.saveme.activities.MainActivity;
import csi.regola.saveme.helper.CsiResult;
import csi.regola.saveme.helper.MacroConfiguration;
import csi.regola.saveme.helper.SaveMeSettings;

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
