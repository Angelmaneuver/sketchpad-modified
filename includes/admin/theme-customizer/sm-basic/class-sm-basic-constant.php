<?php
/**
 * Constant class.
 *
 * @package sketchpad - modified
 * @subpackage sm-basic
 * @since 1.0.0
 */

class SmBasicConstantClass {
  const PANEL = 'sketchpad_basic_panel';
  const ADMIN_BACKGROUND_COLOR = '#ffffff';
  const ADMIN_BACKGROUND_OPACITY_TARGETS = <<<EOM
body,
.postbox, #activity-widget, #the-comment-list, .comment-item, .community-events ul,
.edit-post-header,
.components-notice,
.interface-interface-skeleton__content, .edit-post-visual-editor, .editor-styles-wrapper,
.interface-interface-skeleton__sidebar, .components-panel__header, .interface-complementary-area-header, .interface-complementary-area, .edit-post-sidebar, .edit-post-sidebar__panel-tabs, .components-panel,
.edit-post-layout__footer
EOM;
  const TOP_BUTTON_MARK                   = 'TOP';
  const TOP_BUTTON_BACKGROUND_COLOR       = '#4169e1';
  const TOP_BUTTON_HOVER_BACKGROUND_COLOR = '#dc143c';
  const TOP_BUTTON_BORDER_COLOR           = '#ffffff';
}
