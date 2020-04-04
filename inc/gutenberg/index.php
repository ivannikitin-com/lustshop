<?php

add_theme_support( 'align-wide' );

// Editor Styles
add_theme_support( 'editor-styles' );
add_editor_style( 'dist/editor-style.css' );


// Change color scheme
require __DIR__ . '/gutenberg-colors.php';

// Add theme font-size
require __DIR__ . '/gutenberg-fonts.php';
