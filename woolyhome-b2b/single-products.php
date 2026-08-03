<?php
/**
 * Single product template.
 *
 * @package WoolyHome_B2B
 */

get_header();
while (have_posts()) :
    the_post();
    $pid = get_the_ID();
    $short = woolyhome_b2b_field('product_short_description', $pid, get_the_excerpt() ?: 'Natural wool and sheepskin B2B product for wholesale, private label, and OEM / ODM sourcing.');
    $image = woolyhome_b2b_field('product_main_image', $pid, get_post_thumbnail_id());
    get_template_part('template-parts/components/page-hero', null, array('label' => 'Product', 'title' => get_the_title(), 'subtitle' => $short, 'image' => $image));
    ?>
    <section class="wh-section">
        <div class="wh-container wh-content-sidebar">
            <article class="wh-rich-content">
                <?php the_content(); ?>
                <h2>Key Features</h2>
                <div class="wh-value-cards">
                    <?php
                    $features = woolyhome_b2b_field('key_features', $pid, array(array('feature' => 'Natural wool material'), array('feature' => 'OEM / ODM available'), array('feature' => 'Private label packaging'), array('feature' => 'Bulk order support')));
                    foreach ($features as $feature) : ?>
                        <div class="wh-mini-card"><?php echo esc_html($feature['feature'] ?? $feature); ?></div>
                    <?php endforeach; ?>
                </div>
                <h2>Specifications</h2>
                <table class="wh-spec-table">
                    <tr><th>Materials</th><td><?php echo esc_html(woolyhome_b2b_field('materials', $pid, 'Natural wool / sheepskin options')); ?></td></tr>
                    <tr><th>Sizes</th><td><?php echo esc_html(woolyhome_b2b_field('sizes', $pid, 'Custom sizes available')); ?></td></tr>
                    <tr><th>Custom Options</th><td><?php echo esc_html(woolyhome_b2b_field('custom_options', $pid, 'Label, color, packaging, specification development')); ?></td></tr>
                    <tr><th>Packaging</th><td><?php echo esc_html(woolyhome_b2b_field('packaging_options', $pid, 'Retail pack, bulk pack, carton mark support')); ?></td></tr>
                    <tr><th>Applications</th><td><?php echo esc_html(woolyhome_b2b_field('applications', $pid, 'Retail, wholesale, hospitality, private label')); ?></td></tr>
                </table>
            </article>
            <aside class="wh-sidebar">
                <div class="wh-sidebar-box"><h3>Request a Quote</h3><p><?php echo esc_html(woolyhome_b2b_field('inquiry_cta', $pid, 'Share your target product, quantity, and custom requirements.')); ?></p><a class="wh-btn wh-btn-primary" href="#inquiry">Send Inquiry</a></div>
                <div class="wh-sidebar-box"><h3>Contact</h3><p><?php echo esc_html(woolyhome_b2b_contact('contact_email')); ?><br><?php echo esc_html(woolyhome_b2b_contact('contact_phone')); ?></p></div>
            </aside>
        </div>
    </section>
    <?php
    get_template_part('template-parts/components/faq', null, array('faq' => woolyhome_b2b_field('faq', $pid, woolyhome_b2b_default_faq())));
    get_template_part('template-parts/components/inquiry-cta', null, array('title' => 'Request a Quote for ' . get_the_title()));
endwhile;
get_footer();
