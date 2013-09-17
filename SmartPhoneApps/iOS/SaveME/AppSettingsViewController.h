#import <UIKit/UIKit.h>

@interface AppSettingsViewController : UIViewController<UITextFieldDelegate>
{
    IBOutlet UIButton *testbtn;
}
- (UITextField*) makeTextField:(NSString*)text placeHolder:(NSString*)placeHolder;
@end
