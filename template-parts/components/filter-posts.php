<?php
$categories = get_categories([
	'taxonomy'     => 'category',
	'type'         => 'post',
	'child_of'     => 0,
	'parent'       => '',
	'orderby'      => 'name',
	'order'        => 'ASC',
	'hide_empty'   => 1,
	'hierarchical' => 1,
	'exclude'      => '',
	'include'      => '',
	'number'       => 0,
	'pad_counts'   => false,
]);
?>

<form method="GET" id="filter_posts" class="filter-posts">
  <div class="filter-posts__group filter-posts__buttons">
    <?php if ( $categories ): ?>
      <div class="filter-posts__checkbox">
        <input type="radio" name="category" id="slug" value="" <?php checked(!isset($_GET['category'])); checked($_GET['category'], ''); ?>>
        <label for="slug"><?php _e( 'All posts', 'lustshop' ); ?></label>
      </div>
      <?php foreach( $categories as $category ) : ?>
        <div class="filter-posts__checkbox">
          <input type="radio" name="category" id="<?php echo $category->slug; ?>" value="<?php echo $category->slug; ?>" <?php checked($_GET['category'], $category->slug); ?>>
          <label for="<?php echo $category->slug; ?>"><?php echo $category->cat_name; ?></label>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
  <div class="filter-posts__group d-none d-lg-block">
    <label for=""><?php _e('Сортировка:', 'lustshop'); ?></label>
    <select class="lustshop-select filter-posts__select" name="order">
      <option value="" default>по умолчанию</option>
      <option value="ASC" <?php echo selected($_GET['order'], 'ASC'); ?>>по дате (сначала новые)</option>
      <option value="DESC" <?php echo selected($_GET['order'], 'DESC'); ?>>по дате (сначала старые)</option>
    </select>
  </div>
  <button type="submit" hidden id="post_submit"></button>
</form>