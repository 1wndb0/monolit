<?php
/*
 * Template name: Прайс
 */
get_header();
$page = get_post();
breadcrumbs();

get_template_part_var('pages/general/price', ['main_title' => true]); ?>

    <section class="article_main">
        <div class="container">
            <div class="article_content">
                <?php the_content(); ?>
            </div>
        </div>
    </section>

<?php
get_footer();
