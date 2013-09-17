package csi.regola.saveme.helper;

import java.io.FileOutputStream;
import java.lang.reflect.Type;
import java.util.Date;

import android.util.Log;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

public class GsonHelper {
	static String TAG=GsonHelper.class.getCanonicalName();
	static GsonBuilder gsonb;

	public static Gson getGson() {
		if (gsonb == null) {
			gsonb = new GsonBuilder();
			DateDeserializer ds = new DateDeserializer();
			gsonb.registerTypeAdapter(Date.class, ds);
		}
		return gsonb.create();
	}

	@SuppressWarnings("unchecked")
	public static <T> T fromJson(String json, Type typeOfT) {
		return (T) getGson().fromJson(json, typeOfT);
	}

	public static String toJson(Object object){
		return getGson().toJson(object);
	}
	
	public static Boolean toFile(String filename,Object object){
		try {
			FileOutputStream fos=new FileOutputStream(filename);
			String json=toJson(object);
			fos.write(json.getBytes());
			fos.flush();
			fos.close();
			return true;
		} catch (Exception e) {
			Log.e(TAG,e.toString());
			return false;
		}
	}
}
