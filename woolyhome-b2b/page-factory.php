<?php
/**
 * Template Name: Factory
 *
 * @package WoolyHome_B2B
 */

get_header();
get_template_part('template-parts/components/page-hero', null, array(
    'label' => 'Factory',
    'title' => woolyhome_b2b_field('banner_title', get_the_ID(), 'Clean Production for Wool & Sheepskin Orders'),
    'subtitle' => woolyhome_b2b_field('banner_subtitle', get_the_ID(), 'Organized production support for natural wool products, OEM / ODM programs, private label packaging, and export-ready shipments.'),
));
?>
<section class="wh-section">
    <div class="wh-container">
        <div class="wh-section-heading center"><p class="wh-eyebrow">Production Steps</p><h2>Practical Manufacturing Flow</h2></div>
        <div class="wh-process-grid">
            <?php foreach (array('Material Preparation', 'Cutting & Sewing', 'Filling & Finishing', 'Packing', 'Workshop Gallery', 'Export Preparation') as $step) : ?>
                <article class="wh-process-card"><?php echo woolyhome_b2b_placeholder('Factory clean production image', 'wh-process-image'); ?><h3><?php echo esc_html($step); ?></h3><p>Clean and organized workflow for B2B wool product orders.</p></article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="wh-section wh-section-cream">
    <div class="wh-container wh-split">
        <div><p class="wh-eyebrow">Manufacturing Capacity</p><h2>Support for Wholesale, Retail, and Hospitality Buyers</h2><p>Use this section to add real capacity data, production photos, workshop gallery, packing information, and export documentation later through ACF fields.</p></div>
        <?php echo woolyhome_b2b_placeholder('Workshop gallery image', 'wh-tall-image'); ?>
    </div>
</section>
<?php
get_template_part('template-parts/components/inquiry-cta', null, array('title' => 'Discuss Your Factory Order Requirements'));
get_footer();
