<?php

add_action( 'wp_enqueue_scripts', function() {
  $version = wp_get_theme()->get( 'Version' );

  wp_register_style( 'lustshop/blog', 
    get_template_directory_uri() . '/dist/css/blocks/blog/frontend.css', 
    null,
    $version
  );

} ); 

add_filter( 'render_block', function($block_content, $block) {
  
	if ( 'lustshop/blog' === $block['blockName'] ) {
		ob_start();
		wp_print_styles( $block['blockName'] );
		$block_content = ob_get_clean() . $block_content;
	}

	return $block_content;
}, 10, 2 );
