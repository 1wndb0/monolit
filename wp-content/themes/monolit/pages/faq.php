<?php
/*
 * Template name: FAQ
 */
get_header();
$page = get_post();
breadcrumbs();

get_template_part_var('pages/general/faq', ['main_title' => true]);
get_template_part('pages/general/contact-form-main');

get_footer();
