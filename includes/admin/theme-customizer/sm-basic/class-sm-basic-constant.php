<?php
/**
 * Constant.
 *
 * @package sketchpad - modified
 * @subpackage sm-basic
 * @since 1.0.0
 */

/**
 * SM Basic Constant class.
 *
 * @since 1.0.0
 */
class Sm_Basic_Constant {
	const PANEL                                        = 'sketchpad_basic_panel';
	const ADMIN_BACKGROUND_COLOR                       = '#ffffff';
	const ADMIN_BACKGROUND_OPACITY_TARGETS             = <<<EOM
body,
.postbox, #activity-widget, #the-comment-list, .comment-item, .community-events ul,
.edit-post-header,
.components-notice,
.interface-interface-skeleton__content, .edit-post-visual-editor, .editor-styles-wrapper,
.interface-interface-skeleton__sidebar, .components-panel__header, .interface-complementary-area-header, .interface-complementary-area, .edit-post-sidebar, .edit-post-sidebar__panel-tabs, .components-panel,
.edit-post-layout__footer
EOM;
	const RETURN2TOP_BUTTON_MARK                       = 'TOP';
	const RETURN2TOP_BUTTON_BACKGROUND_COLOR           = '#4169e1';
	const RETURN2TOP_BUTTON_HOVER_BACKGROUND_COLOR     = '#dc143c';
	const RETURN2TOP_BUTTON_BORDER_COLOR               = '#ffffff';
	const HAMBURGER_MENU_BUTTON_OPEN_MARK              = 'Menu';
	const HAMBURGER_MENU_BUTTON_CLOSE_MARK             = 'Close';
	const HAMBURGER_MENU_BUTTON_BACKGROUND_COLOR       = '#4169e1';
	const HAMBURGER_MENU_BUTTON_HOVER_BACKGROUND_COLOR = '#dc143c';
	const HAMBURGER_MENU_BUTTON_BORDER_COLOR           = '#ffffff';
}
