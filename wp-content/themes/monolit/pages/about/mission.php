<?php
if (empty($fields)) {
    return;
}
?>

<section class="our_mission">
    <?php titleHtml($fields['mission_title']); ?>
    <div class="our_mission_container">
        <?php echo getImg($fields['mission_img']); ?>
        <?php getField($fields['mission_subtitle'], 'our_mission_text first', 'p'); ?>
        <?php getField($fields['mission_text'], 'our_mission_text', 'p'); ?>
    </div>
</section>