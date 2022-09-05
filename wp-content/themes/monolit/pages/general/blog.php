<?php
$count = get_field('blog_posts_count', 'options');
$title = get_field('blog_title', 'options');
$blogUrl = get_field('blog_url', 'options');

$posts = getPosts([
    'post_type'   => 'articles',
    'numberposts' => $count ?: 3,
    'order'       => 'desc',
]);

if (empty($posts)) {
    return;
}
?>

<section class="blog" id="blog">

    <?php titleHtml($title); ?>

    <div class="blog_container">
        <?php foreach ($posts as $post):
            get_template_part_var('pages/parts/blog-card', ['post' => $post]);
        endforeach; ?>
    </div>

    <a href="<?php echo $blogUrl ?: '/articles/'; ?>" class="blog_button">
        <?php _e('Просмотреть', 'monolit'); ?>
    </a>

</section>