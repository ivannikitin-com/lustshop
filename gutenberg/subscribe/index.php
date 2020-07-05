<?php

function render_block_lustshop_subscibe( $attributes ) {

	$class = 'wp-block-lustshop-subscribe';

	if ( isset( $attributes['className'] ) ) {
		$class .= ' ' . $attributes['className'];
	}

	return sprintf(
		'
		<div class="%1$s">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 d-none d-lg-block picture">
						%6$s
					</div>
					<div class="col-lg-6 '. $class .'__info">
						<div class="'. $class .'__prolog">%2$s</div>
						<h2 class="'. $class .'__section-title">%3$s</h2>
						<div class="'. $class .'__descr">
							%7$s
							<div class="'. $class .'__txt"><p>%4$s</p>
								<div class="'. $class .'__autor">%5$s</div>
							</div>
						</div>
						<div class="widget_wysija_cont shortcode_wysija">
							%8$s
						</div>
					</div>
				</div>
			</div>
		',
		esc_attr( $class ),
		$attributes['subtitle'],
		$attributes['title'],
		$attributes['description'],
		$attributes['ps'],
		wp_get_attachment_image($attributes['bgImageId'], 'full', false, array(
			'class' => 'img-fluid '. $class .'__img_main'
		)),
		wp_get_attachment_image($attributes['smallImageId'], array(125, 124), false),
		do_shortcode($attributes['shortcodeForm'])
	);
}

function register_block_lustshop_subscibe() {
	register_block_type(
		'lustshop/subscribe',
		array(
			'attributes'      => array(
				'className'               => array(
					'type' => 'string',
				),
				'subtitle' => array(
					'type' => 'string',
				),
				'title' => array(
					'type' => 'string',
				),
				'description' => array(
					'type' => 'string'
				),
				'ps' => array(
					'type' => 'string'
				),
				'bgImageId' => array(
					'type' => 'number'
				),
				'smallImageId' => array(
					'type' => 'number'
				),
				'shortcodeForm' => array(
					'type' => 'string'
				)
			),
			'render_callback' => 'render_block_lustshop_subscibe',
		)
	);
}
add_action( 'init', 'register_block_lustshop_subscibe' );
