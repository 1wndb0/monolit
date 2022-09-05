<?php
/*
 * Template name: Помещение
 */
get_header();
$page = get_post();
breadcrumbs();
?>

    <section class="article_main">
        <div class="container">
            <div class="article_content">
                <h1><?php echo $page->post_title; ?></h1>
                <?php the_content(); ?>
            </div>
        </div>
    </section>

<?php
get_footer();
