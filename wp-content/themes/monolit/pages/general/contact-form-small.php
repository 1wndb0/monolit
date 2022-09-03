<?php
$title = get_field('contact_form_with_phone_title', 'options');
$id = get_field('contact_form_with_phone_id', 'options');

if (!$id) {
    return;
}
?>

<section class="contact-form contact-form-phone">
    <div class="container">
        <div class="contact-form-body">
            <?php titleHtml($title); ?>
            <?php echo do_shortcode('[wpforms id="'. $id .'"]'); ?>
        </div>
    </div>
</section>