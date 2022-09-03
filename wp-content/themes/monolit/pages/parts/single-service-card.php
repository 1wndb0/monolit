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
    <div class="services_main_item_conteiner">
        <a href="<?php echo get_the_post_thumbnail_url($post); ?>" class="services_main_item">
            <p class="services_main_item_title">
                <?php echo $post->post_title; ?>
                <span></span>
            </p>
        </a>
    </div>
<?php endforeach; ?>