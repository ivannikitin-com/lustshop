<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function lustshop_blocks_cgb_block_assets() { // phpcs:ignore
	// Register block editor script for backend.
	wp_register_script(
		'lustshop_blocks-cgb-block-js', // Handle.
		get_template_directory_uri() . '/dist/gutenberg.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	register_block_type(
		'cgb/block-lustshop-blocks', array(
			'editor_script' => 'lustshop_blocks-cgb-block-js',
		)
	);
}

// Hook: Block assets.
add_action( 'init', 'lustshop_blocks_cgb_block_assets' );

// Create custom category
add_filter( 'block_categories', 'lustshop_blocks_cgb_categories', 10, 2 );
function lustshop_blocks_cgb_categories ( $categories ) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' 	=> 'lustshop',
				'title'	=> __( 'LustShop' ),
			)
		)
	);
}

include __DIR__ . '/blog/index.php';
include __DIR__ . '/woo-category/index.php';
include __DIR__ . '/subscribe/index.php';
include __DIR__ . '/home-banner/index.php';
