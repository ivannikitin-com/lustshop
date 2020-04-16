<?php

class Lustshop_Woocommerce extends LustShop {
  public function __construct() {
    $this->content_poroducts();
  }

  public function content_poroducts() {
    remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
    add_action( 'woocommerce_before_shop_loop_item_title', array($this, 'template_loop_product_link_open'), 9 );
    add_action( 'woocommerce_before_shop_loop_item_title', array($this, 'template_loop_product_thumbnail'), 10 );
    add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11 );

    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
    add_action( 'woocommerce_shop_loop_item_title', array( $this, 'shop_loop_item_title_before' ), 5 );
    add_action( 'woocommerce_shop_loop_item_title', array( $this, 'template_loop_product_title' ), 6 );
    add_action( 'woocommerce_shop_loop_item_title', array( $this, 'shop_loop_item_rating_before' ), 7 );
    add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 8 );
    add_action( 'woocommerce_shop_loop_item_title', array( $this, 'template_loop_review' ), 9 );
    add_action( 'woocommerce_shop_loop_item_title', array( $this, 'shop_loop_item_rating_after' ), 10 );
    add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_price', 11 );
    add_action( 'woocommerce_shop_loop_item_title', array( $this, 'template_loop_product_play' ), 12 );
    add_action( 'woocommerce_shop_loop_item_title', array( $this, 'shop_loop_item_title_after' ), 15 );

    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
  }

  public function template_loop_product_thumbnail( $size = 'lustshop-slider-product' ) {
    global $product;
    
    $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
  
    echo $product ? $product->get_image( $image_size ) : '';
  }

  public function template_loop_product_link_open() {
    global $product;
  
    $link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
  
    echo '<a href="' . esc_url( $link ) . '" class="product__link">';
  }

  public function shop_loop_item_title_before() {
    echo '<div class="product__content">';
  }

  public function shop_loop_item_title_after() {
    echo '</div>';
  }

  public function shop_loop_item_rating_before() {
    echo '<div class="product__star-rating">';
  }

  public function shop_loop_item_rating_after() {
    echo '</div>';
  }

  public function template_loop_product_title() {
    echo '<h2 class="' . esc_attr( apply_filters( 'woocommerce_product_loop_title_classes', 'product__title' ) ) . '">' . get_the_title() . '</h2>';
  }

  public function template_loop_review() {
    global $product;

    $rating_count = $product->get_rating_count();
    $review_count = $product->get_review_count();
    $average      = $product->get_average_rating();

    ?>
    <a href="<?php echo get_permalink() ?>#reviews" class="product__reviews">
      <?php 
      switch ($review_count) {
        case 0:
          echo esc_html__( 'not reviews', 'lustshop' ); 
          break;
        
        default:
          printf( _nx( '%s reviews', '%s reviews', $review_count, 'reviews product', 'lustshop' ), number_format_i18n( $review_count ) ); 
          break;
      }        
      ?>
      </a>
    <?php
  }

  public function template_loop_product_play() {
    echo '<a href="#" class="play"><span></span></a>';
  }
}

new Lustshop_Woocommerce();
