<?php
$title = get_field('contact_form_title', 'options');
$id = get_field('contact_form_id', 'options');

if (!$id) {
    return;
}

get_template_part(
    'pages/general/contact-form',
    'sample',
    [
        'id'    => $id,
        'title' => $title,
    ]
);