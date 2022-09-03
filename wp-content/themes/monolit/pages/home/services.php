<?php
$services = getServices();

if (empty($services)) {
    return;
}
?>

<section class="services">
    <div class="container">
        <?php foreach ($services as $index => $service): ?>
            <div class="servises_item_container">
                <div class="services_item">
                    <div class="services_title_container">
                        <h2 class="services_item_title">
                            <?php echo $service->post_title; ?>
                        </h2>
                    </div>
                    <ul class="servises_list">
                        <?php get_template_part_var('pages/parts/services-list', ['id' => $service->ID]); ?>
                    </ul>
                    <a href="<?php echo get_page_link($service->ID); ?>" class="servises_button">
                        <?php _e('Перейти', 'monolit'); ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>