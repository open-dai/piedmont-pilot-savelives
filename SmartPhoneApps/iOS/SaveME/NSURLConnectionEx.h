//
//  NSURLConnectionEx.h
//  SaveME
//
//  Created by sig sig on 07/12/12.
//  Copyright 2012 __MyCompanyName__. All rights reserved.
//

#import <Foundation/Foundation.h>


@interface NSURLConnectionEx : NSURLConnection  

@property (nonatomic, retain) NSString *tag;

- (id)initWithRequest:(NSURLRequest *)request delegate:(id)delegate tag_:(NSString*)tag_;

@end