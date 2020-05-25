<?php

$question = get_field('question');
$answer = get_field('answer');
$products = get_field('products');

?>

<div class="faq__item">
    <div class="row">
        <div class="col-lg-5">
            <div class="faq__question">
                <div class="faq__title"><?php _e('Question', 'lustshop'); ?></div>
                <div class="faq__txt"><?php echo $question; ?></div>
            </div>
            <div class="faq__answer">
                <div class="faq__title faq__title--dark"><?php _e('Answer', 'lustshop'); ?></div>
                <div class="faq__answer-txt"><?php echo $answer; ?></div>
            </div>
        </div>
        <div class="col-lg-7 faq__bestsellers-col">
            <div class="faq__bestsellers-title"><?php _e('Best offers', 'lustshop'); ?></div>
            <div class="faq__bestsellers-list row">
                <?php  foreach ($products as $id) {  ?>
                    <div class="col-lg-4 faq__bestsellers-item">
                        <div class="faq__bestsellers-img-wrap">
                            <?php echo get_the_post_thumbnail($id, 'lustshop-woo-faq', ['class' => 'faq__bestsellers-img']) ?>
                        </div>
                        <div class="faq__bestsellers-link-wrap"><a href="<?php echo get_permalink($id); ?>" class="faq__bestsellers-link"><?php echo get_the_title($id); ?></a></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

