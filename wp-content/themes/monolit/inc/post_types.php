<?php

function createPostTypes()
{
    createPostType('articles', [
        'has_archive' => false,
        'labels'      => [
            'name'          => __('Блог', 'monolit'),
            'singular_name' => __('Блог', 'monolit'),
            'add_new'       => __('Добавить новый Пост', 'monolit'),
            'add_new_item'  => __('Добавление нового Поста', 'monolit'),
            'view_item'     => __('Просмотреть Пост', 'monolit'),
            'search_items'  => __('Найти Пост', 'monolit'),
            'not_found'     => __('Пост не найден', 'monolit'),
            'menu_name'     => __('Блог', 'monolit'),
        ],
    ]);
}

function createPostType($postType, $args = [])
{
    $args = array_merge([
        'public'        => true,
        'show_ui'       => true,
        'has_archive'   => true,
        'menu_position' => 20,
        'hierarchical'  => true,
        'supports'      => ['title', 'editor', 'thumbnail'],
    ], $args);

    register_post_type($postType, $args);
}

function createTaxonomy($taxonomy, $postType, $args = [])
{
    $args = array_merge([
        'description'  => '',
        'public'       => true,
        'hierarchical' => true,
        'has_archive'  => true,
    ], $args);

    register_taxonomy($taxonomy, $postType, $args);
}

add_action('init', 'createPostTypes');