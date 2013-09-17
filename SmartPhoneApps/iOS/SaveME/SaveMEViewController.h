#import <UIKit/UIKit.h>

#import "AppSettings.h"
#import "AboutViewController.h"
#import "HelpViewController.h"
#import "LocationHelper.h"
#import "AppSettingsViewController.h"
#import "MacroConfiguration.h"
#import "OpenDaiClient.h"
#import "DisclaimerViewController.h"

@interface SaveMEViewController : UIViewController
{
    IBOutlet UILabel *pos;
    
    AppSettingsViewController *appSettingsViewController;
    AboutViewController *aboutViewController;
    HelpViewController *helpViewController;
    DisclaimerViewController* disclaimerViewController;
    
    OpenDaiClient *openDaiClient;
    
    CLLocation* lastLocation;
}

@property (nonatomic, retain) LocationHelper *locationHelper;
@property (nonatomic, retain)    IBOutlet UILabel *statusLabel;

-(IBAction) onMacroSelected: (UIButton*) sender;
-(void)l:(NSString*) message;
-(void) onResume:(NSNotification *)notification;

- (void) onOpenDAIError: (NSString*) res;
- (void) onOpenDAISuccess: (NSString*) res;

@end
