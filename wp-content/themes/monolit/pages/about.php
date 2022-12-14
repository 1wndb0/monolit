<?php
/*
 * Template name: Про нас
 */

get_header();
$id = get_the_ID();
$fields = get_fields(get_the_ID());

get_template_part_var('pages/about/hero', ['fields' => $fields, 'id' => $id]);
get_template_part_var('pages/about/worth', ['fields' => $fields]);
get_template_part_var('pages/about/mission', ['fields' => $fields]);
get_template_part_var('pages/general/partners');
get_template_part_var('pages/general/contact-form-main');

get_footer();

