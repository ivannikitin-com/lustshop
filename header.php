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
            <span class="header__login"><svg height="21" width="21" viewBox="0 0 512 512" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
                <path
                  d="m512 256c0-141.488281-114.496094-256-256-256-141.488281 0-256 114.496094-256 256 0 140.234375 113.539062 256 256 256 141.875 0 256-115.121094 256-256zm-256-226c124.617188 0 226 101.382812 226 226 0 45.585938-13.558594 89.402344-38.703125 126.515625-100.96875-108.609375-273.441406-108.804687-374.59375 0-25.144531-37.113281-38.703125-80.929687-38.703125-126.515625 0-124.617188 101.382812-226 226-226zm-168.585938 376.5c89.773438-100.695312 247.421876-100.671875 337.167969 0-90.074219 100.773438-247.054687 100.804688-337.167969 0zm0 0" />
                <path
                  d="m256 271c49.625 0 90-40.375 90-90v-30c0-49.625-40.375-90-90-90s-90 40.375-90 90v30c0 49.625 40.375 90 90 90zm-60-120c0-33.085938 26.914062-60 60-60s60 26.914062 60 60v30c0 33.085938-26.914062 60-60 60s-60-26.914062-60-60zm0 0" />
              </svg></span>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
              <?php _e('My account', 'lustshop'); ?>
            </a>
            <?php else: ?>
            <span class="header__login"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="18">
                <path fill="currentColor" fill-rule="evenodd"
                  d="M19.95 17.998H9.053a.994.994 0 0 1-.989-1v-5c0-.552.443-1 .989-1 .547 0 .99.448.99 1v4.001h8.917V1.998h-8.917v4.001a.994.994 0 0 1-.99.999.994.994 0 0 1-.989-.999V.998c0-.552.443-1 .989-1H19.95c.546 0 .989.448.989 1v16c0 .553-.443 1-.989 1zM11.225 6.377a1.008 1.008 0 0 1-.117-1.409.984.984 0 0 1 1.395-.118l3.955 3.379a.782.782 0 0 1 .06.055h.001l.001.001.028.029.001.001c.163.178.265.415.266.677v.006a1.001 1.001 0 0 1-.356.767l-3.956 3.382a.985.985 0 0 1-.638.237.985.985 0 0 1-.757-.356 1.008 1.008 0 0 1 .117-1.409l1.897-1.622-11.214.001a.994.994 0 0 1-.989-1c0-.552.442-1 .989-1l11.214-.001-1.897-1.62z" />
              </svg></span>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="19.97" height="18" viewBox="0 0 19.97 18">
                  <path
                    d="M9.98 18a1.011 1.011 0 0 1-.57-.174C3.07 13.532-.01 9.483-.01 5.444A5.474 5.474 0 0 1 5.49 0a5.963 5.963 0 0 0 8.98 0 5.48 5.48 0 0 1 5.5 5.444c0 4.039-3.09 8.089-9.42 12.382a1.035 1.035 0 0 1-.57.174zM5.49 2a3.465 3.465 0 0 0-3.48 3.444c0 3.171 2.68 6.647 7.97 10.338 5.28-3.691 7.97-7.167 7.97-10.338A3.472 3.472 0 0 0 14.47 2a3.854 3.854 0 0 0-3.54 2.3 1.02 1.02 0 0 1-.95.659 1 1 0 0 1-.95-.659A3.864 3.864 0 0 0 5.49 2z"
                    fill="currentColor" fill-rule="evenodd" /></svg>
                <span class="header__block-item-count">
                  <span>
                    <?php
                    $wishlist_count = YITH_WCWL()->count_products();
                    echo $wishlist_count;
                    ?>
                  </span>
                </span>
              </a>
            </div>
            <?php echo do_shortcode('[yith_woocompare_counter]'); ?>
            <div class="mini-cart header__block-item">
              <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="26.97" height="22" viewBox="0 0 26.97 22">
                  <path data-name="-e-icon-cart"
                    d="M26.91 5.325l-3 10.049a.987.987 0 0 1-.95.717H9.98a1.006 1.006 0 0 1-.95-.688L4.27 2.017H.99a1.005 1.005 0 0 1 0-2.01h4a1.006 1.006 0 0 1 .95.688l1.43 3.336h18.58a.976.976 0 0 1 .8.4 1.008 1.008 0 0 1 .16.894zm-18.87.717l2.66 8.04h11.52l2.39-8.04H8.04zm3.34 10.463a2.747 2.747 0 1 1-2.73 2.746 2.744 2.744 0 0 1 2.73-2.747zm0 3.483a.737.737 0 1 0-.73-.737.736.736 0 0 0 .73.736zm10.38-3.483a2.747 2.747 0 1 1-2.73 2.746 2.744 2.744 0 0 1 2.73-2.747zm0 3.483a.737.737 0 1 0-.73-.737.736.736 0 0 0 .73.736z"
                    fill="currentColor" fill-rule="evenodd" /></svg>
                <span class="header__block-item-count"><span>2</span>
              </a>
            </div>
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
            <span class="header__login"><svg height="21" width="21" viewBox="0 0 512 512" fill="currentColor"
                xmlns="http://www.w3.org/2000/svg">
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
          
					<?php wp_nav_menu( array(
						'theme_location'  => 'main-mobile',
						'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
						'container'       => 'div',
						'container_class' => 'navbar-menu-mobile',
						'container_id'    => '',
						'menu_class'      => 'navbar-nav menu-glavnoe-mobile',
						'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker(),
				) ); ?>
				</nav>
			</div>
		</div>
	</header>
	<div class="wrapper">
