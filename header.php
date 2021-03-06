<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lustshop
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<header class="header <?php if (is_front_page()) {
    echo 'header--absolute';
} ?>">
		<div class="header__top d-none d-lg-block">
			<div class="container">
				<nav class="navbar navbar-dark navbar-expand-md header__menu-top" id="menu_top">
					<button class="navbar-toggler my-2" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
						aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<?php wp_nav_menu([
                    'container' => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'navbarSupportedContent',
                    'menu_class' => 'navbar-nav',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'item_spacing' => 'preserve',
                    'depth' => 1,
                    'theme_location' => 'primary',
                    'link_class' => 'nav-link',
                    'fallback_cb' => '__return_empty_string',
                ]); ?>
					<?php if (class_exists('WooCommerce')): ?>
					<div class="header__account">
						<?php if (is_user_logged_in()): ?>
						<span class="header__login">
							<svg height="21" width="21" viewBox="0 0 512 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path
									d="m512 256c0-141.488281-114.496094-256-256-256-141.488281 0-256 114.496094-256 256 0 140.234375 113.539062 256 256 256 141.875 0 256-115.121094 256-256zm-256-226c124.617188 0 226 101.382812 226 226 0 45.585938-13.558594 89.402344-38.703125 126.515625-100.96875-108.609375-273.441406-108.804687-374.59375 0-25.144531-37.113281-38.703125-80.929687-38.703125-126.515625 0-124.617188 101.382812-226 226-226zm-168.585938 376.5c89.773438-100.695312 247.421876-100.671875 337.167969 0-90.074219 100.773438-247.054687 100.804688-337.167969 0zm0 0" />
								<path
									d="m256 271c49.625 0 90-40.375 90-90v-30c0-49.625-40.375-90-90-90s-90 40.375-90 90v30c0 49.625 40.375 90 90 90zm-60-120c0-33.085938 26.914062-60 60-60s60 26.914062 60 60v30c0 33.085938-26.914062 60-60 60s-60-26.914062-60-60zm0 0" />
							</svg>
						</span>
						<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
							<?php _e('My account', 'lustshop'); ?>
						</a>
						<?php else: ?>
						<span class="header__login">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="18">
								<path fill="currentColor" fill-rule="evenodd"
									d="M19.95 17.998H9.053a.994.994 0 0 1-.989-1v-5c0-.552.443-1 .989-1 .547 0 .99.448.99 1v4.001h8.917V1.998h-8.917v4.001a.994.994 0 0 1-.99.999.994.994 0 0 1-.989-.999V.998c0-.552.443-1 .989-1H19.95c.546 0 .989.448.989 1v16c0 .553-.443 1-.989 1zM11.225 6.377a1.008 1.008 0 0 1-.117-1.409.984.984 0 0 1 1.395-.118l3.955 3.379a.782.782 0 0 1 .06.055h.001l.001.001.028.029.001.001c.163.178.265.415.266.677v.006a1.001 1.001 0 0 1-.356.767l-3.956 3.382a.985.985 0 0 1-.638.237.985.985 0 0 1-.757-.356 1.008 1.008 0 0 1 .117-1.409l1.897-1.622-11.214.001a.994.994 0 0 1-.989-1c0-.552.442-1 .989-1l11.214-.001-1.897-1.62z" />
							</svg>
						</span>
						<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
							<?php _e('Login', 'lustshop'); ?>
							<span>&nbsp;/</span>
							<?php _e('Register', 'lustshop'); ?>
						</a>
						<?php endif; ?>
					</div>
					<?php endif; ?>
				</nav>
			</div>
		</div>

		<div class="header__main pt-lg-4 pt-3">
			<div class="container">
				<div class="row justify-content-between align-items-center mb-3">

					<button class="col-auto navbar-toggler d-lg-none header__toggle-button d-block" type="button"
						data-toggle="collapse" data-target="#navbar-2" aria-controls="navbar-2" aria-expanded="false"
						aria-label="Toggle navigation">
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" class="gamburger">
							<path fill="#FFF" fill-rule="evenodd"
								d="M21 10.999H1A1 1 0 1 1 1 9h20a1 1 0 1 1 0 1.999zm0-9H1a1 1 0 1 1 0-2h20a1 1 0 0 1 0 2zM1 18h20a1 1 0 1 1 0 2H1a1.001 1.001 0 0 1 0-2z" />
						</svg>
						<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" class="close">
							<path fill="#FFF" fill-rule="evenodd"
								d="M12.414 10.999l8.364 8.364a1 1 0 1 1-1.414 1.415L11 12.414l-8.364 8.364a1 1 0 1 1-1.414-1.415l8.364-8.364-8.364-8.363a1 1 0 1 1 1.414-1.415L11 9.585l8.364-8.364a1 1 0 1 1 1.414 1.415l-8.364 8.363z" />
						</svg>
						<!-- <span class="navbar-toggler-icon"></span> -->
					</button>

					<div class="col-auto col-sm-auto 2 col-xl-2 mb-lg-0 mb-lg-2">
						<div class="header__logo">
							<?php the_custom_logo(); ?>
							<span class="header__name-shop">
								<?php echo get_bloginfo('name'); ?>
							</span>
						</div>
					</div>
					<div class="col-auto col-sm-auto col-xl-2 mb-lg-0 mb-2 d-none d-lg-block">
						<?php if (get_theme_mod('lustshop_phone_number')): ?>
						<div class="header__phone">
							<a
								href="tel:<?php echo LustShop::filter_phone(get_theme_mod('lustshop_phone_number')); ?>"><?php echo get_theme_mod('lustshop_phone_number'); ?></a>
						</div>
						<?php endif; ?>
					</div>
					<div class="col-12 col-md-auto col-xl-5 mb-lg-0 mb-2 header__search d-none d-lg-block">
						<?php get_search_form(); ?>
					</div>
					<div class="col-auto col-xl-3 d-flex justify-content-end ml-lg-auto mb-lg-0 mb-2">
						<div class="wish header__block-item d-none d-lg-block">
							<a href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" width="21" height="18">
									<path fill="currentColor" fill-rule="evenodd"
										d="M10.916 17.999c-.199 0-.399-.058-.571-.174C4.007 13.531.926 9.482.926 5.443c0-3.002 2.467-5.444 5.5-5.444 1.728 0 3.405.801 4.49 2.039C12 .8 13.677-.001 15.405-.001c3.033 0 5.5 2.442 5.5 5.444 0 4.039-3.08 8.089-9.419 12.382a1.019 1.019 0 0 1-.57.174zm-4.49-16c-1.919 0-3.479 1.545-3.479 3.444 0 3.171 2.68 6.647 7.969 10.338 5.289-3.691 7.969-7.167 7.969-10.338 0-1.899-1.561-3.444-3.48-3.444-1.537 0-3.059.99-3.539 2.304a1.01 1.01 0 0 1-.95.659c-.426 0-.805-.263-.95-.659-.48-1.314-2.002-2.304-3.54-2.304z" />
									</svg>
								<span class="header__block-item-count">
									<?php
                                $wishlist_count = YITH_WCWL()->count_products();
                                echo $wishlist_count;
                                ?>
								</span>
							</a>
						</div>
						<?php echo do_shortcode('[yith_woocompare_counter]'); ?>
						<?php if (function_exists('lustshop_woocommerce_header_cart')) {
                        lustshop_woocommerce_header_cart();
                    } ?>
					</div>
				</div>
				<nav class="navbar-expand-lg mt-lg-4 d-lg-block d-none">
					<?php wp_nav_menu([
                    'container' => 'div',
                    'container_class' => 'header__main_menu',
                    'container_id' => '',
                    'menu_class' => 'navbar-nav',
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'item_spacing' => 'preserve',
                    'depth' => 1,
                    'theme_location' => 'main',
                    'link_class' => 'nav-link',
                    'fallback_cb' => '__return_empty_string',
                ]); ?>
				</nav>

				<nav id="navbar-2" class="navbar navbar-dark mt-lg-4 collapse navbar-collapse p-0 d-lg-none">
					<?php if (class_exists('WooCommerce')): ?>
					<div class="header__account header__account-mobile">
						<?php if (is_user_logged_in()): ?>
						<span class="header__login">
							<svg height="21" width="21" viewBox="0 0 512 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
								<path
									d="m512 256c0-141.488281-114.496094-256-256-256-141.488281 0-256 114.496094-256 256 0 140.234375 113.539062 256 256 256 141.875 0 256-115.121094 256-256zm-256-226c124.617188 0 226 101.382812 226 226 0 45.585938-13.558594 89.402344-38.703125 126.515625-100.96875-108.609375-273.441406-108.804687-374.59375 0-25.144531-37.113281-38.703125-80.929687-38.703125-126.515625 0-124.617188 101.382812-226 226-226zm-168.585938 376.5c89.773438-100.695312 247.421876-100.671875 337.167969 0-90.074219 100.773438-247.054687 100.804688-337.167969 0zm0 0" />
								<path
									d="m256 271c49.625 0 90-40.375 90-90v-30c0-49.625-40.375-90-90-90s-90 40.375-90 90v30c0 49.625 40.375 90 90 90zm-60-120c0-33.085938 26.914062-60 60-60s60 26.914062 60 60v30c0 33.085938-26.914062 60-60 60s-60-26.914062-60-60zm0 0" />
							</svg>
						</span>
						<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
							<?php _e('My account', 'lustshop'); ?>
						</a>
						<?php else: ?>
						<span class="header__login">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="18">
								<path fill="currentColor" fill-rule="evenodd"
									d="M19.95 17.998H9.053a.994.994 0 0 1-.989-1v-5c0-.552.443-1 .989-1 .547 0 .99.448.99 1v4.001h8.917V1.998h-8.917v4.001a.994.994 0 0 1-.99.999.994.994 0 0 1-.989-.999V.998c0-.552.443-1 .989-1H19.95c.546 0 .989.448.989 1v16c0 .553-.443 1-.989 1zM11.225 6.377a1.008 1.008 0 0 1-.117-1.409.984.984 0 0 1 1.395-.118l3.955 3.379a.782.782 0 0 1 .06.055h.001l.001.001.028.029.001.001c.163.178.265.415.266.677v.006a1.001 1.001 0 0 1-.356.767l-3.956 3.382a.985.985 0 0 1-.638.237.985.985 0 0 1-.757-.356 1.008 1.008 0 0 1 .117-1.409l1.897-1.622-11.214.001a.994.994 0 0 1-.989-1c0-.552.442-1 .989-1l11.214-.001-1.897-1.62z" />
							</svg>
						</span>
						<a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
							<?php _e('Login', 'lustshop'); ?>
							<span>&nbsp;/</span>
							<?php _e('Register', 'lustshop'); ?>
						</a>
						<?php endif; ?>
					</div>
					<?php endif; ?>

					<div class="header__search header__search-mobile w-100">
						<?php get_search_form(); ?>
					</div>

					<?php wp_nav_menu([
                    'theme_location' => 'main-mobile',
                    'depth' => 2, // 1 = no dropdowns, 2 = with dropdowns.
                    'container' => 'div',
                    'container_class' => 'navbar-menu-mobile',
                    'container_id' => '',
                    'menu_class' => 'navbar-nav menu-glavnoe-mobile',
                    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                    'walker' => new WP_Bootstrap_Navwalker(),
                ]); ?>
				</nav>
			</div>
		</div>
	</header>
	<div class="wrapper">