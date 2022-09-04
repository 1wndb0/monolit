<?php
$title = get_field('contact_form_with_phone_title', 'options');
$id = get_field('contact_form_with_phone_id', 'options');

if (!$id) {
    return;
}

get_template_part(
    'pages/general/contact-form',
    'sample',
    [
        'class' => 'contact-form-phone',
        'id'    => $id,
        'title' => $title,
    ]
);