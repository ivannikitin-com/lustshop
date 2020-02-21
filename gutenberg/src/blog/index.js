import edit from './edit';

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'lustshop/blog', {
	title: __( 'Blog', 'lustshop' ),
	category: 'lustshop',
	supports: {
		html: false,
	},
	keywords: [ __( 'lustshop' ), __( 'Blog', 'lustshop' ) ],
	edit,
	save: () => {
		return null;
	},
} );
