
@interface HttpClient : NSObject {
    id callBackDelegate;
    SEL callBackSuccessMethod;
    SEL callBackErrorMethod;
    NSMutableData *responseData;	
    NSString *tag;
} 

- (void) getUrl:(NSString *)url delegate:(id)delegate successMethod:(SEL)successMethod errorMethod:(SEL)errorMethod;

@end