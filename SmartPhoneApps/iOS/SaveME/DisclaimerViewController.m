#import "DisclaimerViewController.h"

@implementation DisclaimerViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
    }
    return self;
}

-(IBAction) onOkPressed: (UIButton*) sender
{
    [self.view removeFromSuperview];
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    NSString* html=[[NSLocalizedString(@"[DisclaimerText]",nil) stringByReplacingOccurrencesOfString:@"+" withString:@" "]  stringByReplacingPercentEscapesUsingEncoding:NSUTF8StringEncoding ];

    [webView loadHTMLString:html baseURL:nil];
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
