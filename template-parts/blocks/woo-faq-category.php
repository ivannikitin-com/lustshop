<?php

$className = 'faq-category';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}

$categories = get_field('category');
?>

<div class="<?php echo $className; ?>">
    <?php
    foreach ($categories as $categoryId) {
        $category = get_term_by('id', $categoryId, 'product_cat');
        $categoryName = $category->name;
        $categoryLink = get_term_link($category->slug, 'product_cat');
        $categoryDescription = $category->description;
        $thumbnailId = get_term_meta( $categoryId, 'thumbnail_id', true );
        $image = wp_get_attachment_image($thumbnailId, 'lustshop-woo-faq-category', null, array('class' => "faq-category__img img-fluid"));
        ?>
        <div class="faq-category__item">
            <a href="<?php echo $categoryLink; ?>" class="faq-category__link">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="faq-category__title"><?php echo $categoryName; ?></div>
                        <?php echo $image; ?>
                    </div>
                    <div class="col-lg-5">
                        <div class="faq-category__txt"><?php echo $categoryDescription; ?></div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-block d-lg-inline-block text-center">
                            <div class="wp-block-lustshop-button wp-block-lustshop-button--pale-grey faq-category__button"><?php _e('Сhoose', 'lustshop'); ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="7" height="12" viewBox="0 0 7 12">
                                    <path data-name="-e-arrow-white"
                                          d="M6.99 6a1.011 1.011 0 0 1-.29.706l-4.99 5A1 1 0 1 1 .3 10.294L4.58 6 .3 1.706A1 1 0 1 1 1.71.294l4.99 5A1.011 1.011 0 0 1 6.99 6z"
                                          fill-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php
    }
    ?>
</div>
