<?php
if (empty($post)) {
    return;
}
?>

<div class="container_blog_item">
    <div class="blog_img_container">
        <a href="<?php the_permalink($post); ?>">
            <img src="<?php echo getImageUrl($post); ?>" alt="<?php echo $post->post_title; ?>">
        </a>
    </div>
    <div class="blog_item_text">
        <div class="blog_item_text_description">
            <a href="<?php the_permalink($post); ?>">
                <?php echo $post->post_title; ?>
            </a>
        </div>
        <div class="blog_item_info">
            <p class="blog_item_data">
                <?php echo date_i18n('d F Y г. H:i'); ?>
            </p>
            <a class="blog_item_button" href="<?php the_permalink($post); ?>">
                <?php _e('Перейти', 'monolit'); ?>
            </a>
        </div>
    </div>
</div>
