<?php

class Lustshop_Woocommerce extends LustShop
{
    public function __construct()
    {
        $this->content_poroducts();
        $this->archive_product();

        //  Customize classes plugins
        $this->change_position_compare();
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

    public function change_position_compare() {
        if (class_exists('YITH_Woocompare_Frontend')) {
            global $yith_woocompare;

            remove_action('woocommerce_single_product_summary', array($yith_woocompare->obj, 'add_compare_link'), 35);
            remove_action('woocommerce_after_shop_loop_item', array($yith_woocompare->obj, 'add_compare_link'), 20);
            add_action('woocommerce_shop_loop_item_title', array($yith_woocompare->obj, 'add_compare_link'), 17);
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

    public function template_loop_review()
    {
        global $product;

        $rating_count = $product->get_rating_count();
        $review_count = $product->get_review_count();
        $average = $product->get_average_rating();
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
        add_action('woocommerce_before_main_content', [$this, 'woocommerce_before_main_content_container'], 15);

        remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
        add_action('woocommerce_after_shop_loop', [$this, 'woocommerce_pagination'], 10);

        add_action('woocommerce_after_main_content', [$this, 'woocommerce_after_main_contentcontainer'], 5);

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

    public function woocommerce_before_main_content_container()
    {
        echo '<div class="container">';
    }

    public function woocommerce_after_main_contentcontainer()
    {
        echo '</div>';
    }

    public function woocommerce_pagination()
    {
        get_template_part('template-parts/components/pagination');
    }
}

new Lustshop_Woocommerce();
