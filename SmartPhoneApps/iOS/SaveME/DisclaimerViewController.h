#import <UIKit/UIKit.h>

@interface DisclaimerViewController : UIViewController
{
    IBOutlet UIWebView* webView;
}

-(IBAction) onOkPressed: (UIButton*) sender;

@end
