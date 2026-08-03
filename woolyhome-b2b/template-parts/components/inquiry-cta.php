<?php
/**
 * Inquiry CTA with replaceable shortcode.
 *
 * @package WoolyHome_B2B
 */

$title    = $args['title'] ?? 'Looking for Wool Products for Your Brand?';
$text     = $args['text'] ?? 'Tell us what you are sourcing. We will help you review product options, customization details, and bulk order requirements.';
$shortcode = $args['shortcode'] ?? woolyhome_b2b_field('form_shortcode', get_the_ID(), '');
?>
<section class="wh-section wh-inquiry-section" id="inquiry">
    <div class="wh-container wh-inquiry-grid">
        <div>
            <p class="wh-eyebrow">Request a Quote</p>
            <h2><?php echo esc_html($title); ?></h2>
            <p><?php echo esc_html($text); ?></p>
            <p><a href="mailto:<?php echo esc_attr(woolyhome_b2b_contact('contact_email')); ?>"><?php echo esc_html(woolyhome_b2b_contact('contact_email')); ?></a><br>
            <a href="<?php echo esc_url(woolyhome_b2b_contact('contact_whatsapp')); ?>">WhatsApp: <?php echo esc_html(woolyhome_b2b_contact('contact_phone')); ?></a></p>
        </div>
        <?php woolyhome_b2b_render_inquiry_form($shortcode); ?>
    </div>
</section>
