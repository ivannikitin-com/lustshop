<?php
function render_block_lustshop_blog( $attributes ) {
	$args = array(
		'posts_per_page'   => $attributes['postsToShow'],
		'post_status'      => 'publish',
		'order'            => $attributes['order'],
		'orderby'          => $attributes['orderBy'],
		'suppress_filters' => false,
	);

	$class = 'wp-block-lustshop-blog';

	if ( isset( $attributes['className'] ) ) {
		$class .= ' ' . $attributes['className'];
	}

	if ( isset( $attributes['categories'] ) ) {
		$args['category'] = $attributes['categories'];
	}

	$recent_posts = get_posts( $args );
	$list_items_markup = '';
	$excerpt_length = $attributes['excerptLength'];

	foreach ( $recent_posts as $post ) {
		$title = get_the_title( $post );
		if ( ! $title ) {
			$title = __( '(no title)' );
		}

		$categoriesHtml = '';
		$categories = wp_get_post_categories( $post->ID, array('fields' => 'all') );
		foreach( $categories as $category ){
			$categoriesHtml .= '<a href='. get_category_link($category->term_id) .'>'. $category->name .'</a>';
		}


		$list_items_markup .= sprintf(
			'
			<article class="'. $class .'__post-grid">
				<div class="'. $class .'__post-image">
					%1$s
				</div>
				<div class="'. $class .'__post-body">
					<div class="'. $class .'__post-cat">
						%2$s
					</div>
					<a href="%3$s" class="'. $class .'__post-title">%4$s</a>
			',
			get_the_post_thumbnail( $post, 'lustshop-blog-thumbnail' ),
			$categoriesHtml,
			esc_url( get_permalink( $post ) ),
			$title
		);

		if ( isset( $attributes['displayPostContent'] ) && $attributes['displayPostContent'] ) {
			$post_excerpt = $post->post_excerpt;
			if ( ! ( $post_excerpt ) ) {
				$post_excerpt = $post->post_content;
			}
			$trimmed_excerpt = esc_html( wp_trim_words( $post_excerpt, $excerpt_length, ' &hellip; ' ) );
			$list_items_markup .= sprintf(
				'<div class="'. $class .'__card-text">%1$s</div>',
				$trimmed_excerpt
			);
		}

		if ( isset( $attributes['displayPostDate'] ) && $attributes['displayPostDate'] ) {
			$list_items_markup .= sprintf(
				'
				<div class="'. $class .'__post-meta">
					<time datetime="%1$s" class="'. $class .'__meta-date">%2$s</time>
				</div>
				',
				esc_attr( get_the_date( 'c', $post ) ),
				esc_html( get_the_date( '', $post ) )
			);
		}

		$list_items_markup .= "</div></article>\n";
	}

	$buttonContent = '';

	if ( isset( $attributes['showButton'] ) && $attributes['showButton'] ) {
		$buttonLink = '#';
		$buttonText = '';

		if ( isset( $attributes['link'] ) && $attributes['link'] ) {
			$buttonLink = $attributes['link'];
		}

		if ( isset( $attributes['textButton'] ) && $attributes['textButton'] ) {
			$buttonText = $attributes['textButton'];
		}

		$buttonContent .= sprintf(
			'
			<div class="wp-block-lustshop-blog__button">
				<a class="wp-block-lustshop-button" href="%1$s">
				%2$s
				<svg class="icon"
					xmlns="http://www.w3.org/2000/svg"
					xmlns:xlink="http://www.w3.org/1999/xlink"
					width="7px" height="12px">
					<path fill-rule="evenodd"  fill="currentColor"
					d="M6.992,5.999 C6.992,6.255 6.895,6.511 6.700,6.705 L1.712,11.705 C1.321,12.096 0.689,12.096 0.298,11.707 C-0.094,11.316 -0.092,10.683 0.297,10.293 L4.580,5.999 L0.297,1.705 C-0.092,1.314 -0.094,0.681 0.298,0.291 C0.689,-0.099 1.321,-0.099 1.712,0.293 L6.700,5.293 C6.895,5.487 6.992,5.743 6.992,5.999 Z"/>
				</svg>
				</a>
			</div>
			',
			$buttonLink,
			$buttonText
		);
	}

	return sprintf(
		'
		<div class="%1$s">
			<div class="container">
				<div class="wp-block-lustshop-blog__header">
					<div class="col-md-auto">
						<h2 class="wp-block-lustshop-blog__title">%3$s</h2>
					</div>
				</div>
				<div class="wp-block-lustshop-blog__posts-container">
					%2$s
				</div>
				%4$s
			</div>
		</div>',
		esc_attr( $class ),
		$list_items_markup,
		$attributes['title'],
		$buttonContent
	);
}

function register_block_lustshop_blog() {
	register_block_type(
		'lustshop/blog',
		array(
			'attributes'      => array(
				'className'               => array(
					'type' => 'string',
				),
				'categories'              => array(
					'type' => 'string',
				),
				'postsToShow'             => array(
					'type'    => 'number',
					'default' => 3,
				),
				'displayPostContent'      => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'excerptLength'           => array(
					'type'    => 'number',
					'default' => 55,
				),
				'displayPostDate'         => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'order'                   => array(
					'type'    => 'string',
					'default' => 'desc',
				),
				'orderBy'                 => array(
					'type'    => 'string',
					'default' => 'date',
				),
				'title'										=> array(
					'type'		=> 'string',
					'default' => __( 'Title', 'lustshop' )
				),
				'link'										=> array(
					'type'		=> 'string',
				),
				'textButton'							=> array(
					'type'		=> 'string'
				),
				'showButton'							=> array(
					'type'		=> 'boolean',
					'default'	=> false
				),
			),
			'render_callback' => 'render_block_lustshop_blog',
		)
	);
}
add_action( 'init', 'register_block_lustshop_blog' );