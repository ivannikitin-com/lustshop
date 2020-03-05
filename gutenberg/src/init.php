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

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function lustshop_blocks_cgb_block_assets() { // phpcs:ignore
	// Register block editor script for backend.
	wp_register_script(
		'lustshop_blocks-cgb-block-js', // Handle.
		get_template_directory_uri() . '/gutenberg/dist/blocks.build.js',
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'lustshop_blocks-cgb-block-js',
		'cgbGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `cgbGlobal` object.
		]
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
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
