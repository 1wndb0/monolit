<?php
require "classes/Monolit_Menu.php";

use classes\Monolit_Menu;

$phone = get_field('phone', 'options');
$current_lang = apply_filters('wpml_current_language', null);
$search_text = 'Искать здесь...';
if ($current_lang === 'uk') {
    $search_text = 'Шукати тут...';
}
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo get_template_directory_uri() . '/assets/img/favicon.ico' ?>">
    <title><?php echo titleTag(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header">
    <nav class="headerContainer">
        <a href="<?php echo get_bloginfo('url'); ?>" class="headerLogo" style="background-image: url(<?php echo get_field('logo', 'options'); ?>);"></a>
        <div class="primary-menu-container">
            <?php wp_nav_menu([
                'theme_location' => 'main_header',
                'menu_class'     => 'menu-wrapper',
                'walker'         => new Monolit_Menu(),
            ]) ?>

            <?php do_action('wpml_footer_language_selector'); ?>
        </div>

        <div class="search_icon">
            <?php get_template_part('parts/svg/icon', 'search'); ?>
            <?php get_template_part('parts/svg/icon', 'close'); ?>
        </div>
        <div class="triangle"></div>

        <?php if ($phone): ?>
            <a class="header_tel" href="tel:<?php echo str_replace([' ', '(', ')'], '', $phone); ?>">
                <?php get_template_part('parts/svg/icon', 'phone'); ?>
                <span><?php echo $phone ?></span>
            </a>
        <?php endif; ?>

        <div class="mobile_bth">
            <span class="button_line"></span>
        </div>

        <?php do_action('wpml_add_language_selector'); ?>
    </nav>
    <div class="search_flex">
        <form action="<?php bloginfo('url'); ?>/search/" method="GET" class="search-form">
            <input type="text" name="query" class="search-form_input" id="search-form_input" value="<?php echo $_GET['query'] ?? ''; ?>" placeholder="<?php echo $search_text; ?>">
            <button type="submit" class="search-form_submit"></button>
        </form>
        <div class="search_result_flex">
            <div class="search_result"></div>
        </div>
    </div>
</header>
<main>