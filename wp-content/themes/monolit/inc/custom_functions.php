<?php

if (!function_exists('dd')) {
    function dd()
    {
        echo '<pre>';
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}

function get_template_part_var($template, $data = [])
{
    extract($data);
    require locate_template($template . '.php');
}

function getPosts($params = []): array
{
    $args = array_merge([
        'post_type'        => 'page',
        'post_status'      => 'publish',
        'order'            => 'asc',
        'suppress_filters' => false,
        'numberposts'      => -1,

    ], $params);

    return get_posts($args);
}

function getServices($params = []): array
{
    $args = array_merge([
        'meta_key'   => '_wp_page_template',
        'meta_value' => 'pages/service-type.php',
    ], $params);

    return getPosts($args);
}

function footerWidgets()
{
    $widgets = [
        'our-services',
        'our-company',
    ];
    foreach ($widgets as $widget) {
        if (is_active_sidebar($widget)) {
            dynamic_sidebar($widget);
        }
    }
}

function titleHtml($text = '', $mainTitle = false, $homeTitle = false)
{
    if (!$text) {
        return;
    }

    if ($mainTitle) { ?>

        <h1 class="services_main_title"><?php echo $text; ?></h1>

    <?php } else if ($homeTitle) { ?>
        <div class="title_container">
            <span class="title_line"></span>
            <h1 class="title"><?php echo $text; ?></h1>
            <span class="title_line"></span>
        </div>
    <?php } else { ?>

        <div class="title_container">
            <span class="title_line"></span>
            <h2 class="title"><?php echo $text; ?></h2>
            <span class="title_line"></span>
        </div>

    <?php }
}

function getField($field, string $class = '', string $tag = 'div')
{
    if (empty($field)) {
        return;
    }

    if ($class) {
        $class = sprintf(' class="%s"', $class);
    }

    echo sprintf('<%1$s%2$s>%3$s</%1$s>', $tag, $class, $field);
}

function getImageUrl($post): string
{
    $defaultImage = get_template_directory_uri() . '/assets/img/noimage.svg';

    if (empty($post)) {
        return $defaultImage;
    }

    return get_the_post_thumbnail_url($post) ?: $defaultImage;
}

function getImg($data = [], $class = '', $alt = '', $title = ''): string
{
    $url = $data['url'] ?? get_template_directory_uri() . '/assets/img/noimage.svg';

    $href = sprintf('src="%s"', $url);

    if ($data['title']) {
        $title = sprintf('title="%s"', $data['title']);
    }

    if ($data['alt']) {
        $alt = sprintf('alt="%s"', $data['alt']);
    }

    if ($class) {
        $class = sprintf('class="%s"', $class);
    }

    return sprintf('<%1$s %2$s %3$s %4$s %5$s>', 'img', $class, $href, $title, $alt);
}

function getThumbnail($postId): string
{
    $alt = '';
    $title = '';
    $url = get_template_directory_uri() . '/assets/img/noimage.svg';
    $imgId = get_post_thumbnail_id($postId);

    if (!$imgId) {
        return sprintf('<img href="%s">', $url);
    }

    if ($imgUrl = get_the_post_thumbnail_url($postId)) {
        $url = sprintf('src="%s"', $imgUrl);
    }

    if ($imgTitle = get_the_title($imgId)) {
        $title = sprintf('title="%s"', $imgTitle);
    }

    if ($imgAlt = get_post_meta($imgId, '_wp_attachment_image_alt', true)) {
        $alt = sprintf('alt="%s"', $imgAlt);
    }

    return sprintf('<%1$s %2$s %3$s %4$s>', 'img', $url, $title, $alt);
}

function sendMessageToTelegram($fields = '')
{
    $apiToken = get_field('telegram_token', 'options');
    $chatId = get_field('telegram_chat_id', 'options');

    if (!$apiToken || !$chatId) {
        return;
    }

    $text = '';

    foreach ($fields as $key => $value) {
        $text .= "$key: $value\n";
    }

    $data = [
        'chat_id' => $chatId,
        'text'    => $text,
    ];

    file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data));
}

function breadcrumbs()
{
    $text['home'] = __('??????????????', 'monolit');
    $text['category'] = '%s';
    $text['search'] = '???????????????????? ???????????? ???? ?????????????? "%s"';
    $text['tag'] = '???????????? ?? ?????????? "%s"';
    $text['author'] = '???????????? ???????????? %s';
    $text['404'] = '???????????? 404';
    $text['page'] = '???????????????? %s';
    $text['cpage'] = '???????????????? ???????????????????????? %s';

    $wrap_before = '<section class="bread_crumbs">';
    $wrap_after = '</section>';
    $sep = '';
    $before = '<li class="crumbs active">';
    $after = '</li>';

    $show_on_home = 0;
    $show_home_link = 1;
    $show_current = 1;
    $show_last_sep = 1;


    global $post;
    $home_url = home_url('/');
    $cpt = get_post_type();
    $url = "{$home_url}{$cpt}/";

    $link = '<li class="crumbs">';
    $link .= '<a href="%1$s">%2$s</a>';
    $link .= '</li>';
    $parent_id = ($post) ? $post->post_parent : '';
    $home_link = sprintf($link, $home_url, $text['home'], 1);

    if (is_home() || is_front_page()) {

        if ($show_on_home) {
            echo $wrap_before . $home_link . $wrap_after;
        }

    } else {

        $position = 0;

        echo $wrap_before;

        if ($show_home_link) {
            $position += 1;
            echo $home_link;
        }

        if (is_category()) {
            $parents = get_ancestors(get_query_var('cat'), 'category');
            foreach (array_reverse($parents) as $cat) {
                $position += 1;
                if ($position > 1) {
                    echo $sep;
                }
                echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
            }
            if (get_query_var('paged')) {
                $position += 1;
                $cat = get_query_var('cat');
                echo $sep . sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
            } else {
                if ($show_current) {
                    if ($position >= 1) {
                        echo $sep;
                    }
                    echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
                } else {
                    if ($show_last_sep) {
                        echo $sep;
                    }
                }
            }

        } else {
            if (is_search()) {
                if (get_query_var('paged')) {
                    $position += 1;
                    if ($show_home_link) {
                        echo $sep;
                    }
                    echo sprintf($link, $home_url . '?s=' . get_search_query(),
                        sprintf($text['search'], get_search_query()), $position);
                    echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                } else {
                    if ($show_current) {
                        if ($position >= 1) {
                            echo $sep;
                        }
                        echo $before . sprintf($text['search'], get_search_query()) . $after;
                    } else {
                        if ($show_last_sep) {
                            echo $sep;
                        }
                    }
                }

            } else {
                if (is_year()) {
                    if ($show_home_link && $show_current) {
                        echo $sep;
                    }
                    if ($show_current) {
                        echo $before . get_the_time('Y') . $after;
                    } else {
                        if ($show_home_link && $show_last_sep) {
                            echo $sep;
                        }
                    }

                } else {
                    if (is_month()) {
                        if ($show_home_link) {
                            echo $sep;
                        }
                        $position += 1;
                        echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position);
                        if ($show_current) {
                            echo $sep . $before . get_the_time('F') . $after;
                        } else {
                            if ($show_last_sep) {
                                echo $sep;
                            }
                        }

                    } else {
                        if (is_day()) {
                            if ($show_home_link) {
                                echo $sep;
                            }
                            $position += 1;
                            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'), $position) . $sep;
                            $position += 1;
                            echo sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'),
                                $position);
                            if ($show_current) {
                                echo $sep . $before . get_the_time('d') . $after;
                            } else {
                                if ($show_last_sep) {
                                    echo $sep;
                                }
                            }

                        } else {
                            if (is_single() && !is_attachment()) {
                                if (get_post_type() != 'post') {
                                    $position += 1;
                                    $post_type = get_post_type_object(get_post_type());
                                    if ($position > 1) {
                                        echo $sep;
                                    }
                                    echo sprintf($link, $url, $post_type->labels->name, $position);
                                    if ($show_current) {
                                        echo $sep . $before . get_the_title() . $after;
                                    } else {
                                        if ($show_last_sep) {
                                            echo $sep;
                                        }
                                    }
                                } else {
                                    $cat = get_the_category();
                                    $catID = $cat[0]->cat_ID;
                                    $parents = get_ancestors($catID, 'category');
                                    $parents = array_reverse($parents);
                                    $parents[] = $catID;
                                    foreach ($parents as $cat) {
                                        $position += 1;
                                        if ($position > 1) {
                                            echo $sep;
                                        }
                                        echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                                    }
                                    if (get_query_var('cpage')) {
                                        $position += 1;
                                        echo $sep . sprintf($link, get_permalink(), get_the_title(), $position);
                                        echo $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                                    } else {
                                        if ($show_current) {
                                            echo $sep . $before . get_the_title() . $after;
                                        } else {
                                            if ($show_last_sep) {
                                                echo $sep;
                                            }
                                        }
                                    }
                                }

                            } else {
                                if (is_post_type_archive()) {
                                    $post_type = get_post_type_object(get_post_type());
                                    if (get_query_var('paged')) {
                                        $position += 1;
                                        if ($position > 1) {
                                            echo $sep;
                                        }
                                        echo sprintf($link, get_post_type_archive_link($post_type->name),
                                            $post_type->label, $position);
                                        echo $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                                    } else {
                                        if ($show_home_link && $show_current) {
                                            echo $sep;
                                        }
                                        if ($show_current) {
                                            echo $before . $post_type->label . $after;
                                        } else {
                                            if ($show_home_link && $show_last_sep) {
                                                echo $sep;
                                            }
                                        }
                                    }

                                } else {
                                    if (is_attachment()) {
                                        $parent = get_post($parent_id);
                                        $cat = get_the_category($parent->ID);
                                        $catID = $cat[0]->cat_ID;
                                        $parents = get_ancestors($catID, 'category');
                                        $parents = array_reverse($parents);
                                        $parents[] = $catID;
                                        foreach ($parents as $cat) {
                                            $position += 1;
                                            if ($position > 1) {
                                                echo $sep;
                                            }
                                            echo sprintf($link, get_category_link($cat), get_cat_name($cat), $position);
                                        }
                                        $position += 1;
                                        echo $sep . sprintf($link, get_permalink($parent), $parent->post_title,
                                                $position);
                                        if ($show_current) {
                                            echo $sep . $before . get_the_title() . $after;
                                        } else {
                                            if ($show_last_sep) {
                                                echo $sep;
                                            }
                                        }

                                    } else {
                                        if (is_page() && !$parent_id) {
                                            if ($show_home_link && $show_current) {
                                                echo $sep;
                                            }
                                            if ($show_current) {
                                                echo $before . get_the_title() . $after;
                                            } else {
                                                if ($show_home_link && $show_last_sep) {
                                                    echo $sep;
                                                }
                                            }

                                        } else {
                                            if (is_page() && $parent_id) {
                                                $parents = get_post_ancestors(get_the_ID());
                                                foreach (array_reverse($parents) as $pageID) {
                                                    $position += 1;
                                                    if ($position > 1) {
                                                        echo $sep;
                                                    }
                                                    echo sprintf($link, get_page_link($pageID), get_the_title($pageID),
                                                        $position);
                                                }
                                                if ($show_current) {
                                                    echo $sep . $before . get_the_title() . $after;
                                                } else {
                                                    if ($show_last_sep) {
                                                        echo $sep;
                                                    }
                                                }

                                            } else {
                                                if (is_tag()) {
                                                    if (get_query_var('paged')) {
                                                        $position += 1;
                                                        $tagID = get_query_var('tag_id');
                                                        echo $sep . sprintf($link, get_tag_link($tagID),
                                                                single_tag_title('', false), $position);
                                                        echo $sep . $before . sprintf($text['page'],
                                                                get_query_var('paged')) . $after;
                                                    } else {
                                                        if ($show_home_link && $show_current) {
                                                            echo $sep;
                                                        }
                                                        if ($show_current) {
                                                            echo $before . sprintf($text['tag'],
                                                                    single_tag_title('', false)) . $after;
                                                        } else {
                                                            if ($show_home_link && $show_last_sep) {
                                                                echo $sep;
                                                            }
                                                        }
                                                    }

                                                } else {
                                                    if (is_author()) {
                                                        $author = get_userdata(get_query_var('author'));
                                                        if (get_query_var('paged')) {
                                                            $position += 1;
                                                            echo $sep . sprintf($link,
                                                                    get_author_posts_url($author->ID),
                                                                    sprintf($text['author'], $author->display_name),
                                                                    $position);
                                                            echo $sep . $before . sprintf($text['page'],
                                                                    get_query_var('paged')) . $after;
                                                        } else {
                                                            if ($show_home_link && $show_current) {
                                                                echo $sep;
                                                            }
                                                            if ($show_current) {
                                                                echo $before . sprintf($text['author'],
                                                                        $author->display_name) . $after;
                                                            } else {
                                                                if ($show_home_link && $show_last_sep) {
                                                                    echo $sep;
                                                                }
                                                            }
                                                        }

                                                    } else {
                                                        if (is_404()) {
                                                            if ($show_home_link && $show_current) {
                                                                echo $sep;
                                                            }
                                                            if ($show_current) {
                                                                echo $before . $text['404'] . $after;
                                                            } else {
                                                                if ($show_last_sep) {
                                                                    echo $sep;
                                                                }
                                                            }

                                                        } else {
                                                            if (has_post_format() && !is_singular()) {
                                                                if ($show_home_link && $show_current) {
                                                                    echo $sep;
                                                                }
                                                                echo get_post_format_string(get_post_format());
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        echo $wrap_after;
    }
}