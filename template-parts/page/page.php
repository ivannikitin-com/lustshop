<?php ?>


<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="page-header mt-0">
        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php the_content(); ?>
    </div><!-- .entry-content -->
</article>