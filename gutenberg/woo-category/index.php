<?php
function render_block_lustshop_woo_category( $attributes ) {
	$class = 'wp-block-lustshop-woo-category';

	if ( isset( $attributes['className'] ) ) {
		$class .= ' ' . $attributes['className'];
  }

  $exclusive = '';
  if ( isset( $attributes['exclusive'] ) && $attributes['exclusive'] ) {
    $exclusive .= 'wp-block-lustshop-woo-category--exclusive';
  }

  if ( isset( $attributes['categoryId'] ) && $attributes['categoryId'] ) {
		$category = get_term_by( 'id', $attributes['categoryId'], 'product_cat' );
		$categoryName = $category->name;
		$categoryLink = get_term_link( $category->slug, 'product_cat' );
	
		$thumbnail_id = get_term_meta( $attributes['categoryId'], 'thumbnail_id', true );
		$image = wp_get_attachment_image( $thumbnail_id, null, null, array( 'class' => $class . "__img" ) );
	
		return sprintf(
			'
			<li class="%1$s %5$s">
				<a href="%3$s" class="%1$s__link">
					<div class="%1$s__wrap-img">
						%4$s
					</div>
					<h2 class="%1$s__title">%2$s</h2>
				</a>
			</li>
      ',
			esc_attr( $class ),
			esc_attr( $categoryName ),
			$categoryLink,
      $image,
      $exclusive
		);
	}
  
}

function register_block_lustshop_woo_category() {
	register_block_type(
		'lustshop/woo-category',
		array(
			'attributes'      => array(
				'className'               => array(
					'type' => 'string',
				),
				'categoryId'              => array(
					'type' => 'number',
				),
				'categoryName'             => array(
					'type'    => 'string',
				),
				'exclusive'      => array(
					'type'    => 'boolean',
					'default' => false,
				),
			),
			'render_callback' => 'render_block_lustshop_woo_category',
		)
	);
}
add_action( 'init', 'register_block_lustshop_woo_category' );
