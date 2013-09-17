#import <Foundation/Foundation.h>
#import <CoreLocation/CoreLocation.h>

#import "NSURLConnectionEx.h"
#import "MacroConfiguration.h"
#import "AppSettings.h"

#define CSI_SERVER_URL @"http://apistore.cortile.cloudlabcsi.eu/accident/v1/v2/accident.json"

@interface OpenDaiClient : NSObject
{
    id callBackDelegate;
    SEL callBackSuccessMethod;
    SEL callBackErrorMethod;
    NSMutableData *responseData;
    NSString *tag;
    
    NSURLConnectionEx* connection;
}

-(void) send: (MacroConfiguration *) configuration
    withLocation:(CLLocation*)location
    delegate:(id)delegate
     success:(SEL)onSuccessCallback
       error:(SEL)onErrorCallback;

@end
