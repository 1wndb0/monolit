<?php
if (defined('ICL_LANGUAGE_CODE')) {
    $pageTypes = ICL_LANGUAGE_CODE === 'uk' ? 1967 : 1970;
}

$roomTypes = [];
if (isset($pageTypes)) {
    $roomTypes = get_post($pageTypes);
}

$services = getServices();

if (empty($services)) {
    return;
}

$typeOfRooms = getPosts([
    'meta_key'   => '_wp_page_template',
    'meta_value' => 'pages/service-type.php',
]);
?>

<section class="services">
    <div class="container">
        <?php foreach ($services as $index => $service):
            get_template_part_var('pages/parts/services-item', ['post' => $service]);

            if ($index === 1 && !empty($roomTypes)):
                get_template_part_var('pages/parts/services-item', ['post' => $roomTypes]);
            endif;
        endforeach; ?>
    </div>
</section>