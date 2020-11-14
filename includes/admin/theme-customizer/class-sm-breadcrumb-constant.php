<?php
/**
 * Constant class.
 *
 * @package sketchpad - modified
 * @subpackage sm-breadcrumb
 * @since 1.0.0
 */

class SmBreadcrumbConstantClass {
  const SEPARATOR       = '>';
  const AROUND_THE_TAG  = '<div class="breadcrumbs">';
  const CLOSE_TAG       = '</div>';
  const HOME_PAGE       = '<span><a title="Go Home" href="%link%"><span>Home</span></a></span>';
  const POST_TYPE       = '<span><a title="Go %title%" href="%link%"><span>%htitle%</span></a></span>';
  const PAGE_TYPE       = self::POST_TYPE;
  const MEDIA_TYPE      = self::POST_TYPE;
  const CATEGORY        = '<span><a title="Go %title% category archive" href="%link%"><span>%htitle%</span></a></span>';
  const TAG             = '<span><a title="Go %title% tag archive" href="%link%"><span>%htitle%</span></a></span>';
  const AUTHOR          = '<span><span><a title="Go to the first page of the %title% article" href="%link%">%htitle%</a></span></span>';
  const DATE            = '<span><a title="Go %title% archive" href="%link%"><span>%htitle%</span></a></span>';
  const SEARCH          = '<span><span><a title="Go to the first page of the search %title% result" href="%link%">%htitle%</a></span></span>';
}
