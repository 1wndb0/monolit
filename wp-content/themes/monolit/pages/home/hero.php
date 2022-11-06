<?php
$services = getServices();

if (empty($services)) {
    return;
}
?>

    <section class="main">
        <div class="carousel services-carousel" data-carousel="">
            <button class="carousel-button prev" data-carousel-button="prev"></button>
            <button class="carousel-button next" data-carousel-button="next"></button>
            <div class="slides" data-slides="">
                <?php foreach ($services as $index => $service): ?>
                    <div class="slide" <?php echo $index == 0 ? 'data-active="true"' : ''; ?>>
                        <?php echo getThumbnail($service->ID); ?>
                        <div class="slide_container">
                            <div class="main_screen_title">
                                <?php echo $service->post_title; ?>
                            </div>
                            <p class="main_screen_suptitle">
                                <?php echo $service->post_excerpt; ?>
                            </p>
                            <a href="<?php echo get_page_link($service); ?>" class="main_screen_button">
                                <?php _e('Просмотреть', 'monolit'); ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

<?php titleHtml(get_the_title(), '', true); ?>