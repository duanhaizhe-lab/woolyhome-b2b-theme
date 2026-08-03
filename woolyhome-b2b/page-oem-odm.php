<?php
/**
 * Template Name: OEM / ODM
 *
 * @package WoolyHome_B2B
 */

get_header();
get_template_part('template-parts/components/page-hero', null, array(
    'label' => 'OEM / ODM',
    'title' => woolyhome_b2b_field('banner_title', get_the_ID(), 'OEM / ODM Wool Product Development'),
    'subtitle' => woolyhome_b2b_field('banner_subtitle', get_the_ID(), 'Custom size, material, label, packaging, sample development, and bulk order support for private label wool product programs.'),
));
?>
<section class="wh-section">
    <div class="wh-container wh-split">
        <?php echo woolyhome_b2b_placeholder('OEM packaging image', 'wh-tall-image'); ?>
        <div><p class="wh-eyebrow">Custom Options</p><h2>Build Wool Products Around Your Market</h2><?php woolyhome_b2b_render_page_section_content(get_the_ID()); ?><p>Support for custom size, private label, custom packaging, sample development, bulk production, and export-ready order planning.</p><div class="wh-option-grid"><span>Custom Size</span><span>Private Label</span><span>Custom Packaging</span><span>Sample Development</span><span>Bulk Production</span><span>Export Support</span></div></div>
    </div>
</section>
<section class="wh-section wh-section-blue">
    <div class="wh-container">
        <div class="wh-section-heading center"><p class="wh-eyebrow">Cooperation Process</p><h2>From Requirement to Bulk Order</h2></div>
        <div class="wh-process-grid">
            <?php foreach (array('Share Requirements', 'Review Materials', 'Develop Sample', 'Confirm Packaging', 'Bulk Production', 'Final Inspection') as $step) : ?>
                <article class="wh-process-card"><h3><?php echo esc_html($step); ?></h3><p>Clear B2B communication for private label and OEM / ODM buyers.</p></article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
get_template_part('template-parts/components/faq');
get_template_part('template-parts/components/inquiry-cta', null, array('title' => 'Start Your OEM / ODM Project'));
get_footer();
