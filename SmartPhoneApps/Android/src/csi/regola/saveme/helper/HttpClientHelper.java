package csi.regola.saveme.helper;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URI;
import java.net.URISyntaxException;

import org.apache.http.HttpResponse;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import android.util.Log;

public class HttpClientHelper {
	
	public static String GetURL(String url) {
		String res = "";
		BufferedReader in = null;
		try {
			DefaultHttpClient client = new DefaultHttpClient();
			HttpGet request = new HttpGet();
			request.setURI(new URI(url));
			HttpResponse response = client.execute(request);
			in = new BufferedReader(new InputStreamReader(response.getEntity()
					.getContent()));
			StringBuffer sb = new StringBuffer("");
			String line = "";
			while ((line = in.readLine()) != null) {
				sb.append(line);
			}
			in.close();
			res = sb.toString();
		} catch (IOException e) {
			Log.e("IOException", e.toString());
		} catch (URISyntaxException e) {
			Log.e("URISyntaxException", e.toString());
		} finally {
			if (in != null) {
				try {
					in.close();
				} catch (IOException e) {
					Log.e("Close IOException", e.toString());
				}
			}
		}
		return res;
	}


}
