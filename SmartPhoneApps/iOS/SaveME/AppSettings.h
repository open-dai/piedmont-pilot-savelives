#import <Foundation/Foundation.h>

#define contains(str1, str2) ([str1 rangeOfString: str2 ].location != NSNotFound)

@interface AppSettings : NSObject

+ (id) getValue:(NSString *)key;
+ (void) setValue:(NSString *)key:(id) value;
+ (void) l:(NSString*) message;

@end

@interface NSString (CustomStrings)
+(NSString *) appTitle;
@end