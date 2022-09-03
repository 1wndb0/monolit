<?php
/*
 * Template name: Тип услуги
 */
get_header();
$post = get_post();
?>

<section class="services_main">
    <div class="container">
        <h1 class="services_main_title">
            <?php echo $post->post_title; ?>
            <span></span>
        </h1>
        <div class="services_container">
            <?php get_template_part_var('pages/parts/single-service-card', ['id' => $post->ID]); ?>
        </div>
        <div class="servises_description active">
            <?php echo apply_filters('the_content', $post->post_content); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
