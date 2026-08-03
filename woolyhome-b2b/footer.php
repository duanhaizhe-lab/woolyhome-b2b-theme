<?php
/**
 * Site footer.
 *
 * @package WoolyHome_B2B
 */
?>
</main>
<aside class="wh-floating-contact" aria-label="<?php esc_attr_e('Quick contact', 'woolyhome-b2b'); ?>">
    <a class="wh-float-link" href="<?php echo esc_url(woolyhome_b2b_contact('contact_whatsapp')); ?>" aria-label="WhatsApp" data-tooltip="WhatsApp"><span>WhatsApp</span><strong>W</strong></a>
    <a class="wh-float-link" href="mailto:<?php echo esc_attr(woolyhome_b2b_contact('contact_email')); ?>" aria-label="Email" data-tooltip="Email"><span>Email</span><strong>@</strong></a>
    <a class="wh-float-link wh-float-phone" href="<?php echo esc_url(woolyhome_b2b_contact('contact_phone_link')); ?>" aria-label="Phone" data-tooltip="Phone"><span>Phone</span><strong>P</strong></a>
    <a class="wh-float-link wh-float-quote" href="<?php echo esc_url(home_url('/contact/#inquiry')); ?>" aria-label="Request a Quote" data-tooltip="Quote"><span>Quote</span><strong>Q</strong></a>
    <button class="wh-float-link wh-float-top" type="button" data-back-to-top aria-label="Back to top" data-tooltip="Back to Top"><span>Top</span><strong>↑</strong></button>
</aside>
<footer class="wh-site-footer">
    <div class="wh-container wh-footer-grid">
        <section class="wh-footer-brand">
            <a class="wh-footer-logo" href="<?php echo esc_url(home_url('/')); ?>">WoolyHome</a>
            <p>WoolyHome supplies natural wool and sheepskin products for global brands, wholesalers, retailers, hospitality buyers, and private label projects.</p>
            <div class="wh-social-reserved"><span>Social links reserved</span></div>
        </section>
        <section>
            <h2>Products</h2>
            <?php foreach (woolyhome_b2b_demo_categories() as $cat) : ?>
                <a href="<?php echo esc_url(home_url('/product-category/' . $cat['slug'] . '/')); ?>"><?php echo esc_html($cat['name']); ?></a>
            <?php endforeach; ?>
        </section>
        <section>
            <h2>Company</h2>
            <a href="<?php echo esc_url(home_url('/oem-odm/')); ?>">OEM / ODM</a>
            <a href="<?php echo esc_url(home_url('/factory/')); ?>">Factory</a>
            <a href="<?php echo esc_url(home_url('/quality-control/')); ?>">Quality Control</a>
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog/')); ?>">Blog</a>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a>
        </section>
        <section>
            <h2>Contact</h2>
            <a href="mailto:<?php echo esc_attr(woolyhome_b2b_contact('contact_email')); ?>"><?php echo esc_html(woolyhome_b2b_contact('contact_email')); ?></a>
            <a href="<?php echo esc_url(woolyhome_b2b_contact('contact_whatsapp')); ?>">WhatsApp: <?php echo esc_html(woolyhome_b2b_contact('contact_phone')); ?></a>
            <a href="<?php echo esc_url(woolyhome_b2b_contact('contact_phone_link')); ?>">Phone: <?php echo esc_html(woolyhome_b2b_contact('contact_phone')); ?></a>
            <p><?php echo esc_html(woolyhome_b2b_contact('contact_address')); ?></p>
            <div class="wh-newsletter">
                <h3>Newsletter</h3>
                <?php
                $newsletter = woolyhome_b2b_contact('newsletter_shortcode');
                if ($newsletter) {
                    echo do_shortcode($newsletter);
                } else {
                    echo '<form><input type="email" placeholder="Email address"><button type="button">Join</button></form>';
                }
                ?>
            </div>
        </section>
    </div>
    <div class="wh-container wh-footer-bottom">
        <p>&copy; <?php echo esc_html(date('Y')); ?> WoolyHome. All rights reserved.</p>
        <div class="wh-language"><a href="<?php echo esc_url(home_url('/')); ?>">EN</a><span>/</span><a href="<?php echo esc_url(woolyhome_b2b_contact('cn_language_link')); ?>">中文</a></div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
