<?php
/**
 * lustshop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lustshop
 */

if ( ! function_exists( 'lustshop_setup' ) ) :
	function lustshop_setup() {

		load_theme_textdomain( 'lustshop', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', 'lustshop' ),
			'main' => esc_html__('Main', 'lustshop')
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		add_theme_support( 'custom-background', apply_filters( 'lustshop_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'lustshop_setup' );

add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lustshop_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lustshop' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'lustshop' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'lustshop' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'lustshop' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="footer__title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'lustshop' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'lustshop' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="footer__title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'lustshop' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'lustshop' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="footer__title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Social', 'lustshop' ),
		'id'            => 'footer-social',
		'description'   => esc_html__( 'Add widgets here.', 'lustshop' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="footer__title">',
		'after_title'   => '</div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Bottom', 'lustshop' ),
		'id'            => 'footer-bottom',
		'description'   => esc_html__( 'Add widgets here.', 'lustshop' ),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<div class="footer__title">',
		'after_title'   => '</div>',
	) );
}
add_action( 'widgets_init', 'lustshop_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function lustshop_scripts() {
  $version = wp_get_theme()->get('Version');

  wp_enqueue_style( 'lustshop-main', get_template_directory_uri() . '/build/style.css',  $version);

  wp_enqueue_script( 'lustshop-main', get_template_directory_uri() . '/build/index.js', null, $version, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'lustshop_scripts' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Gutenberg
 */
require get_template_directory() . '/inc/gutenberg/index.php';
require get_template_directory() . '/gutenberg/src/init.php';

/**
 * Optimize
 */
require get_template_directory() . '/inc/optimize.php';

/**
 * Custom functions
 */
require get_template_directory() . '/inc/custom-function.php';

/**
 * Remove assets plugins
 */
require get_template_directory() . '/inc/remove-plugin-assets.php';
