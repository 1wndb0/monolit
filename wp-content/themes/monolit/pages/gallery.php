<?php
/*
 * Template name: Галерея
 */
get_header();
$post = get_post();
breadcrumbs();
$galleryList = get_field('gallery_list', $post->ID);
$list = !empty($galleryList) ? array_reverse($galleryList, true) : false;

$data = [
    ['offset' => 0, 'length' => 2],
    ['offset' => 2, 'length' => 2, 'class' => 'not_equal'],
    ['offset' => 4, 'length' => 2, 'class' => 'not_equal_reverse'],
];
?>

    <section class="photo_galery_main">
        <div class="container">
            <h1 class="photo_galery_main_title"><?php echo $post->post_title; ?></h1>
            <?php if (!empty($list)): ?>
                <?php foreach ($data as $item):
                    if (count($list) < $item['offset']) break; ?>

                    <div class="photo_galery_container <?php echo $item['class'] ?? ''; ?>">
                        <?php foreach (array_slice($list, $item['offset'], $item['length'], true) as $index => $listItem): ?>
                            <div class="photo_galery_item_main">
                                <a href="<?php echo $listItem['photo'] ?>"
                                   target="_blank"
                                   class="photo_galery_img_container">
                                    <?php echo getImg($listItem['photo']); ?>
                                </a>
                                <p class="photo_title"><?php echo __('Фото', 'monolit') . ' ' .  intval($index + 1); ?></p>
                                <p class="photo_data"><?php echo $listItem['date'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>

<?php

get_template_part('pages/general/contact-form-phone');

get_footer();
