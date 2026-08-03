<?php
/**
 * Template Name: Quality Control
 *
 * @package WoolyHome_B2B
 */

get_header();
get_template_part('template-parts/components/page-hero', null, array(
    'label' => 'Quality Control',
    'title' => woolyhome_b2b_field('banner_title', get_the_ID(), 'Quality Control Before Every Shipment'),
    'subtitle' => woolyhome_b2b_field('banner_subtitle', get_the_ID(), 'Material, size, stitching, cleanliness, and final packing checks to support stable B2B product quality.'),
));
?>
<section class="wh-section wh-section-blue">
    <div class="wh-container wh-quality-grid">
        <div><p class="wh-eyebrow">QC Process</p><h2>Inspection Checklist for B2B Orders</h2><p>Each order can be checked according to product specifications, buyer requirements, packing details, and export needs.</p></div>
        <div class="wh-quality-panel"><?php echo woolyhome_b2b_placeholder('Quality inspection image', 'wh-quality-image'); ?><ol class="wh-step-list"><li><span>01</span>Material Check</li><li><span>02</span>Size Check</li><li><span>03</span>Stitching Check</li><li><span>04</span>Cleanliness Review</li><li><span>05</span>Final Packing Check</li></ol></div>
    </div>
</section>
<section class="wh-section">
    <div class="wh-container">
        <div class="wh-section-heading center"><p class="wh-eyebrow">Inspection Details</p><h2>What Can Be Checked</h2></div>
        <div class="wh-buyer-grid">
            <?php foreach (array('Material hand feel and appearance', 'Product size and specification', 'Stitching and edge finish', 'Cleanliness and surface review', 'Label and packaging accuracy', 'Carton and shipment packing') as $item) : ?>
                <article class="wh-mini-card"><h3><?php echo esc_html($item); ?></h3><p>Replace this demo text with your real QC standard after internal confirmation.</p></article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
get_template_part('template-parts/components/inquiry-cta', null, array('title' => 'Ask About Quality Requirements'));
get_footer();
