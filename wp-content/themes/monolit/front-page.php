<?php
/*
 * Template name: Головна
 */
get_header();

get_template_part('pages/home/hero');

get_template_part('pages/home/services');

get_template_part_var('pages/general/benefits');

get_template_part_var('pages/general/gallery');

get_template_part_var('pages/general/contact-form');

get_template_part_var('pages/general/blog');

get_template_part_var('pages/general/partners');

get_template_part_var('pages/general/faq');

get_template_part_var('pages/general/certificates');

?>

    <section class="article_main">
        <div class="container">
            <div class="article_content">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

<?php
get_footer();