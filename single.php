<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package lustshop
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<?php get_template_part('template-parts/components/breadcrumb'); ?>

				<div class="single__wrapper">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/page/single' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							?>
							<div class="single__container">
								<?php comments_template(); ?>
							</div>
							<?php
						endif;

					endwhile; // End of the loop.
					?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
