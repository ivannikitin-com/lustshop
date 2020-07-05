const { __ } = wp.i18n;
const { Component, Fragment } = wp.element;
const ServerSideRender = wp.serverSideRender;
const { InspectorControls, MediaUpload, MediaUploadCheck } = wp.editor;
const { PanelBody, TextControl, Button, ResponsiveWrapper, Spinner } = wp.components;
const { compose } = wp.compose;
const { withSelect } = wp.data;

const ALLOWED_MEDIA_TYPES = [ 'image' ];

class Sunscribe extends Component {
	render() {
		const { attributes, setAttributes, bgImage, bgImageSmall } = this.props;
		const { subtitle, title, description, ps, bgImageId, smallImageId, shortcodeForm } = attributes;

		const instructions = <p>{ __( 'To edit the background image, you need permission to upload media.', 'lustshop' ) }</p>;

		const onUpdateImage = ( image ) => {
			setAttributes( {
				bgImageId: image.id,
			} );
		};

		const onRemoveImage = () => {
			setAttributes( {
				bgImageId: undefined,
			} );
		};

		const onUpdateImageSmall = ( image ) => {
			setAttributes( {
				smallImageId: image.id,
			} );
		};

		const onRemoveImageSmall = () => {
			setAttributes( {
				smallImageId: undefined,
			} );
		};

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={ __( 'Settings' ) }>
					<TextControl
						label={ __( 'Subtitle', 'lustshop' ) }
						onChange={ subtitle => setAttributes( { subtitle } ) }
						value={ subtitle }
					/>
					<TextControl
						label={ __( 'Title', 'lustshop' ) }
						onChange={ title => setAttributes( { title } ) }
						value={ title }
					/>
					<TextControl
						label={ __( 'Description', 'lustshop' ) }
						onChange={ description => setAttributes( { description } ) }
						value={ description }
					/>
					<TextControl
						label={ __( 'PS', 'lustshop' ) }
						onChange={ ps => setAttributes( { ps } ) }
						value={ ps }
					/>
					<TextControl
						label={ __( 'Form shortcode', 'lustshop' ) }
						onChange={ shortcodeForm => setAttributes( { shortcodeForm } ) }
						value={ shortcodeForm }
					/>
				</PanelBody>
				<PanelBody title={ __( 'Main image bg', 'lustshop' ) }>
					<div className="wp-block-image-selector-example-image">
						<MediaUploadCheck fallback={ instructions } title={ __( 'Main image', 'lustshop' ) }>
							<MediaUpload
								title={ __( 'Background image', 'lustshop' ) }
								onSelect={ onUpdateImage }
								allowedTypes={ ALLOWED_MEDIA_TYPES }
								value={ bgImageId }
								render={ ( { open } ) => (
									<Button
										className={ ! bgImageId ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview' }
										onClick={ open }>
										{ ! bgImageId && ( __( 'Set background image', 'lustshop' ) ) }
										{ !! bgImageId && ! bgImage && <Spinner /> }
										{ !! bgImageId && bgImage &&
										<ResponsiveWrapper
											naturalWidth={ bgImage.media_details.width }
											naturalHeight={ bgImage.media_details.height }
										>
											<img src={ bgImage.source_url } alt={ __( 'Background image', 'lustshop' ) } />
										</ResponsiveWrapper>
										}
									</Button>
								) }
							/>
						</MediaUploadCheck>
						{ bgImageId && bgImage &&
						( <MediaUploadCheck>
							<MediaUpload
								title={ __( 'Background image', 'lustshop' ) }
								onSelect={ onUpdateImage }
								allowedTypes={ ALLOWED_MEDIA_TYPES }
								value={ bgImageId }
								render={ ( { open } ) => (
									<Button onClick={ open } isDefault isLarge>
										{ __( 'Replace background image', 'lustshop' ) }
									</Button>
								) }
							/>
						</MediaUploadCheck> )
						}
						{ !! bgImageId &&
						(
							<MediaUploadCheck>
								<Button onClick={ onRemoveImage } isLink isDestructive>
									{ __( 'Remove background image', 'lustshop' ) }
								</Button>
							</MediaUploadCheck>
						)
						}
					</div>
				</PanelBody>
				<PanelBody title={ __( 'Small image', 'lustshop' ) }>
					<div className="wp-block-image-selector-example-image">
						<MediaUploadCheck fallback={ instructions } title={ __( 'Small image', 'lustshop' ) }>
							<MediaUpload
								title={ __( 'Background image', 'lustshop' ) }
								onSelect={ onUpdateImageSmall }
								allowedTypes={ ALLOWED_MEDIA_TYPES }
								value={ smallImageId }
								render={ ( { open } ) => (
									<Button
										className={ ! smallImageId ? 'editor-post-featured-image__toggle' : 'editor-post-featured-image__preview' }
										onClick={ open }>
										{ ! smallImageId && ( __( 'Set background image', 'lustshop' ) ) }
										{ !! smallImageId && ! bgImageSmall && <Spinner /> }
										{ !! smallImageId && bgImageSmall &&
										<ResponsiveWrapper
											naturalWidth={ bgImageSmall.media_details.width }
											naturalHeight={ bgImageSmall.media_details.height }
										>
											<img src={ bgImageSmall.source_url } alt={ __( 'Background image', 'lustshop' ) } />
										</ResponsiveWrapper>
										}
									</Button>
								) }
							/>
						</MediaUploadCheck>
						{ smallImageId && bgImageSmall &&
						( <MediaUploadCheck>
							<MediaUpload
								title={ __( 'Background image', 'lustshop' ) }
								onSelect={ onUpdateImageSmall }
								allowedTypes={ ALLOWED_MEDIA_TYPES }
								value={ smallImageId }
								render={ ( { open } ) => (
									<Button onClick={ open } isDefault isLarge>
										{ __( 'Replace background image', 'lustshop' ) }
									</Button>
								) }
							/>
						</MediaUploadCheck> )
						}
						{ !! smallImageId &&
						(
							<MediaUploadCheck>
								<Button onClick={ onRemoveImageSmall } isLink isDestructive>
									{ __( 'Remove background image', 'lustshop' ) }
								</Button>
							</MediaUploadCheck>
						)
						}
					</div>
				</PanelBody>
			</InspectorControls>
		);

		return (
			<Fragment>
				{ inspectorControls }
				<ServerSideRender block="lustshop/subscribe" attributes={ { ...attributes } } />
			</Fragment>
		);
	}
}

export default compose(
	withSelect( ( select, props ) => {
		const { getMedia } = select( 'core' );
		const { bgImageId, smallImageId } = props.attributes;

		return {
			bgImage: bgImageId ? getMedia( bgImageId ) : null,
			bgImageSmall: smallImageId ? getMedia( smallImageId ) : null,
		};
	} ),
)( Sunscribe );
