<?php
if (empty($id)) {
    return;
}

$posts = getPosts([
    'post_parent' => $id,
]);

if (empty($posts)) {
    return;
}

foreach ($posts as $post): ?>
    <li>
        <a href="<?php get_page_link($post); ?>">
            <?php echo $post->post_title; ?>
        </a>
    </li>
<?php endforeach;


