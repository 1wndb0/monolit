<?php
get_header();
breadcrumbs();
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