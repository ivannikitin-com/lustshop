<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( $recently_products ) : ?>

    <section class="recently products">

        <?php
        $heading = apply_filters( 'product_recently_products_heading', __( 'You watch', 'lustshop' ) );

        if ( $heading ) :
            ?>
            <h2 class="recently__title"><?php echo esc_html( $heading ); ?></h2>
        <?php endif; ?>

        <div class="recently__carousel">
            <?php foreach ( $recently_products as $recently_product ) : ?>

                <?php
                $post_object = get_post( $recently_product->get_id() );

                setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

                wc_get_template_part( 'content', 'product' );
                ?>

            <?php endforeach; ?>
        </div>
    </section>
<?php
endif;

wp_reset_postdata();