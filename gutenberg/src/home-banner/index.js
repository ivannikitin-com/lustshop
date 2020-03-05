const { registerBlockType } = wp.blocks;
const { __ } = wp.i18n;
const ServerSideRender = wp.serverSideRender;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, TextControl } = wp.components;
const { URLInput } = wp.editor;
const { Fragment } = wp.element;

registerBlockType( 'lustshop/home-banner', {
	title: __( 'Banner for home page', 'lustshop' ),
	category: 'lustshop',
	keywords: [ __( 'Banner', 'lustshop' ) ],
	supports: {
		align: [ 'full' ],
	},
	edit( props ) {
		const { attributes, setAttributes } = props;
		const { title, buttonName, description, buttonLink } = attributes;

		const inspectorControls = (
			<InspectorControls>
				<PanelBody title={ __( 'Settings' ) }>
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
						label={ __( 'Button name', 'lustshop' ) }
						onChange={ buttonName => setAttributes( { buttonName } ) }
						value={ buttonName }
					/>
					<div className="input-search">
						<URLInput
							label={ __( 'Button link', 'lustshop' ) }
							value={ buttonLink }
							autoFocus={ false }
							onChange={ buttonLink => setAttributes( { buttonLink } ) }
						/>
					</div>
				</PanelBody>
			</InspectorControls>
		);

		return (
			<Fragment>
				{ inspectorControls }
				<ServerSideRender block="lustshop/home-banner" attributes={ attributes } />
			</Fragment>
		);
	},
} );
