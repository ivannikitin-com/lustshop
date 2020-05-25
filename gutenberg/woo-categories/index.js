const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.editor;

const ALLOWED_BLOCKS = [ 'lustshop/woo-category' ];

registerBlockType( 'lustshop/woo-categories', {
	title: __( 'Woo Categories', 'lustshop' ),
	category: 'lustshop',
	keywords: [
		__( 'lustshop' ),
		__( 'Woo Categories', 'lustshop' ),
	],
	edit: ( { className } ) => {
		return (
			<div className={ className }>
				<div className="container">
					<ul className={ `${ className }__products` }>
						<InnerBlocks allowedBlocks={ ALLOWED_BLOCKS } />
					</ul>
				</div>
			</div>
		);
	},
	save: () => {
		return (
			<div>
				<div className="container">
					<ul className="wp-block-lustshop-woo-categories__products">
						<InnerBlocks.Content />
					</ul>
				</div>
			</div>
		);
	},
} );
