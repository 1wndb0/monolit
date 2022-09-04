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
?>

<?php foreach ($posts as $post): ?>
    <div class="services_main_item_container">
        <a href="<?php echo get_page_link($post) ?>"
           class="services__main_item"
           style="background-image: url(<?php echo getImageUrl($post); ?>)">
            <p class="services__main_item_title">
                <?php echo $post->post_title; ?>
            </p>
        </a>
    </div>
<?php endforeach; ?>