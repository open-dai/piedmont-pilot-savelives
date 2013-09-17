 #import "AppSettings.h"

@implementation AppSettings

+ (NSString *) getValue:(NSString *)key
{
    NSString *res=[[NSUserDefaults standardUserDefaults] stringForKey:key];
    return res;
}


+ (void) setValue:(NSString *)key:(NSString *) value
{
    [[NSUserDefaults standardUserDefaults] setValue:(value) forKey:key];
    [[NSUserDefaults standardUserDefaults] synchronize];
}

+(void)l:(NSString*) message
{
    NSLog(@"%@ - %@", [NSString appTitle], message);
}

@end

@implementation NSString (CustomStrings)
+(NSString *) appTitle{
    return @"SaveME";
}
@end
