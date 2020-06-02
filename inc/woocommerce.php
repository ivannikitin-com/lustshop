<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package lustshop
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function lustshop_woocommerce_setup()
{
    add_theme_support('woocommerce');
    remove_theme_support('wc-product-gallery-zoom');
    remove_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'lustshop_woocommerce_setup');

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function lustshop_woocommerce_active_body_class($classes)
{
    $classes[] = 'woocommerce-active';

    return $classes;
}
add_filter('body_class', 'lustshop_woocommerce_active_body_class');

/**
 * Products per page.
 *
 * @return integer number of products.
 */
function lustshop_woocommerce_products_per_page()
{
    return 15;
}
add_filter('loop_shop_per_page', 'lustshop_woocommerce_products_per_page');

/**
 * Product gallery thumnbail columns.
 *
 * @return integer number of columns.
 */
function lustshop_woocommerce_thumbnail_columns()
{
    return 4;
}
add_filter('woocommerce_product_thumbnails_columns', 'lustshop_woocommerce_thumbnail_columns');

/**
 * Default loop columns on product archives.
 *
 * @return integer products per row.
 */
function lustshop_woocommerce_loop_columns()
{
    return 3;
}
add_filter('loop_shop_columns', 'lustshop_woocommerce_loop_columns');

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function lustshop_woocommerce_related_products_args($args)
{
    $defaults = [
        'posts_per_page' => 10,
    ];

    $args = wp_parse_args($defaults, $args);

    return $args;
}
add_filter('woocommerce_output_related_products_args', 'lustshop_woocommerce_related_products_args');

if (!function_exists('lustshop_woocommerce_product_columns_wrapper')) {
    /**
     * Product columns wrapper.
     *
     * @return  void
     */
    function lustshop_woocommerce_product_columns_wrapper()
    {
        $columns = lustshop_woocommerce_loop_columns();
        echo '<div class="columns-' . absint($columns) . '">';
    }
}
add_action('woocommerce_before_shop_loop', 'lustshop_woocommerce_product_columns_wrapper', 40);

if (!function_exists('lustshop_woocommerce_product_columns_wrapper_close')) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function lustshop_woocommerce_product_columns_wrapper_close()
    {
        echo '</div>';
    }
}
add_action('woocommerce_after_shop_loop', 'lustshop_woocommerce_product_columns_wrapper_close', 40);

/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

if (!function_exists('lustshop_woocommerce_wrapper_before')) {
    /**
     * Before Content.
     *
     * Wraps all WooCommerce content in wrappers which match the theme markup.
     *
     * @return void
     */
    function lustshop_woocommerce_wrapper_before()
    {
        ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
    }
}
add_action('woocommerce_before_main_content', 'lustshop_woocommerce_wrapper_before');

if (!function_exists('lustshop_woocommerce_wrapper_after')) {
    /**
     * After Content.
     *
     * Closes the wrapping divs.
     *
     * @return void
     */
    function lustshop_woocommerce_wrapper_after()
    {
        ?>
			</main><!-- #main -->
		</div><!-- #primary -->
		<?php
    }
}
add_action('woocommerce_after_main_content', 'lustshop_woocommerce_wrapper_after');

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'lustshop_woocommerce_header_cart' ) ) {
			lustshop_woocommerce_header_cart();
		}
	?>
 */

if (!function_exists('lustshop_woocommerce_cart_link_fragment')) {
    /**
     * Cart Fragments.
     *
     * Ensure cart contents update when products are added to the cart via AJAX.
     *
     * @param array $fragments Fragments to refresh via AJAX.
     * @return array Fragments to refresh via AJAX.
     */
    function lustshop_woocommerce_cart_link_fragment($fragments)
    {
        ob_start();
        lustshop_woocommerce_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'lustshop_woocommerce_cart_link_fragment');

if (!function_exists('lustshop_woocommerce_cart_link')) {
    /**
     * Cart Link.
     *
     * Displayed a link to the cart including the number of items present and the cart total.
     *
     * @return void
     */
    function lustshop_woocommerce_cart_link()
    {
        ?>
        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-contents">
            <svg xmlns="http://www.w3.org/2000/svg" width="26.97" height="22" viewBox="0 0 26.97 22">
                <path data-name="-e-icon-cart"
                      d="M26.91 5.325l-3 10.049a.987.987 0 0 1-.95.717H9.98a1.006 1.006 0 0 1-.95-.688L4.27 2.017H.99a1.005 1.005 0 0 1 0-2.01h4a1.006 1.006 0 0 1 .95.688l1.43 3.336h18.58a.976.976 0 0 1 .8.4 1.008 1.008 0 0 1 .16.894zm-18.87.717l2.66 8.04h11.52l2.39-8.04H8.04zm3.34 10.463a2.747 2.747 0 1 1-2.73 2.746 2.744 2.744 0 0 1 2.73-2.747zm0 3.483a.737.737 0 1 0-.73-.737.736.736 0 0 0 .73.736zm10.38-3.483a2.747 2.747 0 1 1-2.73 2.746 2.744 2.744 0 0 1 2.73-2.747zm0 3.483a.737.737 0 1 0-.73-.737.736.736 0 0 0 .73.736z"
                      fill="currentColor" fill-rule="evenodd" /></svg>
            <span class="header__block-item-count amount"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </a>
		<?php
    }
}

if (!function_exists('lustshop_woocommerce_header_cart')) {
    /**
     * Display Header Cart.
     *
     * @return void
     */
    function lustshop_woocommerce_header_cart()
    {
        ?>
		<div id="site-header-cart" class="site-header-cart mini-cart header__block-item">
            <?php lustshop_woocommerce_cart_link(); ?>
		</div>
		<?php
    }
}
