<?php
if (empty($args['id']) || empty($args['title'])) {
    return;
}
?>

<section class="contact-form <?php echo $args['class'] ?? ''; ?>">
    <div class="container">
        <div class="contact-form-body">
            <?php titleHtml($args['title']); ?>
            <?php echo do_shortcode('[wpforms id="'. $args['id'] .'"]'); ?>
        </div>
    </div>
</section>