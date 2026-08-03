<?php
/**
 * Product category taxonomy template.
 *
 * @package WoolyHome_B2B
 */

get_header();
$term = get_queried_object();
$title = $term && !is_wp_error($term) ? $term->name : 'Product Category';
$subtitle = $term && !empty($term->description) ? $term->description : 'Review product options, custom specifications, OEM / ODM support, FAQ, and inquiry details for this wool product category.';
get_template_part('template-parts/components/page-hero', null, array('label' => 'Product Category', 'title' => $title, 'subtitle' => $subtitle));
?>
<section class="wh-section">
    <div class="wh-container wh-content-sidebar">
        <div>
            <div class="wh-section-heading"><p class="wh-eyebrow">Category Overview</p><h2><?php echo esc_html($title); ?> for B2B Sourcing</h2><p><?php echo esc_html($subtitle); ?></p></div>
            <div class="wh-products-grid">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        get_template_part('template-parts/cards/product-card', null, array('product' => get_post()));
                    }
                } else {
                    foreach (woolyhome_b2b_demo_products() as $product) {
                        get_template_part('template-parts/cards/product-card', null, array('product' => $product));
                    }
                }
                ?>
            </div>
        </div>
        <aside class="wh-sidebar">
            <div class="wh-sidebar-box"><h3>Custom Options</h3><p>Size, material, color, label, packaging, sample development, and bulk order support.</p></div>
            <div class="wh-sidebar-box"><h3>Inquiry Support</h3><p>Send your product interest and quantity. We will review suitable options for your market.</p><a class="wh-btn wh-btn-primary" href="#inquiry">Request a Quote</a></div>
        </aside>
    </div>
</section>
<section class="wh-section wh-section-blue">
    <div class="wh-container wh-split">
        <div><p class="wh-eyebrow">Specifications / Custom Options</p><h2>Flexible Specifications for Your Buying Program</h2><p>Use this section for category-specific size, material, color, packaging, and MOQ guidance. Replace the content later with ACF page or taxonomy fields if needed.</p></div>
        <table class="wh-spec-table"><tr><th>Materials</th><td>Natural wool / sheepskin options</td></tr><tr><th>Customization</th><td>Size, label, packaging, product set</td></tr><tr><th>Applications</th><td>Retail, wholesale, hospitality, private label</td></tr></table>
    </div>
</section>
<?php
get_template_part('template-parts/components/faq');
get_template_part('template-parts/components/inquiry-cta', null, array('title' => 'Request ' . $title . ' Information'));
get_footer();
