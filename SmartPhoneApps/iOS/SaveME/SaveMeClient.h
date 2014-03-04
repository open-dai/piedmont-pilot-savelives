//
//  SaveMeClient.h
//  SaveME
//
//  Created by sig sig on 07/06/13.
//  Copyright 2013 CSI-Piemonte. All rights reserved.
//

#import <Foundation/Foundation.h>
#import <CoreLocation/CoreLocation.h>

@interface SaveMeClient : NSObject{
	id delegate;
	SEL onDataRecievedCallBack;
}

@property (nonatomic,retain) id delegate;

- (void) createCall:(NSString *)phoneNumber uid:(NSString *)uid delegate:(id)delegate onDataReceived:(SEL)onDataReceived ;
- (void) updateCall:(NSString *)rowID phoneNumber:(NSString *)phoneNumber uid:(NSString *)uid;
- (void) setCallPosition:(NSString *)rowID location:(CLLocation *)location;

@end