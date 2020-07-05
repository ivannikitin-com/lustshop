<?php


if (!class_exists('Lustshop_Woocomerce_Review')) {
    class Lustshop_Woocomerce_Review extends Lustshop_Woocommerce
    {
        public function __construct()
        {
            $this->override_functions();
        }

        public function override_functions()
        {
            // woocommerce_review_before
            add_action('woocommerce_review_before', [$this, 'before_wrapper_header'], 5);
            add_action('woocommerce_review_before', [$this, 'before_wrapper_avatar'], 9);
            add_action('woocommerce_review_before', [$this, 'after_wrapper_avatar'], 11);
            add_action('woocommerce_review_before', [$this, 'header_content'], 20);
            add_action('woocommerce_review_before', [$this, 'after_wrapper_header'], 25);

            // woocommerce_review_before_comment_meta
            remove_action('woocommerce_review_before_comment_meta', 'woocommerce_review_display_rating', 10);

            // woocommerce_review_meta
            remove_action('woocommerce_review_meta', 'woocommerce_review_display_meta', 10);
            add_action('woocommerce_review_meta', [$this, 'comments_content'], 10);

            // woocommerce_review_comment_text
            remove_action('woocommerce_review_comment_text', 'woocommerce_review_display_comment_text', 10);

            add_filter('woocommerce_review_gravatar_size', '73');
            add_filter('woocommerce_reviews_title', [$this, 'review_title']);
        }

        public function review_title()
        {
            global  $product;

            $count = $product->get_review_count();
            $reviews_title = printf(
            /* translators: 1: title. */
                esc_html__( 'Reviews %1$s', 'lustshop' ),
                '<span class="comments__title-number">(' . number_format_i18n( $count ) . ')</span>'
            );
        }

        public function before_wrapper_header()
        {
            echo '<div class="comments__header">';
        }

        public function after_wrapper_header()
        {
            echo '</div>';
        }

        public function before_wrapper_avatar()
        {
            echo '<div class="comments__avatar">';
        }

        public function after_wrapper_avatar()
        {
            echo '</div>';
        }

        public function header_content()
        {
            ?>
            <div>
                <span class="comments__author"><?php comment_author(); ?></span>
                <span class="comments__date"><?php comment_date('j F Y'); ?></span>
                <div class="comments__body d-none d-lg-block">
                    <?php comment_text(); ?>

                    <div class="comments__reply">
                        <?php comment_reply_link(
                            array_merge($args, [
                                'add_below' => $add_below,
                                'depth' => $depth,
                                'max_depth' => $args['max_depth'],
                            ])
                        ); ?>

                        <?php edit_comment_link(__('(Edit)'), '  ', ''); ?>
                    </div>
                </div>
            </div>
            <?php
        }

        public function comments_content()
        {
            ?>
            <div class="comments__body d-block d-lg-none">
                <?php comment_text(); ?>

                <div class="comments__reply">
                    <?php comment_reply_link(
                        array_merge($args, [
                            'add_below' => $add_below,
                            'depth' => $depth,
                            'max_depth' => $args['max_depth'],
                        ])
                    ); ?>

                    <?php edit_comment_link(__('(Edit)'), '  ', ''); ?>
                </div>
            </div>
            <?php
        }
    }

    new Lustshop_Woocomerce_Review();
}

