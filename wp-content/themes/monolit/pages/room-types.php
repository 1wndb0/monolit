<?php
/*
 * Template name: Типы помещений
 */
get_header();
$page = get_post();
breadcrumbs();

$posts = getPosts([
    'post_parent' => $page->ID,
]);
?>

    <section class="blog_main">
        <div class="container">
            <h1 class="blog_main_title"><?php echo $page->post_title; ?></h1>
            <section class="article_main">
                <div class="container">
                    <div class="article_content">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>

            <div class="blog_container">
                <?php foreach ($posts as $post):
                    get_template_part_var('pages/parts/blog-card', ['post' => $post]);
                endforeach; ?>
            </div>
        </div>
    </section>

<?php

get_template_part('pages/general/contact-form-main');

get_footer();
