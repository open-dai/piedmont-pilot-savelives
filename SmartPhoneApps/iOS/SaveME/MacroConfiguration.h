#import <Foundation/Foundation.h>

@interface MacroConfiguration : NSObject

@property (nonatomic, retain) NSString* userId;
@property BOOL isTestModeEnabled;
@property int level;
@property BOOL isOnBehalf;

@end
