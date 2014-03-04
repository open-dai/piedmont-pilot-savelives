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
package csi.opendai.saveme.activities;

import android.content.SharedPreferences;
import android.content.SharedPreferences.OnSharedPreferenceChangeListener;
import android.content.pm.PackageInfo;
import android.os.Bundle;
import android.preference.Preference;
import android.preference.PreferenceActivity;
import android.preference.PreferenceScreen;
import csi.opendai.saveme.R;

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
