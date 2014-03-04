//
//  NSURLConnectionEx.h
//  SaveME
//
//  Created by sig sig on 07/06/13.
//  Copyright 2013 CSI-Piemonte. All rights reserved.
//

#import <Foundation/Foundation.h>


@interface NSURLConnectionEx : NSURLConnection  

@property (nonatomic, retain) NSString *tag;

- (id)initWithRequest:(NSURLRequest *)request delegate:(id)delegate tag_:(NSString*)tag_;

@end