<?php
/*
 * Template name: Блог
 */
get_header();
$page = get_post();
breadcrumbs();

$posts = getPosts([
    'post_type'   => 'articles',
    'numberposts' => -1,
    'order'       => 'desc',
]);
?>

    <section class="blog_main">
        <div class="container">
            <h1 class="blog_main_title"><?php echo $page->post_title; ?></h1>
            <div class="blog_container">
                <?php if (!empty($posts)): ?>
                    <?php foreach ($posts as $post):
                        get_template_part_var('pages/parts/blog-card', ['post' => $post]);
                    endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php
get_template_part('pages/general/contact-form-phone');

get_footer();
