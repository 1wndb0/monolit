<?php

add_filter('wpseo_opengraph_site_name', function () {
    $text = get_field('meta_tagline', 'options');
    return $text ?: 'monolit.company';
});

add_filter('wpseo_opengraph_url', function () {
    if (is_front_page() || is_home()) {
        return str_replace(['/uk'], '', get_the_permalink());
    }
    return get_the_permalink();
});

add_filter('wpseo_frontend_presenter_classes', function ($filter) {
    return array_diff($filter, [
            'Yoast\WP\SEO\Presenters\Open_Graph\Article_Modified_Time_Presenter',
            'Yoast\WP\SEO\Presenters\Open_Graph\Article_Published_Time_Presenter',
            'Yoast\WP\SEO\Presenters\Open_Graph\Article_Publisher_Presenter',
            'Yoast\WP\SEO\Presenters\Slack\Enhanced_Data_Presenter',
        ]);
    }
);

add_filter('wpseo_twitter_card_type', function ($title) {
    if (is_home() || is_front_page()) {
        return 'app';
    }

    return $title;
});

function titleTag()
{
    return get_post_meta(get_the_ID(), '_yoast_wpseo_title', true) ?: strip_tags(get_the_title());
}

if (!empty($GLOBALS['sitepress'])) {
    add_action( 'wp_head', function() {
        remove_action(current_filter(), array ( $GLOBALS['sitepress'], 'meta_generator_tag' ));
    }, 0);
}

add_action('wp_loaded', function() {
    remove_action( 'wp_head', 'wp_generator');
});