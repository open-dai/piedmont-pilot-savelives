package csi.regola.saveme.helper;

import java.lang.reflect.Type;
import java.util.Date;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import com.google.gson.JsonDeserializationContext;
import com.google.gson.JsonDeserializer;
import com.google.gson.JsonElement;
import com.google.gson.JsonParseException;

public class DateDeserializer implements JsonDeserializer<Date> {
	static String TAG = DateDeserializer.class.getCanonicalName();

	public Date deserialize(JsonElement json, Type typeOfT,
			JsonDeserializationContext context) throws JsonParseException {
		Date res = null;
		String value = json.getAsJsonPrimitive().getAsString();
		try {
			res = new Date(value);
		} catch (Exception e) {
			String JSONDateToMilliseconds = "\\/(Date\\((.*?)(\\+.*)?\\))\\/";
			Pattern pattern = Pattern.compile(JSONDateToMilliseconds);
			Matcher matcher = pattern.matcher(value);
			String result = matcher.replaceAll("$2");
			res = new Date(Long.valueOf(result));
			try {
			} catch (Exception e2) {
				throw new JsonParseException("Cannot parse date field");
			}
		}
		return res;
	}
}