<?php
/*
 * Template name: Контакти
 */
get_header();
$page = get_post();
$contacts = get_field('contacts_list', $page->ID);
$map = get_field('contacts_map', $page->ID);

breadcrumbs();
?>

    <section class="contacts">
        <div class="container">
            <h1 class="contacts__title"><?php echo $page->post_title; ?></h1>
            <?php if (!empty($contacts)): ?>
                <div class="contact__list">
                    <?php foreach ($contacts as $contact): ?>
                        <div class="contact__item">
                            <div class="contact__body">
                                <?php getField($contact['title'], 'contact__title', 'p'); ?>
                                <?php if (!empty($contact['link'])): ?>
                                    <a href="<?php echo $contact['link']['url'] ?>"
                                       target="<?php echo $contact['link']['target'] ?: '_self' ?>"
                                       class="contact__link">
                                        <?php echo $contact['link']['title']; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php get_template_part('pages/general/contact-form-main'); ?>

    <?php if ($map): ?>
        <section class="map_section">
            <div class="map_container">
                <?php echo $map; ?>
            </div>
        </section>
    <?php endif; ?>
<?php
get_footer();
