#import "SaveMeClient.h"
#import "HttpClient.h"

//http://code.google.com/p/json-framework/downloads/detail?name=JSON_2.3.dmg&can=1&q=
#import "JSON.h"
#import <CoreLocation/CoreLocation.h>

@implementation SaveMeClient
@synthesize delegate;


- (void) createCall:(NSString *)phoneNumber uid:(NSString *)uid delegate:(id)delegate onDataReceived:(SEL)onDataReceived {
	HttpClient *httpClient=[HttpClient new];
    phoneNumber=[phoneNumber stringByReplacingOccurrencesOfString:@"+" withString:@""];
    NSString *parameters=[NSString stringWithFormat:@"/%@/%@/unknown/CreateCall",phoneNumber,uid];
    parameters=[parameters stringByReplacingOccurrencesOfString:@"//" withString:@"/unknown/"];
    NSString *url=[[[NSString alloc] initWithString:@"http://saveme.regola.it/ClientDataService.svc"] stringByAppendingString:parameters];
    
	[httpClient getUrl:url delegate:self 
		 successMethod:@selector(setCallData:) errorMethod:@selector(onError)];
}

- (void) updateCall:(NSString *) rowID phoneNumber:(NSString *)phoneNumber uid:(NSString *)uid
{
	HttpClient *httpClient=[HttpClient new];
    
    phoneNumber=[phoneNumber stringByReplacingOccurrencesOfString:@"+" withString:@""];
    
    NSString *parameters=[NSString stringWithFormat:@"/%@/%@/%@/unknown/UpdateCallData",rowID,phoneNumber,uid];
    parameters=[parameters stringByReplacingOccurrencesOfString:@"//" withString:@"/unknown/"];
    NSString *url=[@"http://saveme.regola.it/ClientDataService.svc" stringByAppendingString:parameters];
    
	[httpClient getUrl:url delegate:nil
		 successMethod:nil errorMethod:nil];
}

- (void) setCallPosition:(NSString *)rowID location:(CLLocation *)location{
	@try {
        HttpClient *httpClient=[HttpClient new];
        NSString *parameters=[NSString stringWithFormat:@"/%@/gps/%f/%f/%f/%f/%f/SetCallPosition",rowID,location.horizontalAccuracy,location.course,location.altitude,location.coordinate.latitude,location.coordinate.longitude];
        parameters=[parameters stringByReplacingOccurrencesOfString:@"//" withString:@"/unknown/"];
        NSString *url=[[[NSString alloc] initWithString:@"http://saveme.regola.it/ClientDataService.svc"] stringByAppendingString:parameters];
        
        
        NSLog(@"\n\n%@\n",url);
        
        [httpClient getUrl:url delegate:nil
             successMethod:nil errorMethod:@selector(onError)];	
    }
    @catch (NSException *exception) {
        NSLog(@"Exception %@",exception);
    }
    @finally {
    }
}

- (void) setCallData:(NSString *)value{
	@try {
        NSDictionary *jsonObj=[value JSONValue];
        
        [self.delegate onCallDataReceived:[[NSString alloc] initWithString:[jsonObj valueForKey:@"callID"]] rowID:[[NSString alloc] initWithString:[jsonObj valueForKey:@"rowID"]]];    }
    @catch (NSException *exception) {
        NSLog(@"setCallData EXCEPTION: %@",exception);
    }
    @finally { }
    
}

- (void) onError:(NSString *) error{
    NSLog(@"HTTP Error:\n%@",error);
}

@end
