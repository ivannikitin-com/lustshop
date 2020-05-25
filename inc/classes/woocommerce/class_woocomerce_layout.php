<?php

class Lustshop_Woocommerce extends LustShop
{
    public function __construct()
    {
        $this->content_poroducts();
        $this->archive_product();
        $this->single_product();

        //  Customize classes plugins
        $this->change_position_compare();
    }

    public function single_product()
    {
        // woocommerce_before_single_product_summary
        remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
        add_action('woocommerce_before_single_product_summary', [$this, 'single_product_open_col_6'], 10);
        add_action('woocommerce_before_single_product_summary', [$this, 'single_product_close_div'], 25);
        add_action('woocommerce_before_single_product_summary', [$this, 'single_product_open_col_6'], 25, 2);

        // woocommerce_single_product_summary
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10, 2);
        remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
        add_action('woocommerce_single_product_summary', [$this, 'wrapper_after_title_block'], 6);
        add_action('woocommerce_single_product_summary', [$this, 'view_sku'], 7);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 8);
        add_action('woocommerce_single_product_summary', [$this, 'template_loop_review'], 9);
        add_action('woocommerce_single_product_summary', [$this, 'single_product_close_div'], 9, 2);
        add_action('woocommerce_single_product_summary', [$this, 'wrapper_price_stock_open'], 10, 2);
        add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 11);
        add_action('woocommerce_single_product_summary', [$this, 'stock_product'], 12);
        add_action('woocommerce_single_product_summary', [$this, 'single_product_close_div'], 15);
        add_action('woocommerce_single_product_summary', [$this, 'wrapper_add_to_cart'], 25);
        add_action('woocommerce_single_product_summary', [$this, 'single_product_close_div'], 35);
        add_action('woocommerce_single_product_summary', 'woocommerce_product_additional_information_tab', 40);
        add_action('woocommerce_single_product_summary', [$this, 'single_product_close_div'], 70);

        // woocommerce_before_single_product
        add_action('woocommerce_before_single_product_summary', [$this, 'single_product_open_wrapper'], 5);

        // woocommerce_after_single_product_summary
        add_action('woocommerce_after_single_product_summary', [$this, 'single_product_open_col_12'], 5);
        add_action('woocommerce_after_single_product_summary', [$this, 'output_recently_products'], 25);
        add_action('woocommerce_after_single_product_summary', [$this, 'single_product_close_div'], 30);
        add_action('woocommerce_after_single_product_summary', [$this, 'single_product_close_div'], 30, 2);

        // woocommerce_after_add_to_cart_button
        add_action('woocommerce_after_add_to_cart_button', [$this, 'button_wishlist'], 33);

        // New metabox
        add_action('add_meta_boxes', [$this, 'create_payment_and_delivery_meta_box']);
        add_action('save_post', [$this, 'save_payment_and_delivery_meta_box'], 10, 1);

        add_filter('woocommerce_product_description_heading', '__return_empty_string');
        add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');
        add_filter('woocommerce_product_related_products_heading', [$this, 'related_product_title']);
        add_filter('woocommerce_single_product_image_thumbnail_html', [$this, 'single_product_image_thumbnail_html'], 10, 2);
        add_filter('woocommerce_gallery_image_size', [$this, 'gallery_image_size']);
        add_filter('woocommerce_gallery_thumbnail_size', [$this, 'gallery_thumbnail_size']);
        add_filter('woocommerce_product_tabs', [$this, 'add_product_tabs']);
        add_filter('woocommerce_product_tabs', [$this, 'woo_reorder_tabs'], 98);
        add_filter('woocommerce_product_tabs', [$this, 'woo_rename_tabs'], 98);
        add_filter('woocommerce_product_tabs', [$this, 'remove_product_tabs'], 98);
    }

    public function save_payment_and_delivery_meta_box($post_id)
    {
        $prefix = '_lustshop_';

        if (!isset($_POST['custom_payment_and_delivery_nonce'])) {
            return $post_id;
        }
        $nonce = $_REQUEST['custom_payment_and_delivery_nonce'];

        if (!wp_verify_nonce($nonce)) {
            return $post_id;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        if ('product' == $_POST['post_type']) {
            if (!current_user_can('edit_product', $post_id)) {
                return $post_id;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }

        update_post_meta($post_id, $prefix . 'payment_and_delivery_wysiwyg', wp_kses_post($_POST['payment_and_delivery_wysiwyg']));
    }

    public function create_payment_and_delivery_meta_box()
    {
        add_meta_box('payment_and_delivery_meta_box', __('Payment and delivery', 'lustshop'), [$this, 'add_payment_and_delivery_meta_box'], 'product', 'normal', 'default');
    }

    public function add_payment_and_delivery_meta_box($post)
    {
        $prefix = '_lustshop_';

        $payment_and_delivery = get_post_meta($post->ID, $prefix . 'payment_and_delivery_wysiwyg', true) ? get_post_meta($post->ID, $prefix . 'payment_and_delivery_wysiwyg', true) : '';
        $args['textarea_rows'] = 6;

        echo '<p>' . __('Payment and delivery', 'lustshop') . '</p>';
        wp_editor($payment_and_delivery, 'payment_and_delivery_wysiwyg', $args);
        echo '<input type="hidden" name="custom_payment_and_delivery_nonce" value="' . wp_create_nonce() . '">';
    }

    public function woo_rename_tabs($tabs)
    {
        global $product;

        $video_urls = api_pv_get_video_urls($product->get_id(), 'imported');
        $video_urls_count = count($video_urls);

        $tabs['api_pv_video_tab']['title'] .= ' <span class="tab-count">(' . $video_urls_count . ')</span>';
        $tabs['reviews']['title'] = __('Reviews', 'woocommerce') . ' <span class="tab-count">(' . $product->get_review_count() . ')</span>';

        return $tabs;
    }

    public function woo_reorder_tabs($tabs)
    {
        $tabs['description']['priority'] = 5;
        $tabs['reviews']['priority'] = 15;

        return $tabs;
    }

    public function add_product_tabs($tabs)
    {
        $tabs['payment_and_delivery'] = [
            'title' => __('Payment and delivery', 'lustshop'),
            'priority' => 20,
            'callback' => [$this, 'content_payment_and_delivery'],
        ];

        return $tabs;
    }

    public function content_payment_and_delivery()
    {
        global $post;

        $product_payment_and_delivery = get_post_meta($post->ID, '_lustshop_payment_and_delivery_wysiwyg', true);

        echo apply_filters('the_content', $product_payment_and_delivery);
    }

    public function remove_product_tabs($tabs)
    {
        global $product;

        $video_urls = api_pv_get_video_urls($product->get_id(), 'imported');
        $video_urls_count = count($video_urls);

        if ($video_urls_count == 0) {
            unset($tabs['api_pv_video_tab']);
        }

        if (!comments_open()) {
            unset($tabs['reviews']);
        }

        unset($tabs['additional_information']);

        return $tabs;
    }

    public function wrapper_add_to_cart()
    {
        echo "<div class='product__add-to-cart'>";
    }

    public function wrapper_after_title_block()
    {
        echo "<div class='product__after-title'>";
    }

    public function view_sku()
    {
        global $product;

        if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))): ?>

            <span class="product__sku"><?php esc_html_e('SKU:', 'woocommerce'); ?>
                <span class="sku">
                    <?php echo ($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'woocommerce'); ?>
                </span>
            </span>

        <?php endif;
    }

    public function gallery_thumbnail_size($array)
    {
        $array[0] = 115;
        $array[1] = 115;

        return $array;
    }

    public function gallery_image_size($size)
    {
        return 'lustshop-woo-flexslider';
    }

    public function single_product_image_thumbnail_html($html, $post_thumbnail_id)
    {
        global $product;

        if ($product->get_image_id()) {
            $newHTML = wc_get_gallery_image_html($post_thumbnail_id, true);
        } else {
            $newHTML = '<div class="woocommerce-product-gallery__image--placeholder">';
            $newHTML .= sprintf('<img src="%s" alt="%s" class="wp-post-image" />', esc_url(wc_placeholder_img_src('lustshop-woo-flexslider')), esc_html__('Awaiting product image', 'woocommerce'));
            $newHTML .= '</div>';
        }

        return $newHTML;
    }

    public function stock_product()
    {
        global $product;

        echo wc_get_stock_html($product);
    }

    public function wrapper_price_stock_open()
    {
        echo "<div class='product__price-stock'>";
    }

    public function output_recently_products()
    {
        $args = [
            'posts_per_page' => 10,
        ];

        $this->recently_products(apply_filters('output_recently_products_args', $args));
    }

    public function recently_products($args = [])
    {
        global $product;

        $viewed_products = !empty($_COOKIE['woocommerce_recently_viewed']) ? (array) explode('|', wp_unslash($_COOKIE['woocommerce_recently_viewed'])) : [];
        $viewed_products = array_filter(array_map('absint', $viewed_products));

        if (empty($viewed_products)) {
            return;
        }

        $defaults = [
            'posts_per_page' => 5,
            'no_found_rows' => 1,
            'post_status' => 'publish',
            'post_type' => 'product',
            'post__in' => $viewed_products,
            'orderby' => 'rand',
        ];

        $args = wp_parse_args($args, $defaults);

        $args['recently_products'] = array_filter(array_map('wc_get_product', wc_get_related_products($product->get_id(), $args['posts_per_page'], $product->get_upsell_ids())), 'wc_products_array_filter_visible');
        $args['related_products'] = wc_products_array_orderby($args['related_products'], $args['orderby'], $args['order']);

        wc_set_loop_prop('name', 'recently');

        wc_get_template('single-product/recently.php', $args);
    }

    public function related_product_title()
    {
        return __('You may like', 'lustshop');
    }

    public function single_product_open_col_12()
    {
        echo "<div class='col-lg-12'>";
    }

    public function single_product_open_col_6()
    {
        echo "<div class='col-lg-6'>";
    }

    public function single_product_open_wrapper()
    {
        echo "<div class='row'>";
    }

    public function single_product_close_div()
    {
        echo "</div>";
    }

    public function content_poroducts()
    {
        remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
        add_action('woocommerce_before_shop_loop_item', [$this, 'woocommerce_template_loop_product_open'], 10);

        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
        remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
        add_action('woocommerce_before_shop_loop_item_title', [$this, 'template_loop_product_link_open'], 9);
        add_action('woocommerce_before_shop_loop_item_title', [$this, 'template_loop_product_thumbnail'], 10);
        add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11);

        remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
        add_action('woocommerce_shop_loop_item_title', [$this, 'shop_loop_item_title_before'], 5);
        add_action('woocommerce_shop_loop_item_title', [$this, 'template_loop_product_title'], 6);
        add_action('woocommerce_shop_loop_item_title', [$this, 'shop_loop_item_rating_before'], 7);
        add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 8);
        add_action('woocommerce_shop_loop_item_title', [$this, 'template_loop_review'], 9);
        add_action('woocommerce_shop_loop_item_title', [$this, 'shop_loop_item_rating_after'], 10);
        add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 11);
        add_action('woocommerce_shop_loop_item_title', [$this, 'template_loop_product_play'], 12);
        add_action('woocommerce_shop_loop_item_title', [$this, 'woocommerce_start_add_to_card_wrapper'], 13);
        add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 15);
        add_action('woocommerce_shop_loop_item_title', [$this, 'button_wishlist'], 16);
        add_action('woocommerce_shop_loop_item_title', [$this, 'woocommerce_end_add_to_card_wrapper'], 19);
        add_action('woocommerce_shop_loop_item_title', [$this, 'shop_loop_item_title_after'], 20);

        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
        remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
        add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_close', 5);
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

        add_filter('woocommerce_loop_add_to_cart_args', [$this, 'loop_add_to_cart_args'], 10, 2);
    }

    public function change_position_compare()
    {
        if (class_exists('YITH_Woocompare_Frontend')) {
            global $yith_woocompare;

            remove_action('woocommerce_single_product_summary', [$yith_woocompare->obj, 'add_compare_link'], 35);
            remove_action('woocommerce_after_shop_loop_item', [$yith_woocompare->obj, 'add_compare_link'], 20);
            add_action('woocommerce_after_add_to_cart_button', [$yith_woocompare->obj, 'add_compare_link'], 34);
            add_action('woocommerce_shop_loop_item_title', [$yith_woocompare->obj, 'add_compare_link'], 17);
        }
    }

    public function button_wishlist()
    {
        echo do_shortcode('[yith_wcwl_add_to_wishlist]');
    }

    public function loop_add_to_cart_args($wp_parse_args, $product)
    {
        $wp_parse_args['class'] .= " wp-block-lustshop-button wp-block-lustshop-button--primary";

        return $wp_parse_args;
    }

    public function woocommerce_start_add_to_card_wrapper()
    {
        echo '<div class="product__buttons">';
    }

    public function woocommerce_end_add_to_card_wrapper()
    {
        echo '</div>';
    }

    public function woocommerce_template_loop_product_open()
    {
        echo '<div class="product__block">';
    }

    public function woocommerce_template_loop_product_close()
    {
        echo '</div>';
    }

    public function template_loop_product_thumbnail($size = 'lustshop-slider-product')
    {
        global $product;

        $image_size = apply_filters('single_product_archive_thumbnail_size', $size);

        echo $product ? $product->get_image($image_size) : '';
    }

    public function template_loop_product_link_open()
    {
        global $product;

        $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

        echo '<a href="' . esc_url($link) . '" class="product__link">';
    }

    public function shop_loop_item_title_before()
    {
        echo '<div class="product__content">';
    }

    public function shop_loop_item_title_after()
    {
        echo '</div>';
    }

    public function shop_loop_item_rating_before()
    {
        echo '<div class="product__star-rating">';
    }

    public function shop_loop_item_rating_after()
    {
        echo '</div>';
    }

    public function template_loop_product_title()
    {
        echo '<h2 class="' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'product__title')) . '">';
        woocommerce_template_loop_product_link_open();
        echo get_the_title();
        woocommerce_template_loop_product_link_close();
        echo '</h2>';
    }

    static function template_loop_review()
    {
        global $product;

        $review_count = $product->get_review_count();
        ?>
        <a href="<?php echo get_permalink(); ?>#reviews" class="product__reviews">
            <?php switch ($review_count) {
                case 0:
                    echo esc_html__('not reviews', 'lustshop');
                    break;

                default:
                    printf(_nx('%s reviews', '%s reviews', $review_count, 'reviews product', 'lustshop'), number_format_i18n($review_count));
                    break;
            } ?>
        </a>
        <?php
    }

    public function template_loop_product_play()
    {
        echo '<a href="#" class="play"><span></span></a>';
    }

    public function archive_product()
    {
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

        remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
        add_action('woocommerce_after_shop_loop', [$this, 'woocommerce_pagination'], 10);

        remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
        add_action('woocommerce_before_shop_loop', [$this, 'woocommerce_container_filter_before'], 15);
        // TODO: https://github.com/ivannikitin-com/lustshop/issues/64
        // add_action( 'woocommerce_before_shop_loop', array( $this, 'woocommerce_toggle_list_grid' ), 20 );
        add_action('woocommerce_before_shop_loop', [$this, 'woocommerce_container_filter_after'], 35);
    }

    public function woocommerce_container_filter_before()
    {
        echo '<div class="woo-archive__filter">';
    }

    public function woocommerce_container_filter_after()
    {
        echo '</div>';
    }

    public function woocommerce_toggle_list_grid()
    {
        get_template_part('template-parts/components/woo-toggle-list');
    }

    public function woocommerce_pagination()
    {
        get_template_part('template-parts/components/pagination');
    }
}

new Lustshop_Woocommerce();
