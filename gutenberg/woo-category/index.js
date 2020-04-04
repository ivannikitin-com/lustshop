const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

import edit from './edit';

registerBlockType( 'lustshop/woo-category', {
	title: __( 'Woo Category', 'lustshop' ),
	category: 'lustshop',
	keywords: [
		__( 'lustshop' ),
		__( 'Woo Category', 'lustshop' ),
	],
	edit,
	save: ( ) => {
		return null;
	},
} );
