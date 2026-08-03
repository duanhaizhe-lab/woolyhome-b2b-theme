<?php
/**
 * Template Name: Contact
 *
 * @package WoolyHome_B2B
 */

get_header();
get_template_part('template-parts/components/page-hero', null, array(
    'label' => 'Contact',
    'title' => woolyhome_b2b_field('banner_title', get_the_ID(), 'Contact WoolyHome'),
    'subtitle' => woolyhome_b2b_field('banner_subtitle', get_the_ID(), 'Send your wool and sheepskin product requirements for quote, OEM / ODM support, sample discussion, or bulk order planning.'),
));
?>
<section class="wh-section">
    <div class="wh-container wh-split">
        <div>
            <p class="wh-eyebrow">Contact Info</p>
            <h2>Talk with WoolyHome</h2>
            <?php woolyhome_b2b_render_page_section_content(get_the_ID()); ?>
            <div class="wh-value-cards">
                <article class="wh-mini-card"><h3>Email</h3><p><a href="mailto:<?php echo esc_attr(woolyhome_b2b_contact('contact_email')); ?>"><?php echo esc_html(woolyhome_b2b_contact('contact_email')); ?></a></p></article>
                <article class="wh-mini-card"><h3>WhatsApp</h3><p><a href="<?php echo esc_url(woolyhome_b2b_contact('contact_whatsapp')); ?>"><?php echo esc_html(woolyhome_b2b_contact('contact_phone')); ?></a></p></article>
                <article class="wh-mini-card"><h3>Phone</h3><p><a href="<?php echo esc_url(woolyhome_b2b_contact('contact_phone_link')); ?>"><?php echo esc_html(woolyhome_b2b_contact('contact_phone')); ?></a></p></article>
                <article class="wh-mini-card"><h3>Address</h3><p><?php echo esc_html(woolyhome_b2b_contact('contact_address')); ?></p></article>
            </div>
        </div>
        <div id="inquiry" class="wh-contact-form-panel"><?php woolyhome_b2b_render_inquiry_form(woolyhome_b2b_field('form_shortcode', get_the_ID(), '')); ?></div>
    </div>
</section>
<?php
get_template_part('template-parts/components/faq');
get_footer();
