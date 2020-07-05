<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lustshop
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <div class="container">

                <?php get_template_part('template-parts/components/breadcrumb'); ?>

                <div class="row">
                    <div class="col-xl-3 d-none d-xl-block">
                        <?php get_sidebar(); ?>
                    </div>
                    <div class="col-xl-9 col-lg-12">
                        <?php
                        while ( have_posts() ) :
                            the_post();

                            get_template_part( 'template-parts/page/page');

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>
                    </div>
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
