
#import <Cocoa/Cocoa.h>


@class Project;


@interface NewMainWindowController : NSWindowController {
    NSObject              *_projectsItem;
    NSImage               *_folderImage;
}

@property (nonatomic, readonly) NSArray *projects;

@property (assign) IBOutlet NSOutlineView *projectOutlineView;

@property (assign) IBOutlet NSTextField *pathTextField;

@property (assign) IBOutlet NSButton *compilerEnabledCheckBox;

@property (assign) IBOutlet NSButton *postProcessingEnabledCheckBox;

- (void)projectAdded:(Project *)project;

@end