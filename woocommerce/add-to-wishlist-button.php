<?php
/**
 * Add to wishlist button template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

/**
 * Template variables:
 *
 * @var $base_url string Current page url
 * @var $wishlist_url              string Url to wishlist page
 * @var $exists                    bool Whether current product is already in wishlist
 * @var $show_exists               bool Whether to show already in wishlist link on multi wishlist
 * @var $show_count                bool Whether to show count of times item was added to wishlist
 * @var $product_id                int Current product id
 * @var $parent_product_id         int Parent for current product
 * @var $product_type              string Current product type
 * @var $label                     string Button label
 * @var $browse_wishlist_text      string Browse wishlist text
 * @var $already_in_wishslist_text string Already in wishlist text
 * @var $product_added_text        string Product added text
 * @var $icon                      string Icon for Add to Wishlist button
 * @var $link_classes              string Classed for Add to Wishlist button
 * @var $available_multi_wishlist  bool Whether add to wishlist is available or not
 * @var $disable_wishlist          bool Whether wishlist is disabled or not
 * @var $template_part             string Template part
 * @var $container_classes         string Container classes
 */

if (!defined('YITH_WCWL')) {
    exit();
} // Exit if accessed directly

global $product;
?>


<?php if ($exists): ?>
    <a class="wp-block-lustshop-button product__wishlist" href="<?php echo esc_url($wishlist_url); ?>" rel="nofollow"
       data-title="<?php echo esc_attr($browse_wishlist_text); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="18">
            <path fill="currentColor" fill-rule="evenodd"
                  d="M10.916 18a1.02 1.02 0 0 1-.57-.175C4.008 13.532.926 9.482.926 5.444.926 2.442 3.394 0 6.426 0c1.728 0 3.405.8 4.49 2.039A6.074 6.074 0 0 1 15.406 0c3.033 0 5.5 2.442 5.5 5.444 0 4.039-3.081 8.089-9.42 12.381a1.017 1.017 0 0 1-.57.175zM6.426 2C4.508 2 2.947 3.545 2.947 5.444c0 3.171 2.68 6.646 7.969 10.338 5.289-3.692 7.969-7.167 7.969-10.338 0-1.899-1.56-3.444-3.479-3.444-1.538 0-3.059.99-3.54 2.303a1.01 1.01 0 0 1-.95.66 1.01 1.01 0 0 1-.95-.66C9.486 2.99 7.965 2 6.426 2z"/>
        </svg>
    </a>
<?php else: ?>
    <div class="yith-wcwl-add-button">
        <a href="<?php echo esc_url(add_query_arg('add_to_wishlist', $product_id, $base_url)); ?>" rel="nofollow"
           data-product-id="<?php echo esc_attr(
               $product_id
           ); ?>" data-product-type="<?php echo $product_type; ?>"
           data-original-product-id="<?php echo $parent_product_id; ?>"
           class="wp-block-lustshop-button product__wishlist <?php echo esc_attr(
               $link_classes
           ); ?>" data-title="<?php echo esc_attr(apply_filters('yith_wcwl_add_to_wishlist_title', $label)); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="18">
                <path fill="currentColor" fill-rule="evenodd"
                      d="M10.916 18a1.02 1.02 0 0 1-.57-.175C4.008 13.532.926 9.482.926 5.444.926 2.442 3.394 0 6.426 0c1.728 0 3.405.8 4.49 2.039A6.074 6.074 0 0 1 15.406 0c3.033 0 5.5 2.442 5.5 5.444 0 4.039-3.081 8.089-9.42 12.381a1.017 1.017 0 0 1-.57.175zM6.426 2C4.508 2 2.947 3.545 2.947 5.444c0 3.171 2.68 6.646 7.969 10.338 5.289-3.692 7.969-7.167 7.969-10.338 0-1.899-1.56-3.444-3.479-3.444-1.538 0-3.059.99-3.54 2.303a1.01 1.01 0 0 1-.95.66 1.01 1.01 0 0 1-.95-.66C9.486 2.99 7.965 2 6.426 2z"/>
            </svg>
        </a>
    </div>
<?php endif; ?>
