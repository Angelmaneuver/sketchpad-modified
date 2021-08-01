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
.interface-interface-skeleton__content, .edit-post-visual-editor, .editor-styles-wrapper, .edit-post-visual-editor__content-area > div,
.edit-post-layout__footer
EOM;
	const RETURN2TOP_BUTTON_MARK                       = '<span class="dashicons dashicons-arrow-up-alt2"></span>';
	const RETURN2TOP_BUTTON_BACKGROUND_COLOR           = '#999999';
	const RETURN2TOP_BUTTON_HOVER_BACKGROUND_COLOR     = '#666666';
	const RETURN2TOP_BUTTON_BORDER_COLOR               = '#ffffff';
	const HAMBURGER_MENU_BUTTON_OPEN_MARK              = '<span class="dashicons dashicons-menu-alt"></span>';
	const HAMBURGER_MENU_BUTTON_CLOSE_MARK             = '<span class="dashicons dashicons-no-alt"></span>';
	const HAMBURGER_MENU_BUTTON_BACKGROUND_COLOR       = '#999999';
	const HAMBURGER_MENU_BUTTON_HOVER_BACKGROUND_COLOR = '#666666';
	const HAMBURGER_MENU_BUTTON_BORDER_COLOR           = '#ffffff';
}
