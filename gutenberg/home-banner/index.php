<?php
function render_block_lustshop_home_banner ($attributes) {
	ob_start();
	?>
		<div class="lutshop-home-banner" style="background: #1e2027 url(<?php echo get_bloginfo('template_directory'); ?>/src/img/home-banner/bg-main-1.jpg) 50% 0 no-repeat; background-size: cover;">
			<div class="lutshop-home-banner__item">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 lutshop-home-banner__info">
							<div class="lutshop-home-banner__title" style="color: #fff;"><?php echo $attributes['title']; ?></div>
							<div class="lutshop-home-banner__description">
								<img src="<?php echo get_bloginfo('template_directory'); ?>/src/img/home-banner/rabbit.png" width="125" height="124">
								<div class="lutshop-home-banner__text"><p><?php echo $attributes['description']; ?></p>
									<div class="lutshop-home-banner__autor"><?php _e('Naughty <sup>Rabbit</sup>', 'lustshop'); ?></div>
								</div>
							</div>
						<div class="mt-5"><a href="<?php echo $attributes['buttonLink']; ?>" class="wp-block-lustshop-button wp-block-lustshop-button--primary lutshop-home-banner__button"><?php echo $attributes['buttonName']; ?> <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12"><path data-name="-e-arrow-white" d="M6.99 6a1.011 1.011 0 0 1-.29.706l-4.99 5A1 1 0 1 1 .3 10.294L4.58 6 .3 1.706A1 1 0 1 1 1.71.294l4.99 5A1.011 1.011 0 0 1 6.99 6z" fill="#fff" fill-rule="evenodd"/></svg></a></div>
					</div>
					<div class="col-lg-6 lutshop-home-banner__picture d-none d-lg-block"><img src="<?php echo get_bloginfo('template_directory'); ?>/src/img/home-banner/girl-1-2.png" class="img-fluid lutshop-home-banner__img"></div>
					</div>
				</div>
			</div>
		</div>
	<?php
	return ob_get_clean();
}

function register_block_lustshop_home_banner() {
	register_block_type(
		'lustshop/home-banner',
		array(
			'attributes'      => array(
				'className'               => array(
					'type' => 'string',
				),
				'title' => array (
					'type' => 'string',
				),
				'description' => array(
					'type' => 'string'
				),
				'buttonName' => array(
					'type' => 'string'
				),
				'buttonLink' => array(
					'type' => 'string'
				),
				'align' => array(
					'type' => 'string',
					'default' => 'full'
				)
			),
			'render_callback' => 'render_block_lustshop_home_banner',
		)
	);
}
add_action( 'init', 'register_block_lustshop_home_banner' );
