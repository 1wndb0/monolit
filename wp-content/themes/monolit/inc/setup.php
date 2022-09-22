<?php

add_action('wp_enqueue_scripts', 'register_scripts');
add_action('after_setup_theme', 'theme_setup_settings');
add_action('admin_menu', 'remove_default_post_types');
add_action('wpforms_process_complete', 'wpf_dev_process_complete', 10, 4);
add_action('wp_head', 'wp_head_call');
add_action('wp_body_open', 'wp_body_open_call');

add_filter('upload_mimes', 'upload_allow_types');
add_filter('show_admin_bar', '__return_false');
add_filter('gutenberg_use_widgets_block_editor', '__return_false');
add_filter('use_widgets_block_editor', '__return_false');
add_filter('wpforms_frontend_confirmation_message', 'wpforms_confirmation_message');


function wp_head_call()
{
    google_tag_manager();
    fb_pixel_tag();
}

function google_tag_manager()
{
    $showTag = get_field('google_tags_show', 'options');
    if (!$showTag) {
        return;
    }

    $script = get_field('google_tag_head', 'options');
    if (!$script) {
        return;
    }

    echo $script;
}

function fb_pixel_tag()
{
    $showTag = get_field('fb_tags_show', 'options');
    if (!$showTag) {
        return;
    }

    $script = get_field('fb_tag_head', 'options');
    if (!$script) {
        return;
    }

    echo $script;
}

function wp_body_open_call()
{
    $showTag = get_field('google_tags_show', 'options');
    if (!$showTag) {
        return;
    }

    $script = get_field('google_tag_body', 'options');
    if (!$script) {
        return;
    }

    echo $script;
}

function register_scripts()
{
    theme_styles();
    theme_scripts();
}

function theme_styles()
{
    wp_enqueue_style('monolit-main-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('monolit-style', get_template_directory_uri() . '/assets/css/styles.css');
    wp_enqueue_style('monolit-app-style', get_template_directory_uri() . '/assets/css/app.css');
}

function theme_scripts()
{
    wp_enqueue_script('monolit-slider-script', get_template_directory_uri() . '/assets/js/slick-slider.js', ['jquery'],
        time(), true);
    wp_enqueue_script('monolit-main-script', get_template_directory_uri() . '/assets/js/app.js', ['jquery'], time(),
        true);
    wp_enqueue_script('monolit-script', get_template_directory_uri() . '/assets/js/scripts.js', ['jquery'], time(),
        true);
    wp_enqueue_script('monolit-jquery-script', get_template_directory_uri() . '/assets/js/jquery.js', ['jquery'],
        time(), true);

    wp_localize_script('monolit-main-script', 'myajax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
}

function upload_allow_types($types)
{
    $types['svg'] = 'image/svg+xml';
    $types['webp'] = 'image/webp';
    return $types;
}

function theme_setup_settings()
{
    register_nav_menus([
        'main_header' => 'Main Header',
        'our_services' => 'Our Services',
        'our_company' => 'Our Company',
    ]);

    add_post_type_support('page', 'excerpt');

    add_theme_support('post-thumbnails', ['articles', 'page']);
    add_theme_support('custom-logo', [
        'unlink-homepage-logo' => true,
    ]);

    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => __('Общие настройки', 'monolit'),
            'menu_title' => __('Общие настройки', 'monolit'),
            'menu_slug' => 'theme-general-settings',
            'capability' => 'edit_posts',
            'redirect' => false,
        ]);
    }
}

function remove_default_post_types()
{
    remove_menu_page('edit.php');
    remove_menu_page('edit-comments.php');
}

function wpf_dev_process_complete($params, $entry, $form_data, $entry_id)
{
    $formName = $form_data['settings']['form_title'];
    $fields = [];

    foreach ($params as $param) {
        if (!$param['value']) {
            continue;
        }

        $fields[$param['name']] = $param['value'];
    }

    sendMessageToTelegram($formName, $fields);
}

function wpforms_confirmation_message()
{
    $customMessage = get_field('form_thank_you_message', 'options');

    if ($customMessage) {
        return $customMessage;
    }

    return __('Дякуємо, що звернулися до нас! Ми зв\'яжемося з вами найближчим часом.', 'monolit');
}