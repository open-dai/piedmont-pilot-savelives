//
//  AppSettingsViewController.m
//  SaveME
//
//  Created by sig sig on 07/06/13.
//  Copyright 2013 CSI-Piemonte. All rights reserved.
//

#import "AppSettingsViewController.h"
#import "AppSettings.h"


@implementation AppSettingsViewController

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        self.view.backgroundColor = [UIColor colorWithPatternImage:[UIImage imageNamed:@"bkg.png"]];
        // Custom initialization
    }
    return self;
}
/*- (id)initWithStyle:(UITableViewStyle)style
 {
 self = [super initWithStyle:style];
 if (self) {
 // Custom initialization
 
 }
 return self;
 }
 */
- (void)didReceiveMemoryWarning
{
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc that aren't in use.
}

- (void)viewWillAppear:(BOOL)animated
{
    [super viewWillAppear:animated];
}

- (void)viewDidAppear:(BOOL)animated
{
    [super viewDidAppear:animated];
}

- (void)viewWillDisappear:(BOOL)animated
{
    [super viewWillDisappear:animated];
}

- (void)viewDidDisappear:(BOOL)animated
{
    [super viewDidDisappear:animated];
}

- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation
{
    // Return YES for supported orientations
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView
{
#warning Potentially incomplete method implementation.
    // Return the number of sections.
    return 1;
}

- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section
{
    // Return the number of rows in the section.
    return 5;
}

- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath
{
    UITableViewCell *cell =  [[[UITableViewCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:nil] autorelease];
    cell.selectionStyle=UITableViewCellSelectionStyleNone;
    
    UITextField* tf=nil;
    switch (indexPath.row) {
        case 0:
            cell.textLabel.text=@"Cellulare";
            tf=[self makeTextField:[AppSettings getValue:@"PhoneNumber"] placeHolder:@"+39 394 1291239"];
            tf.tag=indexPath.row;
            [cell addSubview:tf];
            break;
        case 1:
            cell.textLabel.text=@"OpenDAI";
            tf=[self makeTextField:[AppSettings getValue:@"CSIID"] placeHolder:@""];
            [cell addSubview:tf];
            tf.tag=indexPath.row;
            break;
        case 2:
        {
            cell.textLabel.text=@"Disclaimer all'avvio";
            
            UISwitch *sw=[[[UISwitch alloc]init]autorelease];
            sw.tag=indexPath.row;
            sw.frame=CGRectMake(220,12, 170 ,30);
            sw.on=[[AppSettings getValue:@"ShowDisclaimer"] isEqual:@"true"];
            [sw addTarget:self action:@selector(onDisclaimerSwitchChanged:) forControlEvents:UIControlEventValueChanged];
            [cell addSubview:sw];
            
            break;
        }
        case 3:
        {
            cell.textLabel.text=@"Test Mode";
            
            UISwitch *sw=[[[UISwitch alloc]init]autorelease];
            sw.tag=indexPath.row;
            sw.frame=CGRectMake(220,12,170,30);
            sw.on=[[AppSettings getValue:@"TestMode"] isEqual:@"true"];
            [sw addTarget:self action:@selector(switchValueChanged:) forControlEvents:UIControlEventValueChanged];
            [cell addSubview:sw];
            break;
        }
        case 4:
            {
                cell.textLabel.text=@"Versione";
                UILabel* label = [[[UILabel alloc] initWithFrame:CGRectMake(220,6, 170 ,30)]autorelease];
                [label setText:@"1.0"];
                [label setBackgroundColor:[UIColor clearColor]];
                [cell addSubview:label];
                tf.tag=indexPath.row;
                break;
            }
        default:
            break;
    }
    
    return cell;
}

- (UITextField*) makeTextField:(NSString*)text placeHolder:(NSString*)placeHolder{
    UITextField *res=[[[UITextField alloc]init]autorelease];
    res.placeholder=placeHolder;
    res.text=text;
    res.autocorrectionType=UITextAutocorrectionTypeNo;
    res.autocorrectionType=UITextAutocorrectionTypeNo;
    res.adjustsFontSizeToFitWidth=YES;
    res.frame=CGRectMake(120,12,170,30);
    
    [res addTarget:self action:@selector(textFieldFinished:) forControlEvents:UIControlEventEditingDidEndOnExit];
    res.delegate=self;
    
    return res;
}

- (IBAction)onDisclaimerSwitchChanged:(UISwitch*)sw
{
    [AppSettings setValue:@"ShowDisclaimer" : (sw.on ? @"true" : @"false")];
    NSLog(@"onDisclaimerSwitchChanged()");
}

- (IBAction)switchValueChanged:(UISwitch*)sw
{
    NSString *value = sw.on ? @"true" : @"false";
    [AppSettings setValue:@"TestMode" :value];
    NSLog(@"switchValueChanged()");
}

- (IBAction)textFieldFinished:(id)sender
{
    NSLog(@"textFieldFinished");
}

- (IBAction)textFieldDidEndEditing:(UITextField *)textField
{
    NSString *key=nil;
    switch (textField.tag) {
        case 0:
            key=@"PhoneNumber";
            break;
        case 1:
            key=@"CSIID";
            break;
        default:
            break;
    }
    if (key!=nil) [AppSettings setValue:key :[textField text]];
    NSLog(@"textFieldDidEndEditing");
}

- (IBAction)Close
{
    [self.view removeFromSuperview];
    [[NSNotificationCenter defaultCenter] postNotificationName:@"ShowMainScreenNotification" object:nil];
}

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath
{
    // Navigation logic may go here. Create and push another view controller.
    /*
     <#DetailViewController#> *detailViewController = [[<#DetailViewController#> alloc] initWithNibName:@"<#Nib name#>" bundle:nil];
     // ...
     // Pass the selected object to the new view controller.
     [self.navigationController pushViewController:detailViewController animated:YES];
     [detailViewController release];
     */
}

@end
