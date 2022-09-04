<?php
/*
 * Template name: Наши услуги
 */

get_header();

$services = getServices();
?>

<section class="_services">
    <div class="container">
        <?php breadcrumbs(); ?>
        <div class="services_list">
            <?php if (!empty($services)):
                foreach ($services as $service): ?>
                    <div class="service_item">
                        <a href="<?php echo get_page_link($service); ?>" class="service_body">
                            <div class="service_img">
                                <?php if (has_post_thumbnail($service)): ?>
                                    <img src="<?php echo get_the_post_thumbnail_url($service); ?>" alt="<?php echo $service->post_title; ?>">
                                <?php endif; ?>
                            </div>
                            <h4 class="service_title">
                                <?php echo $service->post_title; ?>
                            </h4>
                        </a>
                    </div>
                <?php endforeach;
            endif; ?>
        </div>
    </div>
</section>

<?php
get_template_part('pages/general/contact-form-phone');

get_footer();