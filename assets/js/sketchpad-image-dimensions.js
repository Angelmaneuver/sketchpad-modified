( function ( wp ) {
	const { addFilter } = wp.hooks;
	const { createHigherOrderComponent } = wp.compose;
	const { Children, cloneElement, createElement, Fragment, isValidElement } = wp.element;
	const { InspectorControls } = wp.blockEditor;
	const { PanelBody, SelectControl } = wp.components;
	const { __ } = wp.i18n;
	const unitOptions = [
		{ label: 'px', value: 'px' },
		{ label: __( 'No unit', 'sketchpad-modified' ), value: 'none' },
	];
	const fetchPriorityOptions = [
		{ label: __( 'Default', 'sketchpad-modified' ), value: 'none' },
		{ label: __( 'High', 'sketchpad-modified' ), value: 'high' },
		{ label: __( 'Low', 'sketchpad-modified' ), value: 'low' },
		{ label: __( 'Auto', 'sketchpad-modified' ), value: 'auto' },
	];

	function addImageSettingsAttributes( settings, name ) {
		if ( 'core/image' !== name ) {
			return settings;
		}

		return {
			...settings,
			attributes: {
				...settings.attributes,
				sketchpadWidthUnit: { type: 'string', default: 'px' },
				sketchpadHeightUnit: { type: 'string', default: 'px' },
				sketchpadFetchPriority: { type: 'string' },
			},
		};
	}

	const withImageSettingsControls = createHigherOrderComponent( ( BlockEdit ) => ( props ) => {
		if ( 'core/image' !== props.name ) {
			return createElement( BlockEdit, props );
		}

		const { attributes, setAttributes } = props;
		return createElement(
			Fragment,
			null,
			createElement( BlockEdit, props ),
			createElement(
				InspectorControls,
				{ group: 'dimensions' },
				createElement(
					PanelBody,
					{
						title: __( 'Image size units', 'sketchpad-modified' ),
						className: 'sketchpad-image-size-units',
						initialOpen: false,
					},
					createElement( SelectControl, {
						label: __( 'Width unit', 'sketchpad-modified' ),
						value: attributes.sketchpadWidthUnit || 'px',
						options: unitOptions,
						onChange: ( value ) => setAttributes( { sketchpadWidthUnit: value } ),
					} ),
					createElement( SelectControl, {
						label: __( 'Height unit', 'sketchpad-modified' ),
						value: attributes.sketchpadHeightUnit || 'px',
						options: unitOptions,
						onChange: ( value ) => setAttributes( { sketchpadHeightUnit: value } ),
					} )
				)
			),
			createElement(
				InspectorControls,
				{ group: 'advanced' },
				createElement( SelectControl, {
					label: __( 'Fetch priority', 'sketchpad-modified' ),
					value: attributes.sketchpadFetchPriority || 'none',
					options: fetchPriorityOptions,
					onChange: ( value ) => setAttributes( { sketchpadFetchPriority: value } ),
				} )
			)
		);
	}, 'withImageSettingsControls' );

	function addUnitlessDimensionsToSavedImage( element, blockType, attributes ) {
		if ( ! element || 'core/image' !== blockType.name ) {
			return element;
		}

		const unitlessDimensions = {};
		[ 'width', 'height' ].forEach( ( dimension ) => {
			const unitAttribute = `sketchpad${ dimension.charAt( 0 ).toUpperCase() }${ dimension.slice( 1 ) }Unit`;
			const value = attributes[ dimension ];
			const match = 'none' === attributes[ unitAttribute ] && typeof value === 'string'
				? value.match( /^(\d+)px$/ )
				: null;

			if ( match ) {
				unitlessDimensions[ dimension ] = Number( match[1] );
			}
		} );

		if ( ! Object.keys( unitlessDimensions ).length ) {
			return element;
		}

		return updateSavedImageElement( element, ( imageProps ) => {
			const style = { ...imageProps.style };
			Object.keys( unitlessDimensions ).forEach( ( dimension ) => delete style[ dimension ] );

			return {
				...unitlessDimensions,
				style: Object.keys( style ).length ? style : undefined,
			};
		} );
	}

	function addFetchPriorityToSavedImage( element, blockType, attributes ) {
		if ( ! element || 'core/image' !== blockType.name || ! Object.prototype.hasOwnProperty.call( attributes, 'sketchpadFetchPriority' ) ) {
			return element;
		}

		const fetchPriority = attributes.sketchpadFetchPriority;
		const isValidFetchPriority = [ 'high', 'low', 'auto' ].includes( fetchPriority );

		return updateSavedImageElement( element, () => ( {
			fetchpriority: isValidFetchPriority ? fetchPriority : undefined,
		} ) );
	}

	function updateSavedImageElement( element, getImageProps ) {
		function updateNode( node ) {
			if ( ! isValidElement( node ) ) {
				return node;
			}

			if ( 'img' === node.type ) {
				return cloneElement( node, getImageProps( node.props ) );
			}

			if ( ! node.props.children ) {
				return node;
			}

			return cloneElement( node, undefined, Children.map( node.props.children, updateNode ) );
		}

		return updateNode( element );
	}

	addFilter( 'blocks.registerBlockType', 'sketchpad/image-settings-attributes', addImageSettingsAttributes );
	addFilter( 'blocks.getSaveElement', 'sketchpad/image-unitless-dimensions', addUnitlessDimensionsToSavedImage );
	addFilter( 'blocks.getSaveElement', 'sketchpad/image-fetch-priority', addFetchPriorityToSavedImage );
	addFilter( 'editor.BlockEdit', 'sketchpad/image-settings-controls', withImageSettingsControls );
} )( window.wp );
