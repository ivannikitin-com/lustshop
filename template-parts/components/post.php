<?php  
$categories = wp_get_post_categories( $post->ID, array('fields' => 'all') );
?>

<div class="post__item">
  <div class="row">
    <div class="col-lg-5">
      <div class="post__image">
        <a href="<?php echo get_permalink($post); ?>">
          <?php echo get_the_post_thumbnail($post, 'lustshop-post-thumbnail') ?: 	get_template_part('template-parts/components/placeholder') ; ?>
        </a>
      </div>
    </div>
    <div class="col-lg-7">
      <?php 
        foreach( $categories as $category ){
          echo '<a class="post__category" href="'. get_category_link($category->term_id) .'">'. $category->name .'</a>';
        }
      ?>
      <h4 class="post__title">
        <a href="<?php echo get_permalink($post); ?>">
          <?php echo get_the_title($post); ?>  
        </a>
      </h4>
      <div class="post__description">
        <?php echo get_the_excerpt($post); ?>
      </div>
      <div class="post__date">
        <time datetime="<?php echo esc_attr( get_the_date( 'c', $post ) ) ?>"><?php echo esc_html( get_the_date( '', $post ) ) ?></time>
      </div>
    </div>
  </div>
</div>