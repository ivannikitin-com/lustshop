<?php
$className = 'slider-products';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$products_id = get_field('products');
$title = get_field('title') ?: "" ;
$button = get_field('button');

$args = array(
  'post_type' => 'product',
  'orderby'     => 'date',
  'order'       => 'DESC',
  'include'     => $products_id,
  'suppress_filters' => true,
);

$products = new WP_Query($args);
?>

<div class="<?php echo $className; ?>">
  <div class="container">
    <h2><?php echo $title; ?></h2>
      <ul class="slider-products__carousel">
        <?php if ( $products->have_posts() ) :

          while ( $products->have_posts() ) : $products->the_post();
            wc_get_template_part( 'content', 'product' );
          endwhile;

          wp_reset_postdata();
        endif; ?>
      </ul>
      <div class="text-center">
        <a href="<?php echo $button['url']; ?>" class="product__button wp-block-lustshop-button wp-block-lustshop-button--primary"><?php echo $button['title']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12"><path fill="currentColor" fill-rule="evenodd" d="M6.992 5.999a.992.992 0 0 1-.292.706l-4.988 5a.999.999 0 1 1-1.415-1.412L4.58 5.999.297 1.705A1 1 0 1 1 1.712.293l4.988 5c.195.194.292.45.292.706z"/></svg></a>
      </div>
    </div>
  </div>
</div>
