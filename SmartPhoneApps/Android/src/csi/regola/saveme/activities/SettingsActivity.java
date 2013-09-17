package csi.regola.saveme.activities;

import android.content.SharedPreferences;
import android.content.SharedPreferences.OnSharedPreferenceChangeListener;
import android.content.pm.PackageInfo;
import android.os.Bundle;
import android.preference.Preference;
import android.preference.PreferenceActivity;
import android.preference.PreferenceScreen;
import csi.regola.saveme.R;

public class SettingsActivity extends PreferenceActivity implements OnSharedPreferenceChangeListener 
{
	PreferenceScreen preferenceScreen;
	SharedPreferences sharedPreferences;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		addPreferencesFromResource(R.xml.app_settings);

		preferenceScreen= getPreferenceScreen();
		sharedPreferences = preferenceScreen .getSharedPreferences();
		for (int i = 0; i < preferenceScreen.getPreferenceCount(); i++) {
			AddSummary(sharedPreferences, preferenceScreen .getPreference(i).getKey());
		}

		findPreference("VersionText").setSummary(getVersion());

		//preferenceScreen.removePreference(findPreference("ShowHelp"));
		setContentView(R.layout.activity_settings);
	}

	private String getVersion() {
		try{
			PackageInfo pInfo = getPackageManager().getPackageInfo(getPackageName(), 0);
			return pInfo.versionName;
		}catch(Exception x) {}
		return "non specificata";
	}

	@Override
	protected void onResume() {
		super.onResume();
		sharedPreferences.registerOnSharedPreferenceChangeListener(this);
	}

	@Override
	protected void onPause() {
		super.onPause();
		sharedPreferences.unregisterOnSharedPreferenceChangeListener(this);
	}

	private void AddSummary(SharedPreferences sharedPreferences, String key) 
	{
		Preference item = preferenceScreen.findPreference(key);
		if (item.getClass().getName() .equalsIgnoreCase("android.preference.edittextpreference")) {
			String value = sharedPreferences.getString(key, "non impostato");
			item.setSummary(value);
		}
	}

	@Override
	public void onSharedPreferenceChanged(SharedPreferences sharedPreferences, String key) {
		AddSummary(sharedPreferences, key);
	}
}
