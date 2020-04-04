const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
import edit from './edit';

registerBlockType( 'lustshop/subscribe', {
	title: __( 'Subscribe', 'lustshop' ),
	category: 'lustshop',
	keywords: [ __( 'lustshop' ), __( 'Subscribe', 'lustshop' ) ],
	edit,
	save: props => {
		return null;
	},
} );
