<?php
if (empty($post)) {
    return;
}
?>

<div class="servises_item_container">
    <div class="services_item">
        <div class="services_title_container">
            <h2 class="services_item_title">
                <?php echo $post->post_title; ?>
            </h2>
        </div>
        <ul class="servises_list">
            <?php get_template_part_var('pages/parts/services-list', ['id' => $post->ID]); ?>
        </ul>
        <a href="<?php echo get_page_link($post->ID); ?>" class="servises_button">
            <?php _e('Перейти', 'monolit'); ?>
        </a>
    </div>
</div>
