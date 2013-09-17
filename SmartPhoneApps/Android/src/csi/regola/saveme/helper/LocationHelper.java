package csi.regola.saveme.helper;

import android.content.Context;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;
import android.util.Log;

public class LocationHelper {
	LocationManager locationManager;
	LocationListener locationListenerCallBack;
	Location currentLocation;
	Long startedAt;
	int checkPositionTimeout=50000;
	int wantedPrecision=50;

	public static String serialize(Location l) {
		String res = "";
		res += l.getProvider() + "|";
		res += l.getAccuracy() + "|";
		res += l.getAltitude() + "|";
		res += l.getBearing() + "|";
		res += l.getLatitude() + "|";
		res += l.getLongitude() + "|";
		res += l.getSpeed();
		return res;
	}

	public static Location deserialize(String s) {
		Location res=null;
		try {
			String[] attrs = s.split("\\|");
			res=new Location(attrs[0]);
			res.setAccuracy(Float.parseFloat(attrs[1]));
			res.setAltitude(Double.parseDouble(attrs[2]));
			res.setBearing(Float.parseFloat(attrs[3]));
			res.setLatitude(Double.parseDouble(attrs[4]));
			res.setLongitude(Double.parseDouble(attrs[5]));
			res.setSpeed(Float.parseFloat(attrs[5]));
		} catch (Exception e) {
			Log.e("LocationHelper.deserialize", e.toString());
		}
		return res;
	}

	public static boolean isBetterLocation(Location oldLocation, Location newLocation) {
		boolean res = false;
		if (oldLocation == null) {
			res = true;
		} else {
			res = oldLocation.getAccuracy() > newLocation.getAccuracy();
		}
		return res;
	}

	public boolean startAcquireLocation(Context context,
			LocationListener locationListenerCallBack) {
		locationManager = (LocationManager) context  .getSystemService(Context.LOCATION_SERVICE);
		if (locationManager == null)
			return false;

		this.locationListenerCallBack = locationListenerCallBack;

		locationManager.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 0, 0, locationListener);
		locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0, 0, locationListener);
		
		startedAt=System.currentTimeMillis();
		return true;
	}

	final LocationListener locationListener = new LocationListener() {
		public void onLocationChanged(Location location) {
			if (isBetterLocation(currentLocation, location)) {
				currentLocation=location;
				if (locationListenerCallBack != null) {
					locationListenerCallBack.onLocationChanged(currentLocation);
				}
				if (currentLocation.getAccuracy()<wantedPrecision) 
					locationManager.removeUpdates(locationListener);
			}
			if (System.currentTimeMillis()-startedAt>checkPositionTimeout) 
				locationManager.removeUpdates(locationListener);
		}

		public void onStatusChanged(String provider, int status, Bundle extras) {
			if (locationListenerCallBack != null) {
				locationListenerCallBack.onStatusChanged(provider, status, extras);
			}
		}

		public void onProviderEnabled(String provider) {
			if (locationListenerCallBack != null) {
				locationListenerCallBack.onProviderEnabled(provider);
			}
		}

		public void onProviderDisabled(String provider) {
			if (locationListenerCallBack != null) {
				locationListenerCallBack.onProviderDisabled(provider);
			}
		}
	};

	public void stopAcquireLocation() {
		locationManager.removeUpdates(locationListener);
	}
}
