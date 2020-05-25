const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;

registerBlockType( 'lustshop/news', {
	title: __( 'News', 'lustshop' ),
	category: 'lustshop',
	keywords: [
		__( 'lustshop' ),
		__( 'News', 'lustshop' ),
	],
	edit: props => {
		return (
			<div className={ props.className }>
				<p>— Hello from the backend.</p>
				<p>
					CGB BLOCK: <code>lustshop-blocks</code> is a new Gutenberg block
				</p>
				<p>
					It was created via{ ' ' }
					<code>
						<a href="https://github.com/ahmadawais/create-guten-block">
							create-guten-block
						</a>
					</code>
					.
				</p>
			</div>
		);
	},
	save: props => {
		return (
			<div className={ props.className }>
				<p>— Hello from the frontend.</p>
				<p>
					CGB BLOCK: <code>lustshop-blocks</code> is a new Gutenberg block.
				</p>
				<p>
					It was created via{ ' ' }
					<code>
						<a href="https://github.com/ahmadawais/create-guten-block">
							create-guten-block
						</a>
					</code>
					.
				</p>
			</div>
		);
	},
} );
