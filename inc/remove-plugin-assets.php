<?php

add_action( 'wp_print_styles', 'deregister_my_styles', 100 );
 
function deregister_my_styles() {
  wp_deregister_style( 'yith-wcwl-font-awesome' );
  wp_deregister_style( 'wc-block-style' );
  wp_deregister_style( 'contact-form-7' );
  wp_deregister_style( 'woocommerce_prettyPhoto_css' );

  wp_deregister_script( 'prettyPhoto' );
  wp_deregister_script( 'prettyPhoto-init' );
}
