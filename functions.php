<?php
/**
 * lustshop functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package lustshop
 */

class LustShop {
	protected $theme_name;
	protected $theme_version;

	public function __construct() {
		$version = wp_get_theme()->get('Version');

		$this->theme_name    = 'lustshop';
		$this->theme_version = $version;

		load_theme_textdomain( $this->theme_name, get_template_directory() . '/languages' );

		add_action( 'after_setup_theme', array( $this, 'theme_support',  ) );
		add_action( 'after_setup_theme', array( $this, 'nav_menu',  ) );
		add_action( 'after_setup_theme', array( $this, 'image_size',  ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'assets_include' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'disable_assests_plugins' ), 20 );
		if( function_exists('acf_register_block_type') ) {
			add_action('acf/init', array( $this, 'register_acf_block_types' ));
		}

		add_filter( 'wpcf7_autop_or_not', '__return_false' );

		$this->includes();
	}

	public function theme_support() {
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
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

	public function nav_menu() {
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary', $this->theme_name ),
			'main' => esc_html__('Main', $this->theme_name)
		) );
	}

	public function image_size() {
		add_image_size( $this->theme_name . '-slider-product', 279, 279, false );
		add_image_size( $this->theme_name . '-blog-thumbnail', 382, 252, false );
	}

	public function widgets_init() {
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

	public function assets_include() {
		wp_enqueue_style( $this->theme_name, get_template_directory_uri() . '/dist/style.css',  $this->theme_version);

		wp_enqueue_script( $this->theme_name, get_template_directory_uri() . '/dist/index.js', null, $this->theme_version, true );
	
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	public function disable_assests_plugins() {
	  wp_deregister_style( 'yith-wcwl-font-awesome' );
		wp_deregister_style( 'wc-block-style' );
		wp_deregister_style( 'contact-form-7' );
		wp_deregister_style( 'woocommerce_prettyPhoto_css' );
		wp_deregister_script( 'prettyPhoto' );
		wp_deregister_script( 'prettyPhoto-init' );
	}

	public function includes() {
		require get_template_directory() . '/inc/customizer.php';
		if ( class_exists( 'WooCommerce' ) ) {
			require get_template_directory() . '/inc/woocommerce.php';
			require get_template_directory() . '/inc/classes/woocommerce/class_woocomerce_theme.php';
		}
		require get_template_directory() . '/inc/gutenberg/index.php';
		require get_template_directory() . '/gutenberg/init.php';
		require get_template_directory() . '/inc/optimize.php';
		require get_template_directory() . '/inc/remove-plugin-assets.php';
	}

	static function filter_phone( $phone ) {
    $filter_phone = str_replace( array( ' ', '(', ')', '-' ), '', $phone );
    return $filter_phone;
  }

  public function add_menu_link_class( $atts, $item, $args ) {
    if (property_exists($args, 'link_class')) {
      $atts['class'] = $args->link_class;
    }
    return $atts;
  }

  public function change_nav_menu_objects($sorted_menu_items, $args) {
    if ( $args->theme_location === 'main' ) {
      $sorted_menu_items[count($sorted_menu_items)]->classes[] = 'last';
      $sorted_menu_items[count($sorted_menu_items)]->title .= '<svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"><path data-name="-e-arrow-white" d="M6.99 6a1.011 1.011 0 0 1-.29.706l-4.99 5A1 1 0 1 1 .3 10.294L4.58 6 .3 1.706A1 1 0 1 1 1.71.294l4.99 5A1.011 1.011 0 0 1 6.99 6z" fill="#fff" fill-rule="evenodd"/></svg>';
    }
    return $sorted_menu_items;
	}

	public function register_acf_block_types() {
		$this->register_block_type('woo-slider', __('Slider Products'));
	}
	
	public function register_block_type($name, $title) {
		acf_register_block_type(array(
			'name'              => $name,
			'title'             => $title,
			'render_template'   => 'template-parts/blocks/' . $name . '.php',
			'category'          => $this->theme_name,
		));
	}
}

new LustShop();
