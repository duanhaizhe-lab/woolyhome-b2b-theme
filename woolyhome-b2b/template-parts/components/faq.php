<?php
/**
 * FAQ block.
 *
 * @package WoolyHome_B2B
 */

$faq = $args['faq'] ?? woolyhome_b2b_field('faq', get_the_ID(), woolyhome_b2b_default_faq());
if (!$faq) {
    return;
}
woolyhome_b2b_faq_schema($faq);
?>
<section class="wh-section wh-section-cream">
    <div class="wh-container">
        <div class="wh-section-heading center">
            <p class="wh-eyebrow">FAQ</p>
            <h2>Common Questions from B2B Buyers</h2>
        </div>
        <div class="wh-faq-list">
            <?php foreach ($faq as $item) : ?>
                <article class="wh-faq-item">
                    <h3><?php echo esc_html($item['question'] ?? 'Question'); ?></h3>
                    <p><?php echo esc_html($item['answer'] ?? 'Answer'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
