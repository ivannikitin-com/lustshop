<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package lustshop
 */

?>

	</div><!-- #content -->

	<footer class="footer">
		<div class="container">
			<div class="footer__main">
				<div class="row">
					<div class="footer__column col-md-6 col-lg-3">
						<?php
						if ( is_active_sidebar( 'footer-1' ) ) {
							dynamic_sidebar( 'footer-1' );
						}
						?>
										
					</div>
					<div class="footer__column col-md-6 col-lg-3">
						<?php
						if ( is_active_sidebar( 'footer-2' ) ) {
							dynamic_sidebar( 'footer-2' );
						}
						?>
					</div>
					<div class="footer__column col-md-6 col-lg-3">
						<?php
						if ( is_active_sidebar( 'footer-3' ) ) {
							dynamic_sidebar( 'footer-3' );
						}
						?>
					</div>	
					<div class="footer__column footer__column-last col-md-6 col-lg-3">
						<?php if ( get_theme_mod( 'lustshop_phone_number' ) || get_theme_mod( 'lustshop_email' ) ) : ?>
							<div class="footer__info">
								<a href="#" class="footer__title"><?php esc_html_e( 'Call, write', 'lustshop' ); ?></a>
								<?php if ( get_theme_mod( 'lustshop_phone_number' ) ) : ?>
									<div class="footer__phone"><a href="tel:<?php echo filter_phone( get_theme_mod( 'lustshop_phone_number' ) ); ?>"><?php echo get_theme_mod( 'lustshop_phone_number' ); ?></a></div>
								<?php endif; ?>
								<?php if ( get_theme_mod( 'lustshop_email' ) ) : ?>
									<div class="footer__email"><a href="mailto:<?php echo get_theme_mod( 'lustshop_email' ); ?>"><?php echo get_theme_mod( 'lustshop_email' ); ?></a></div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<div class="footer__share">
							<?php
							if ( is_active_sidebar( 'footer-social' ) ) {
								dynamic_sidebar( 'footer-social' );
							}
							?>
						</div><!--/.footer__share-->
					</div><!--./col-->
				</div><!--/.row-->
			</div><!-- footer__main-->
		</div><!--/.container-->

		<?php if ( is_active_sidebar( 'footer-bottom' ) ) : ?>
		<div class="footer__bottom">
			<div class="container">
				<div class="footer__payment row no-gutters justify-content-center">
					<?php dynamic_sidebar( 'footer-bottom' ); ?>
				</div>
			</div><!--/.container-->
		</div><!--/.footer__bottom-->
		<?php endif; ?>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
