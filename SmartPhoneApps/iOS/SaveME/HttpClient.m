#import "HttpClient.h"
#import "NSURLConnectionEx.h"

@implementation HttpClient
- (void) getUrl:(NSString *)url delegate:(id)delegate successMethod:(SEL)successMethod errorMethod:(SEL)errorMethod{
	callBackDelegate=delegate;
	callBackSuccessMethod=successMethod;
	callBackErrorMethod=errorMethod; 
	tag=[NSString stringWithFormat:@"%f", CFAbsoluteTimeGetCurrent()];
	
	responseData = [[NSMutableData data] retain];	
	NSURLRequest *request = [NSURLRequest requestWithURL:[NSURL URLWithString:url]];	
	[[NSURLConnectionEx alloc] initWithRequest:request delegate:self tag_:tag];
}

- (void)connection:(NSURLConnectionEx *)connection didReceiveResponse:(NSURLResponse *)response {
	if (![connection.tag isEqualToString:tag]) return;
	[responseData setLength:0];
}

- (void)connection:(NSURLConnectionEx *)connection didReceiveData:(NSData *)data {
	if (![connection.tag isEqualToString:tag]) return;
	[responseData appendData:data];
}

- (void)connection:(NSURLConnectionEx *)connection didFailWithError:(NSError *)error {
	if (![connection.tag isEqualToString:tag]) return;
	NSString *res=[NSString stringWithFormat:@"Connection failed: %@", [error description]];
	if ([callBackDelegate respondsToSelector:callBackErrorMethod])
		[callBackDelegate performSelector:callBackErrorMethod withObject:res];}

- (void)connectionDidFinishLoading:(NSURLConnectionEx *)connection {
	if (![connection.tag isEqualToString:tag]) return;
	
	[connection release];
	
	NSString *res = [[NSString alloc] initWithData:responseData encoding:NSASCIIStringEncoding];
	[responseData release];
	
	if ([callBackDelegate respondsToSelector:callBackSuccessMethod])
		[callBackDelegate performSelector:callBackSuccessMethod withObject:res];
}


@end