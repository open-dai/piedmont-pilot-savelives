#import "LocationHelper.h"

@implementation LocationHelper

@synthesize locationManager,delegate,currentLocation;

- (id) init {
    self = [super init];
    if (self != nil) {
        BOOL locationServiceEnabled;
        locationServiceEnabled=[CLLocationManager locationServicesEnabled];
        
        if (!locationServiceEnabled) return Nil;
        self.locationManager = [[[CLLocationManager alloc] init] autorelease];
        self.locationManager.delegate = self; // send loc updates to myself
    }
    return self;
}

- (void) startAcquireLocation{
    startedAt=[[NSDate alloc]init];
    [self.locationManager startUpdatingLocation];
}

- (void) stopAcquireLocation{
    [self.locationManager stopUpdatingLocation];
}

- (void)locationManager:(CLLocationManager *)manager
    didUpdateToLocation:(CLLocation *)newLocation
           fromLocation:(CLLocation *)oldLocation
{
    
    if ([LocationHelper isBetterLocation:self.currentLocation:newLocation]){
        if (currentLocation!=Nil) [currentLocation release];
        currentLocation=newLocation;
        [currentLocation retain];
        
        NSLog(@"Location: %@", [newLocation description]);
        
        [self.delegate locationUpdate:newLocation];
        
        if (newLocation.horizontalAccuracy<50){
            [self stopAcquireLocation];
        }
    }
    if(fabs([startedAt timeIntervalSinceNow])>60) {
        [self stopAcquireLocation];
    }
    
}

- (void)locationManager:(CLLocationManager *)manager
       didFailWithError:(NSError *)error
{
	NSLog(@"Error: %@", [error description]);
    [self.delegate locationError:error];
} 

- (void)dealloc {
    [super dealloc];
}

+ (BOOL) isBetterLocation:(CLLocation *)oldLocation:(CLLocation *) newLocation{
    BOOL res=false;
    @try {
        if (oldLocation==0){
            res=true;
        }
        else
        {
            res=oldLocation.horizontalAccuracy+newLocation.horizontalAccuracy;
            
        }
    }
    @catch (NSException *exception) {
        NSLog(@"ex %@",exception);
    }
    @finally {
    }
    
    return res;
}
@end
