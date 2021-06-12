<?php
/**
 * Theme API: Breadcrumb class.
 *
 * @package    sketchpad
 * @subpackage sm-breadcrumb
 * @since      2.1.0
 */

/**
 * Class for storing breadcrumbs.
 *
 * @since      2.1.0
 */
class SM_Breadcrumb {
	const SEPARATOR      = '>';
	const AROUND_THE_TAG = '<div class="breadcrumbs">';
	const CLOSE_TAG      = '</div>';
	const HOME_PAGE      = '<span><a title="Go Home" href="%link%"><span>Home</span></a></span>';
	const POST_TYPE      = '<span><a title="Go %title%" href="%link%"><span>%htitle%</span></a></span>';
	const PAGE_TYPE      = self::POST_TYPE;
	const MEDIA_TYPE     = self::POST_TYPE;
	const CATEGORY       = '<span><a title="Go %title% category archive" href="%link%"><span>%htitle%</span></a></span>';
	const TAG            = '<span><a title="Go %title% tag archive" href="%link%"><span>%htitle%</span></a></span>';
	const AUTHOR         = '<span><span><a title="Go to the first page of the %title% article" href="%link%">%htitle%</a></span></span>';
	const DATE           = '<span><a title="Go %title% archive" href="%link%"><span>%htitle%</span></a></span>';
	const SEARCH         = '<span><span><a title="Go to the first page of the search %title% result" href="%link%">%htitle%</a></span></span>';

	/**
	 * Store the start tag of the breadcrumbs.
	 *
	 * @var string
	 */
	private string $start;

	/**
	 * Store the end tag of the breadcrumbs.
	 *
	 * @var string
	 */
	private string $end;

	/**
	 * Store the breadcrumb separator.
	 *
	 * @var string
	 */
	private string $separator;

	/**
	 * Keep track of the number of breadcrumbs.
	 *
	 * @var integer
	 */
	private int $layer = 1;

	/**
	 * Store the breadcrumbs.
	 *
	 * @var string
	 */
	private string $breadcrumbs = '';

	/**
	 * Sets up a new SM_Breadcrumb instance.
	 *
	 * @param string $separator Breadcrumbs separator character.
	 * @param string $start     Breadcrumbs start tag.
	 * @param string $end       Breadcrumbs end tag.
	 */
	public function __construct( string $separator, string $start, string $end ) {
		$this->separator = $separator;
		$this->start     = $start;
		$this->end       = $end;
	}

	/**
	 * Add the argument string to the breadcrumbs.
	 *
	 * @param  string $breadcrumb A string to be added to the breadcrumbs.
	 * @return void
	 */
	public function push( string $breadcrumb ) {
		if ( ! empty( $this->breadcrumbs ) ) {
			$this->breadcrumbs .= $this->separator;
		}

		$this->breadcrumbs .= $breadcrumb;
		$this->layer++;
	}

	/**
	 * Create and add the breadcrumb from argument.
	 *
	 * @param  string $format Format string for the breadcrumb to be add.
	 * @param  string $title  Breadcrumb string.
	 * @param  string $htitle String to be displayed on hover.
	 * @param  string $link   Destination link url string.
	 * @return void
	 */
	public function regist_link( string $format, string $title, string $htitle, string $link ) {
		$replacement = array(
			'%title%'    => $title,
			'%htitle%'   => $htitle,
			'%link%'     => esc_url( $link ),
			'%position%' => $this->layer,
		);

		$this->push( str_replace( array_keys( $replacement ), array_values( $replacement ), $format ) );
	}

	/**
	 * Return the number of stored Breadcrumbs.
	 *
	 * @return int
	 */
	public function get_layer() {
		return $this->layer;
	}

	/**
	 * Return the Breadcrumbs.
	 *
	 * @return string
	 */
	public function get_breadcrumbs() {
		return $this->start . $this->breadcrumbs . $this->end;
	}
}
