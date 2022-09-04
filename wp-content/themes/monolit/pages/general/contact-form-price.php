<?php
$title = get_field('contact_form_with_price_title', 'options');
$id = get_field('contact_form_with_price_id', 'options');

if (!$id) {
    return;
}

get_template_part(
    'pages/general/contact-form',
    'sample',
    [
        'class' => 'contact-form-price',
        'id'    => $id,
        'title' => $title,
    ]
);