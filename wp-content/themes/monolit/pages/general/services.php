<?php
if (empty($services)) {
    return;
}
?>

<div class="services_list">
    <?php if (!empty($services)):
        foreach ($services as $service): ?>
            <div class="service_item">
                <a href="<?php echo get_page_link($service); ?>" class="service_body">
                    <div class="service_img">
                        <?php echo getThumbnail($service->ID); ?>
                    </div>
                    <h4 class="service_title">
                        <?php echo $service->post_title; ?>
                    </h4>
                </a>
            </div>
        <?php endforeach;
    endif; ?>
</div>