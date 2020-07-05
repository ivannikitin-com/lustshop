<?php
if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widgets">
	<?php dynamic_sidebar( 'sidebar' ); ?>
</aside><!-- #secondary -->