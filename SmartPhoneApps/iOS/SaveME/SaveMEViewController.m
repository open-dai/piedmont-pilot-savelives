#import "SaveMEViewController.h"

@implementation SaveMEViewController

@synthesize locationHelper, statusLabel;

- (void)viewDidLoad
{
    [super viewDidLoad];
    
    // Push notification
    //
    [[NSNotificationCenter defaultCenter]
     addObserver:self
     selector:@selector(onResume:)
     name:@"ShowMainScreenNotification"
     object:nil];
    
    // Location helper
    //
    locationHelper=[[LocationHelper alloc] init];
    if (locationHelper==Nil){
        pos.text = @"Impossibile determinare la posizione";
    }else{
        locationHelper.delegate = self;
        [locationHelper startAcquireLocation];
    }
    
    // OpenDAI client
    openDaiClient = [[OpenDaiClient alloc] init];
    
    // Disclaimer - show if needed
    if ([self canShowDisclaimer])
        [self OpenDisclaimer];
    
    //
    [self onResume:nil];
}

-(void) onResume:(NSNotification *)notification
{
    statusLabel.hidden = ![self isTestMode];
}

-(BOOL) canShowDisclaimer
{
    return  [[AppSettings getValue:@"ShowDisclaimer"] isEqualToString:@"true"];
}

-(BOOL) isTestMode
{
    return  [[AppSettings getValue:@"TestMode"] isEqualToString:@"true"];
}

- (void)locationUpdate:(CLLocation *)location
{
    pos.text = [NSString stringWithFormat:@"%.6fN / %.6fE",
                location.coordinate.latitude,location.coordinate.longitude];
    
    lastLocation = location;
}

- (void)locationError:(NSError *)error
{
    pos.text = @"Impossibile determinare la posizione";
    NSLog(@"%@",[error description]);
}

-(IBAction) onMacroSelected: (UIButton*) sender
{
    NSInteger tag = sender.tag;
    [self l:[NSString stringWithFormat:@"onMacroSelected() tag:%d",tag]];
    
    // Creazione oggetto di Configurazione
    //
    MacroConfiguration *conf = [[MacroConfiguration alloc] autorelease];
    conf.userId = [AppSettings getValue:@"CSIID"];
    conf.isTestModeEnabled = [self isTestMode];
    conf.level = tag + 1;
    conf.isOnBehalf = tag == 3;
    
    // OpenDAI
    if (conf.userId.length > 0)
    {
    [openDaiClient send:conf withLocation:lastLocation delegate:self success:@selector(onOpenDAISuccess:) error:@selector(onOpenDAIError:)];
    }
    else if (conf.level > 1)
    {
        [self showAlertUserIdMissing];
    }
    
    // Call
    if (tag==0 && ![self isTestMode])
    {
        // log
        NSString* phoneNumber=@"118";
        [self l:[NSString stringWithFormat:@"call() phoneNumber:%@", phoneNumber]];
        
        // Starting up the call
        NSString * fmt = [NSString stringWithFormat:@"tel:%@", phoneNumber];
        [[UIApplication sharedApplication] openURL:[NSURL URLWithString: fmt]];
    }
}

-(void) showAlertUserIdMissing
{
    UIAlertView *alert = [[UIAlertView alloc] initWithTitle:@"Attenzione"
                                                    message:@"Verificare di aver impostato correttamente l'identificativo OpenDAI nelle Impostazioni."
                                                   delegate:self
                                          cancelButtonTitle:@"OK"
                                          otherButtonTitles:nil, nil];
    [alert show];
    [alert release];
}

- (void) onOpenDAISuccess: (NSString*) res
{
    [self l:[NSString stringWithFormat:@"onOpenDAISuccess() %@",res]];
    BOOL success = contains(res, @"correctly");
    
    if (!success)
    {
        UIAlertView *alert = [[UIAlertView alloc] initWithTitle:@"Attenzione"
                                                        message:@"La macro non é configurata correttamente."
                                                       delegate:self
                                              cancelButtonTitle:@"OK"
                                              otherButtonTitles:nil, nil];
        [alert show];
        [alert release];
    }
}

- (void) onOpenDAIError: (NSString*) res
{
    [self l:[NSString stringWithFormat:@"onOpenDAIError() %@",res]];
}

-(void)l:(NSString*) message
{
    [AppSettings l:[NSString stringWithFormat:@"SaveMEViewController %@", message]];
}

- (IBAction) OpenSettings
{
    [self l:@"Settings.."];
    appSettingsViewController=[[AppSettingsViewController alloc] initWithNibName:@"AppSettingsViewController" bundle:nil];
    [self.view addSubview:appSettingsViewController.view];
}

- (IBAction) OpenDisclaimer
{
    [self l:@"Disclaimer.."];
    disclaimerViewController=[[DisclaimerViewController alloc] initWithNibName:@"DisclaimerViewController" bundle:nil];
    [self.view addSubview:disclaimerViewController.view];
}

- (IBAction) OpenAbout
{
    [self l:@"About.."];
    aboutViewController=[[AboutViewController alloc] initWithNibName:@"AboutViewController" bundle:nil];
    [self.view addSubview:aboutViewController.view];
}

- (IBAction)OpenHelp
{
    [self l:@"Help.."];
    helpViewController=[[HelpViewController alloc] initWithNibName:@"HelpViewController" bundle:nil];
    [self.view addSubview:helpViewController.view];
}

- (void) dealloc
{
    [openDaiClient release];
    openDaiClient = nil;
    
    [locationHelper release];
    locationHelper = nil;
    
    [appSettingsViewController release];
    appSettingsViewController = nil;
    
    [aboutViewController release];
    aboutViewController = nil;
    
    [helpViewController release];
    helpViewController = nil;
    
    [super dealloc];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

@end
