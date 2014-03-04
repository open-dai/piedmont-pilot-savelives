//
//  NSURLConnectionEx.m
//  SaveME
//
//  Created by sig sig on 07/06/13.
//  Copyright 2013 CSI-Piemonte. All rights reserved.
//

#import "NSURLConnectionEx.h"

@implementation NSURLConnectionEx

@synthesize tag;

- (id)initWithRequest:(NSURLRequest *)request delegate:(id)delegate tag_:(NSString*)tag_ {
	self = [super initWithRequest:request delegate:delegate];
	
	if (self) {
		self.tag = tag_;
	}
	return self;
}

- (void)dealloc {
	[tag release];
	[super dealloc];
}

@end
