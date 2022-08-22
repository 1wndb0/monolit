<?php
/*
 * Template name: Наши услуги
 */

get_header();

$services = getServices();
$roomType = get_post_type_object('types');
$roomImg = get_field('room_types_img', 'options') ?: '';
?>

<section class="_services">
    <div class="container">
        <?php breadcrumbs(); ?>
        <div class="services_list">
            <?php if (!empty($services)):
                foreach ($services as $service):
                    $serviceFields = get_fields('term_' . $service->term_id);?>
                    <div class="service_item">
                        <a href="<?php echo get_term_link($service); ?>" class="service_body">
                            <div class="service_img">
                                <?php if ($serviceFields['service_image']): ?>
                                    <img src="<?php echo $serviceFields['service_image']; ?>" alt="<?php echo $service->name; ?>">
                                <?php endif; ?>
                            </div>
                            <h4 class="service_title">
                                <?php echo $service->name; ?>
                            </h4>
                        </a>
                    </div>
                <?php endforeach;
            endif;
            if ($roomType): ?>
                <div class="service_item">
                    <a href="<?php echo get_post_type_archive_link('types'); ?>" class="service_body">
                        <div class="service_img">
                            <?php if ($roomImg): ?>
                                <img src="<?php echo $roomImg; ?>" alt="<?php echo $roomType->label; ?>">
                            <?php endif; ?>
                        </div>
                        <h4 class="service_title">
                            <?php echo $roomType->label; ?>
                        </h4>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();