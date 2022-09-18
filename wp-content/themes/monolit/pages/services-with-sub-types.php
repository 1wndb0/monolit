<?php
/*
 * Template name: Услуги с подтипами
 */

get_header();
breadcrumbs();

$id = get_the_ID();

$services = getPosts([
    'post_parent' => $id
]);
?>

    <section class="services_main">
        <div class="container">
            <h1 class="services_main_title">
                <?php the_title(); ?>
            </h1>
            <?php get_template_part_var('pages/general/services', ['services' => $services]); ?>

            <div class="servises_description">
                <?php the_excerpt(); ?>
            </div>
        </div>
    </section>
    <section class="our_projects">
        <?php the_content(); ?>
    </section>

<?php
get_template_part('pages/general/contact-form-price');
get_template_part('pages/general/benefits');
get_template_part('pages/general/partners');
get_template_part('pages/general/faq');
get_template_part('pages/general/contact-form-main');

get_footer();