import classnames from 'classnames';

const { __ } = wp.i18n;
const { Fragment } = wp.element;
const { registerBlockType } = wp.blocks;
const {
	InnerBlocks,
	MediaUpload,
	MediaUploadCheck,
	BlockControls,
	InspectorControls,
	PanelColorSettings,
	withColors,
	getColorClassName,
} = wp.editor;
const {
	Toolbar,
	IconButton,
	ToggleControl,
	PanelBody,
	RangeControl,
} = wp.components;
const { compose } = wp.compose;

const ALLOWED_MEDIA_TYPES = [ 'image' ];
const IMAGE_BACKGROUND_TYPE = 'image';

registerBlockType( 'lustshop/section', {
	title: __( 'Section', 'lustshop' ),
	category: 'lustshop',
	keywords: [ __( 'Section', 'lustshop' ) ],
	attributes: {
		url: {
			type: 'string',
		},
		id: {
			type: 'number',
		},
		backgroundType: {
			type: 'string',
			default: 'image',
		},
		hasParallax: {
			type: 'boolean',
			default: false,
		},
		hasRepeat: {
			type: 'boolean',
			default: false,
		},
		hasCover: {
			type: 'boolean',
			default: false,
		},
		overlayColor: {
			type: 'string',
		},
		customOverlayColor: {
			type: 'string',
		},
		opacity: {
			type: 'number',
			default: 50,
		},
		align: {
			type: 'string',
			default: 'full',
		},
	},
	supports: {
		align: [ 'full' ],
		anchor: true,
	},
	edit: compose( [ withColors( { overlayColor: 'background-color' } ) ] )( props => {
		const {
			className,
			attributes,
			setAttributes,
			overlayColor,
			setOverlayColor,
		} = props;
		const {
			url,
			id,
			hasParallax,
			hasRepeat,
			hasCover,
			backgroundType,
			opacity,
		} = attributes;

		const toggleParallax = () => setAttributes( { hasParallax: ! hasParallax } );
		const toggleRepeat = () => setAttributes( { hasRepeat: ! hasRepeat } );
		const toggleCover = () => setAttributes( { hasCover: ! hasCover } );
		const setOpacity = opacityNew => setAttributes( { opacity: opacityNew } );

		const removeBackground = () => {
			setAttributes( { url: undefined, id: undefined } );
		};
		const onSelectMedia = media => {
			if ( ! media || ! media.url ) {
				setAttributes( { url: undefined, id: undefined } );
				return;
			}
			let mediaType;
			if ( media.media_type ) {
				if ( media.media_type === IMAGE_BACKGROUND_TYPE ) {
					mediaType = IMAGE_BACKGROUND_TYPE;
				}
			} else {
				if ( media.type !== IMAGE_BACKGROUND_TYPE ) {
					return;
				}
				mediaType = media.type;
			}

			setAttributes( {
				url: media.url,
				id: media.id,
				backgroundType: mediaType,
			} );
		};

		const style = {
			...( backgroundType === IMAGE_BACKGROUND_TYPE ?
				backgroundImageStyles( url ) :
				{} ),
			backgroundColor: overlayColor.color,
		};

		const classes = classnames( className, opacityToClass( opacity ), {
			'has-background-opacity': opacity !== 0 && url,
			'has-parallax': hasParallax,
			'no-repeat': hasRepeat,
			cover: hasCover,
		} );

		return (
			<Fragment>
				<BlockControls>
					<Fragment>
						<MediaUploadCheck>
							<Toolbar>
								<MediaUpload
									onSelect={ onSelectMedia }
									value={ id }
									allowedTypes={ ALLOWED_MEDIA_TYPES }
									render={ ( { open } ) => (
										<IconButton
											className="components-toolbar__control"
											icon="edit"
											label={ __( 'Edit background', 'lustshop' ) }
											onClick={ open }
										/>
									) }
								/>
								<IconButton
									className="components-toolbar__control"
									icon="no"
									label={ __( 'Reset background image', 'lustshop' ) }
									onClick={ removeBackground }
								/>
							</Toolbar>
						</MediaUploadCheck>
					</Fragment>
				</BlockControls>
				<InspectorControls>
					<PanelBody title={ __( 'Background Settings', 'lustshop' ) }>
						{ !! url && IMAGE_BACKGROUND_TYPE === backgroundType && (
							<Fragment>
								<ToggleControl
									label={ __( 'Fixed', 'lustshop' ) }
									checked={ hasParallax }
									onChange={ toggleParallax }
								/>
								<ToggleControl
									label={ __( 'Cover', 'lustshop' ) }
									checked={ hasCover }
									onChange={ toggleCover }
								/>
								<ToggleControl
									label={ __( 'No Repeat', 'lustshop' ) }
									checked={ hasRepeat }
									onChange={ toggleRepeat }
								/>
								<RangeControl
									label={ __( 'Background Opacity', 'lustshop' ) }
									value={ opacity }
									onChange={ setOpacity }
									min={ 0 }
									max={ 100 }
									step={ 10 }
								/>
							</Fragment>
						) }
						<PanelColorSettings
							title={ __( 'Overlay', 'lustshop' ) }
							initialOpen={ true }
							colorSettings={ [
								{
									value: overlayColor.color,
									onChange: setOverlayColor,
									label: __( 'Overlay Color' ),
								},
							] }
						/>
					</PanelBody>
				</InspectorControls>
				<section className={ classes } style={ style }>
					<InnerBlocks />
				</section>
			</Fragment>
		);
	} ),
	save: function( props ) {
		const { attributes } = props;
		const {
			url,
			hasParallax,
			hasRepeat,
			hasCover,
			opacity,
			overlayColor,
			customOverlayColor,
		} = attributes;
		const overlayColorClass = getColorClassName(
			'background-color',
			overlayColor
		);
		const style = backgroundImageStyles( url );
		if ( ! overlayColorClass ) {
			style.backgroundColor = customOverlayColor;
		}

		const classes = classnames(
			'wp-block-lustshop-section',
			overlayColorClass,
			!! url && opacityToClass( opacity ),
			{
				'has-background-opacity': opacity !== 0 && url,
				'has-parallax': hasParallax,
				'no-repeat': hasRepeat,
				cover: hasCover,
			}
		);

		return (
			<section className={ classes } style={ style }>
				<InnerBlocks.Content />
			</section>
		);
	},
} );

function opacityToClass( ratio ) {
	return ratio === 0 || ratio === 50 ?
		null :
		'has-background-opacity-' + 10 * Math.round( ratio / 10 );
}

function backgroundImageStyles( url ) {
	return url ? { backgroundImage: `url(${ url })` } : {};
}
