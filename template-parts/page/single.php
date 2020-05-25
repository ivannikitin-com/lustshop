<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lustshop
 */

if ( is_single() ) :
  $categories = get_the_terms( get_the_id(), 'category' );
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
  <header class="page-header single__header">
    <div class="single__image">
      <?php get_the_post_thumbnail( $post->ID ) ? the_post_thumbnail( 'lustshop-single-thumbnail' ) : 	get_template_part('template-parts/components/placeholder') ; ?>
    </div>
    <div class="single__info">
      <div class="single__container">
        <?php 
          if ( is_single() ) :
            foreach( $categories as $category ) :
              echo '<a class="post__category post__category--pink" href="'. get_category_link($category->term_id) .'">'. $category->name .'</a>';
            endforeach;
          endif;
        ?>
        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        <div class="post__date">
          <time datetime="<?php echo esc_attr( get_the_date( 'c', $post ) ) ?>"><?php echo esc_html( get_the_date( '', $post ) ) ?></time>
        </div>
      </div>
    </div>
	</header><!-- .entry-header -->

	<div class="entry-content">
    <div class="single__container">
		  <?php the_content(); ?>
    </div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
