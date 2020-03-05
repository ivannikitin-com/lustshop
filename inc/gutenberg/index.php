<?php

add_theme_support( 'align-wide' );

// Editor Styles
add_theme_support( 'editor-styles' );
add_editor_style( 'build/editor-style.css' );

add_action( 'enqueue_block_editor_assets', 'lustshop_enqueue_block_editor_assets' );

function lustshop_enqueue_block_editor_assets() {
  wp_enqueue_style(
    "lustshop-gutenberg",
    get_template_directory_uri() . '/gutenberg/dist/blocks.editor.build.css'
  );
}


// Change color scheme
require __DIR__ . '/gutenberg-colors.php';

// Add theme font-size
require __DIR__ . '/gutenberg-fonts.php';
