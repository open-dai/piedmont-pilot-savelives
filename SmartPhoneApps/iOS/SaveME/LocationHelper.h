#import <Foundation/Foundation.h>
#import <CoreLocation/CoreLocation.h>

@protocol LocationHelperDelegate 
@required
- (void)locationUpdate:(CLLocation *)location;
- (void)locationError:(NSError *)error;
@end

@interface LocationHelper : NSObject <CLLocationManagerDelegate> {
    CLLocationManager *locationManager;
    id delegate;
    CLLocation *currentLocation;
    NSDate *startedAt;
}

@property (nonatomic, retain) CLLocationManager *locationManager;  
@property (nonatomic, retain) id  delegate;
@property (nonatomic, retain) CLLocation *currentLocation;

- (void)locationManager:(CLLocationManager *)manager
    didUpdateToLocation:(CLLocation *)newLocation
           fromLocation:(CLLocation *)oldLocation;

- (void)locationManager:(CLLocationManager *)manager
       didFailWithError:(NSError *)error;

- (void) startAcquireLocation;
- (void) stopAcquireLocation;

+ (BOOL) isBetterLocation:(CLLocation *)oldLocation:(CLLocation *) newLocation;


@end
