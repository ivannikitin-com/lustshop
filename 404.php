<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package lustshop
 */

get_header();
?>

	<div id="primary" class="content-area h-100">
		<main id="main" class="site-main h-100">
			<div class="container h-100">
				<section class="error-404 not-found h-100">
					<div class="page-content error-404__content h-100">
						<div class="error-404__title">
							404
						</div>
						<div class="error-404__description"><?php esc_html_e( 'Page not found', 'lustshop' ); ?></div>
						<a href="<?php echo esc_url(home_url()); ?>" class="wp-block-lustshop-button wp-block-lustshop-button--primary error-404__button"><?php esc_html_e('Return Home', 'lustshop'); ?></a>
					</div>
				</section>
			</div>
		</main>
	</div>

<?php
get_footer();
