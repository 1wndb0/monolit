<?php
/*
 * Template name: Наши услуги
 */

get_header();

$services = getServices();
?>

<section class="_services">
    <div class="container">
        <?php breadcrumbs(); ?>
        <?php get_template_part_var('pages/general/services', ['services' => $services]); ?>
    </div>
</section>

<?php
get_template_part('pages/general/contact-form-phone');

get_footer();