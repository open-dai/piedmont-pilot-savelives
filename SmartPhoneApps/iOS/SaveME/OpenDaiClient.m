#import "OpenDaiClient.h"

@implementation OpenDaiClient

-(void) send: (MacroConfiguration *) configuration withLocation:(CLLocation*)location     delegate:(id)delegate success:(SEL)onSuccessCallback error:(SEL)onErrorCallback;
{
    [self l:@"send()"];
    
    callBackDelegate = delegate;
    callBackSuccessMethod = onSuccessCallback;
    callBackErrorMethod = onErrorCallback;
    
    // Piggy bag
	tag = [NSString stringWithFormat:@"%f", CFAbsoluteTimeGetCurrent()];
	
	responseData = [[NSMutableData data] retain];
    
    // Date string
    NSDate *today = [NSDate date];
    NSDateFormatter *dateFormat = [[NSDateFormatter alloc] init];
    [dateFormat setDateFormat:@"yyyy-MM-dd HH:mm:ss"];
    NSString *dateString = [dateFormat stringFromDate:today];
    [dateFormat release];
    
    // Post data
    NSMutableString *post = [NSMutableString string];
    [post appendString:@"Time="];
    [post appendString:dateString];
    if (nil != location)
    {
        [post appendString:@"&Longitude="];
        [post appendString:[NSString stringWithFormat:@"%.6f", location.coordinate.longitude ]];
        [post appendString:@"&Latitude="];
        [post appendString:[NSString stringWithFormat:@"%.6f", location.coordinate.latitude ]];
    }
    [post appendString:@"&Level="];
    [post appendString:[NSString stringWithFormat:@"%d", configuration.level]];
    [post appendString:@"&isTest="];
    [post appendString:[NSString stringWithFormat:@"%@", (configuration.isTestModeEnabled ? @"1": @"0")]];
    [post appendString:@"&isOnBehalf="];
    [post appendString:[NSString stringWithFormat:@"%@", (configuration.isOnBehalf ? @"1": @"0")]];
    [post appendString:@"&userID="];
    [post appendString:configuration.userId==nil?@"-":configuration.userId];
    [self l: [NSString stringWithFormat:@"post: %@", post]];
    
    //
    NSData *postData = [post dataUsingEncoding:NSASCIIStringEncoding allowLossyConversion:YES];
    
    // Length
    NSString *postLength = [NSString stringWithFormat:@"%d", [postData length]];
    
    // Headers
	NSMutableURLRequest *request = [[NSMutableURLRequest alloc] init];
    [request setValue:@"application/x-www-form-urlencoded" forHTTPHeaderField:@"Content-Type"];
    [request addValue:@"Bearer Q7Eb8k6oUBe6O4nP10sEgzZREMMa" forHTTPHeaderField:@"Authorization"];
    [request setValue:postLength forHTTPHeaderField:@"Content-Length"];
    [request setHTTPMethod:@"POST"];
    [request setURL:[NSURL URLWithString:CSI_SERVER_URL]];
    [request setHTTPBody:postData];
    
    // Starting request
    [self closeConnection];
    connection = [[NSURLConnectionEx alloc] initWithRequest:request delegate:self tag_:tag];
}

- (void) closeConnection
{
    if (nil != connection)
    {
        [connection release];
        connection = nil;
    }
}

-(void)l:(NSString*) message
{
    [AppSettings l:[NSString stringWithFormat:@"OpenDAIClient %@", message]];
}

- (void)connection:(NSURLConnectionEx *)connection didReceiveResponse:(NSURLResponse *)response
{
	if (![connection.tag isEqualToString:tag]) return;
	[responseData setLength:0];
}

- (void)connection:(NSURLConnectionEx *)connection didReceiveData:(NSData *)data
{
	if (![connection.tag isEqualToString:tag]) return;
	[responseData appendData:data];
}

- (void)connection:(NSURLConnectionEx *)connection didFailWithError:(NSError *)error
{
	if (![connection.tag isEqualToString:tag]) return;
	NSString *res=[NSString stringWithFormat:@"Connection failed: %@", [error description]];
	if ([callBackDelegate respondsToSelector:callBackErrorMethod])
		[callBackDelegate performSelector:callBackErrorMethod withObject:res];}

- (void)connectionDidFinishLoading:(NSURLConnectionEx *)connection
{
	if (![connection.tag isEqualToString:tag]) return;
    [self closeConnection];

    
	NSString *res = [[NSString alloc] initWithData:responseData encoding:NSASCIIStringEncoding];
    //[self l:[NSString stringWithFormat:@"send() connectionDidFinishLoading() response: %@", res]];
	if ([callBackDelegate respondsToSelector:callBackSuccessMethod])
		[callBackDelegate performSelector:callBackSuccessMethod withObject:res];
    
    	[responseData release];
}

// Gestione dell https
//
- (BOOL)connection:(NSURLConnectionEx *)connection canAuthenticateAgainstProtectionSpace:(NSURLProtectionSpace *)protectionSpace {
    return [protectionSpace.authenticationMethod isEqualToString:NSURLAuthenticationMethodServerTrust];
}

- (void)connection:(NSURLConnection *)connection didReceiveAuthenticationChallenge:(NSURLAuthenticationChallenge *)challenge {
    if ([challenge.protectionSpace.authenticationMethod isEqualToString:NSURLAuthenticationMethodServerTrust])
        // if ([trustedHosts containsObject:challenge.protectionSpace.host])
        [challenge.sender useCredential:[NSURLCredential credentialForTrust:challenge.protectionSpace.serverTrust] forAuthenticationChallenge:challenge];
    
    [challenge.sender continueWithoutCredentialForAuthenticationChallenge:challenge];
}

@end
