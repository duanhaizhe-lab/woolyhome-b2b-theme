<?php
/**
 * Products archive.
 *
 * @package WoolyHome_B2B
 */

$page_id = is_page() ? get_the_ID() : 0;
get_header();
get_template_part('template-parts/components/page-hero', null, array(
    'label' => 'Products',
    'title' => $page_id ? woolyhome_b2b_field('banner_title', $page_id, 'Wool & Sheepskin Product Collections') : 'Wool & Sheepskin Product Collections',
    'subtitle' => $page_id ? woolyhome_b2b_field('banner_subtitle', $page_id, 'Explore natural wool and sheepskin product directions for wholesale, private label, hospitality, and OEM / ODM sourcing.') : 'Explore natural wool and sheepskin product directions for wholesale, private label, hospitality, and OEM / ODM sourcing.',
    'image' => $page_id ? woolyhome_b2b_field('banner_image', $page_id, null) : null,
));
?>
<section class="wh-section">
    <div class="wh-container">
        <?php if ($page_id) { woolyhome_b2b_render_page_section_content($page_id); } ?>
        <div class="wh-section-heading center"><p class="wh-eyebrow">Product Categories</p><h2>Browse by Product Range</h2></div>
        <div class="wh-category-grid">
            <?php foreach (woolyhome_b2b_demo_categories() as $cat) : ?>
                <article class="wh-category-card">
                    <?php echo woolyhome_b2b_placeholder($cat['name'] . ' category image', 'wh-card-image'); ?>
                    <div class="wh-card-body">
                        <h3><?php echo esc_html($cat['name']); ?></h3>
                        <p><?php echo esc_html($cat['desc']); ?></p>
                        <a href="<?php echo esc_url(home_url('/product-category/' . $cat['slug'] . '/')); ?>">View Collection</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<section class="wh-section wh-section-cream">
    <div class="wh-container">
        <div class="wh-section-heading row"><div><p class="wh-eyebrow">Featured Products</p><h2>Selected B2B Product Directions</h2><p>Each product is designed for inquiry-based sourcing, OEM / ODM discussion, and bulk buying evaluation.</p></div><a class="wh-btn wh-btn-primary" href="#inquiry">Request Product List</a></div>
        <div class="wh-products-grid">
            <?php
            $product_query = new WP_Query(array('post_type' => 'products', 'posts_per_page' => 12));
            if ($product_query->have_posts()) {
                while ($product_query->have_posts()) {
                    $product_query->the_post();
                    get_template_part('template-parts/cards/product-card', null, array('product' => get_post()));
                }
                wp_reset_postdata();
            } else {
                foreach (woolyhome_b2b_demo_products() as $product) {
                    get_template_part('template-parts/cards/product-card', null, array('product' => $product));
                }
            }
            ?>
        </div>
    </div>
</section>
<?php
get_template_part('template-parts/components/inquiry-cta', null, array('title' => 'Need a Custom Wool Product Program?'));
get_footer();
