<?php

/**
 * @var $id             int Current post ID
 */

?>

<article>
    <a class="post-widget" href="<?php echo get_permalink($id); ?>">
        <?php echo get_the_post_thumbnail($id, 'lustshop-widget-post'); ?>
        <div class="post-widget__title"><?php echo get_the_title($id); ?></div>
        <time class="post-widget__time"><?php echo get_the_time('d.m.Y', $id); ?></time>
    </a>
</article>
