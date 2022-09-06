<?php

get_header();
?>

    <section class="not_found" style="background-image: url(<?php echo get_template_directory_uri() . '/assets/img/Photo1.png'; ?>);">
        <span class="not_found_title">
            <svg width="100" height="206" viewBox="0 0 100 206" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M96.602 156.203H81.3257V203H55.2171V156.203H8.55502L3 133.641L54.6616 3H81.3257V133.641H96.602V156.203ZM57.9947 56.2034H56.6059L31.3306 133.641H56.0504L57.9947 56.2034Z" stroke="#007CC2" stroke-width="5"></path>
            </svg>
            <svg width="88" height="206" viewBox="0 0 88 206" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M34.9413 203C13.6471 203 3 191.579 3 168.738V37.2618C3 14.4206 13.6471 3 34.9413 3H53.5506C74.8448 3 85.492 14.4206 85.492 37.2618V168.738C85.492 191.579 74.8448 203 53.5506 203H34.9413ZM40.2186 27.234C33.1822 27.234 29.6641 31.1337 29.6641 38.9331V167.067C29.6641 174.866 33.6451 178.766 41.6073 178.766H48.2734C55.3097 178.766 58.8279 174.866 58.8279 167.067V38.9331C58.8279 31.1337 54.8468 27.234 46.8846 27.234H40.2186Z" stroke="#007CC2" stroke-width="5"></path>
            </svg>
            <svg width="100" height="206" viewBox="0 0 100 206" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M96.602 156.203H81.3257V203H55.2171V156.203H8.55502L3 133.641L54.6616 3H81.3257V133.641H96.602V156.203ZM57.9947 56.2034H56.6059L31.3306 133.641H56.0504L57.9947 56.2034Z" stroke="#007CC2" stroke-width="5"></path>
            </svg>
        </span>
        <h1 class="not_found_suptitle">Страница не найдена</h1>
        <p class="not_foun_description">Возможно, вы ошиблись в адресе <b>или</b> страница была перенесена</p>
        <div class="not_found_button_container">
            <a href="<?php echo home_url() ?>" class="not_found_first_button">Главная</a>
            <a href="<?php echo home_url() ?>/services/" class="not_found_last_button">Наши услуги</a>
        </div>
    </section>

<?php
get_footer();

