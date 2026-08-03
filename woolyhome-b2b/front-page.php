<?php
/**
 * Front page template.
 *
 * @package WoolyHome_B2B
 */

get_header();

$hero_eyebrow = woolyhome_b2b_field('hero_eyebrow', get_the_ID(), 'Soft Natural Wool Lifestyle B2B Manufacturer');
$hero_title = woolyhome_b2b_field('hero_title', get_the_ID(), 'Natural Wool & Sheepskin Products for Global B2B Buyers');
$hero_subtitle = woolyhome_b2b_field('hero_subtitle', get_the_ID(), 'WoolyHome supplies soft, natural wool and sheepskin products for brands, wholesalers, retailers, hotels, and private label projects worldwide.');
$hero_image = woolyhome_b2b_field('hero_image', get_the_ID(), null);
?>
<section class="wh-hero">
    <div class="wh-container wh-hero-grid">
        <div class="wh-hero-copy">
            <p class="wh-eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p><?php echo esc_html($hero_subtitle); ?></p>
            <div class="wh-trust-line"><span>OEM / ODM Available</span><span>Bulk Supply</span><span>Private Label Support</span></div>
            <div class="wh-actions">
                <a class="wh-btn wh-btn-primary" href="<?php echo esc_url(woolyhome_b2b_field('hero_primary_button_link', get_the_ID(), '#inquiry')); ?>"><?php echo esc_html(woolyhome_b2b_field('hero_primary_button_text', get_the_ID(), 'Request a Quote')); ?></a>
                <a class="wh-btn wh-btn-secondary" href="<?php echo esc_url(woolyhome_b2b_field('hero_secondary_button_link', get_the_ID(), '#products')); ?>"><?php echo esc_html(woolyhome_b2b_field('hero_secondary_button_text', get_the_ID(), 'View Product Range')); ?></a>
            </div>
        </div>
        <div class="wh-hero-visual">
            <?php echo woolyhome_b2b_image($hero_image, 'Wool comforter and sheepskin lifestyle image', 'wh-hero-image', 'large', 'hero'); ?>
            <div class="wh-note-card"><strong>Natural comfort, ready for private label.</strong><span>Custom size, material, label, and packaging support.</span></div>
        </div>
    </div>
</section>

<section class="wh-section" id="products">
    <div class="wh-container">
        <div class="wh-section-heading center">
            <p class="wh-eyebrow">Product Range</p>
            <h2><?php echo esc_html(woolyhome_b2b_field('product_categories_title', get_the_ID(), 'Explore Our Wool & Sheepskin Product Range')); ?></h2>
            <p><?php echo esc_html(woolyhome_b2b_field('product_categories_text', get_the_ID(), 'From home textiles to wearable wool accessories, WoolyHome develops natural product collections for bulk buyers and private label partners.')); ?></p>
        </div>
        <div class="wh-category-grid">
            <?php
            $category_cards = woolyhome_b2b_field('product_category_cards', get_the_ID(), array());
            if (!$category_cards) {
                $category_cards = array_map(function ($cat) {
                    return array('title' => $cat['name'], 'description' => $cat['desc'], 'image' => null, 'link' => home_url('/product-category/' . $cat['slug'] . '/'));
                }, woolyhome_b2b_demo_categories());
            }
            foreach ($category_cards as $cat) :
                $cat_title = $cat['title'] ?? 'Wool Product';
                $cat_desc = $cat['description'] ?? '';
                $cat_link = $cat['link'] ?? home_url('/products/');
                ?>
                <article class="wh-category-card">
                    <?php echo woolyhome_b2b_image($cat['image'] ?? null, $cat_title . ' category image', 'wh-card-image', 'large', $cat_title); ?>
                    <div class="wh-card-body">
                        <h3><?php echo esc_html($cat_title); ?></h3>
                        <p><?php echo esc_html($cat_desc); ?></p>
                        <a href="<?php echo esc_url($cat_link); ?>">View Collection</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="wh-section wh-section-blue">
    <div class="wh-container wh-value-grid">
        <div>
            <p class="wh-eyebrow">Why WoolyHome</p>
            <h2><?php echo esc_html(woolyhome_b2b_field('why_section_title', get_the_ID(), 'Why Global Buyers Work with WoolyHome')); ?></h2>
            <p><?php echo esc_html(woolyhome_b2b_field('why_section_text', get_the_ID(), 'We combine natural wool materials, flexible customization, and export-focused production support to help B2B buyers build reliable wool product collections.')); ?></p>
            <a class="wh-btn wh-btn-primary" href="#inquiry">Discuss Your Project</a>
        </div>
        <div class="wh-value-cards">
            <?php
            $why = woolyhome_b2b_field('why_points', get_the_ID(), array(
                array('title' => 'Natural Wool Materials', 'text' => 'Selected wool and sheepskin materials for soft, breathable, and comfortable product lines.'),
                array('title' => 'OEM / ODM Support', 'text' => 'Custom size, color, label, packaging, and product development support for private label buyers.'),
                array('title' => 'Bulk Production', 'text' => 'Stable production planning for wholesale, retail, hotel, and seasonal purchasing needs.'),
                array('title' => 'Quality Inspection', 'text' => 'Material, stitching, size, cleanliness, and packing checks before shipment.'),
            ));
            $i = 1;
            foreach ($why as $point) :
            ?>
                <article class="wh-value-card <?php echo $i === count($why) && $i % 2 ? 'wh-wide' : ''; ?>">
                    <span><?php echo esc_html(str_pad((string) $i, 2, '0', STR_PAD_LEFT)); ?></span>
                    <h3><?php echo esc_html($point['title'] ?? 'Value Point'); ?></h3>
                    <p><?php echo esc_html($point['text'] ?? 'B2B manufacturer support.'); ?></p>
                </article>
            <?php $i++; endforeach; ?>
        </div>
    </div>
</section>

<section class="wh-section" id="oem">
    <div class="wh-container wh-split">
        <?php echo woolyhome_b2b_image(woolyhome_b2b_field('oem_section_image', get_the_ID(), null), 'OEM packaging image', 'wh-tall-image', 'large', 'oem packaging'); ?>
        <div>
            <p class="wh-eyebrow">OEM / ODM</p>
            <h2><?php echo esc_html(woolyhome_b2b_field('oem_section_title', get_the_ID(), 'OEM / ODM Wool Product Development')); ?></h2>
            <p><?php echo esc_html(woolyhome_b2b_field('oem_section', get_the_ID(), 'Support your brand with flexible customization for wool and sheepskin products, from material selection to branded packaging.')); ?></p>
            <div class="wh-option-grid">
                <?php foreach (woolyhome_b2b_textarea_lines(woolyhome_b2b_field('oem_options_text', get_the_ID(), ''), array('Custom Size & Shape', 'Material & Wool Filling Options', 'Private Label & Woven Labels', 'Custom Packaging', 'Sample Development', 'Bulk Order Support')) as $option) : ?>
                    <span><?php echo esc_html($option); ?></span>
                <?php endforeach; ?>
            </div>
            <a class="wh-btn wh-btn-primary" href="<?php echo esc_url(woolyhome_b2b_field('oem_button_link', get_the_ID(), home_url('/oem-odm/'))); ?>"><?php echo esc_html(woolyhome_b2b_field('oem_button_text', get_the_ID(), 'Start OEM / ODM Project')); ?></a>
        </div>
    </div>
</section>

<section class="wh-section wh-section-cream" id="factory">
    <div class="wh-container">
        <div class="wh-section-heading center"><p class="wh-eyebrow">Factory & Production</p><h2><?php echo esc_html(woolyhome_b2b_field('factory_section_title', get_the_ID(), 'Clean, Organized Production for B2B Orders')); ?></h2><p><?php echo esc_html(woolyhome_b2b_field('factory_section', get_the_ID(), 'Our production process is designed for consistent quality, practical customization, and reliable bulk order fulfillment.')); ?></p></div>
        <div class="wh-process-grid">
            <?php foreach (woolyhome_b2b_textarea_lines(woolyhome_b2b_field('factory_steps_text', get_the_ID(), ''), array('Material Preparation', 'Cutting & Sewing', 'Filling & Finishing', 'Packing for Shipment')) as $step) : ?>
                <article class="wh-process-card"><?php echo woolyhome_b2b_image(woolyhome_b2b_field('factory_section_image', get_the_ID(), null), 'Factory clean production image', 'wh-process-image', 'large', 'factory'); ?><h3><?php echo esc_html($step); ?></h3><p>Clean production support for wool and sheepskin B2B orders.</p></article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="wh-section wh-section-blue" id="quality">
    <div class="wh-container wh-quality-grid">
        <div><p class="wh-eyebrow">Quality Control</p><h2><?php echo esc_html(woolyhome_b2b_field('quality_section_title', get_the_ID(), 'Quality Control Before Every Shipment')); ?></h2><p><?php echo esc_html(woolyhome_b2b_field('quality_section', get_the_ID(), 'From incoming materials to final packing, each order is checked to support stable quality for international buyers.')); ?></p><a class="wh-btn wh-btn-primary" href="<?php echo esc_url(home_url('/quality-control/')); ?>">Learn About Quality Control</a></div>
        <div class="wh-quality-panel"><?php echo woolyhome_b2b_image(woolyhome_b2b_field('quality_section_image', get_the_ID(), null), 'Quality inspection image', 'wh-quality-image', 'large', 'quality'); ?><ol class="wh-step-list"><?php $q_i = 1; foreach (woolyhome_b2b_textarea_lines(woolyhome_b2b_field('quality_steps_text', get_the_ID(), ''), array('Material Check', 'Size & Specification Check', 'Stitching & Finish Check', 'Cleanliness Review', 'Final Packing Inspection')) as $step) : ?><li><span><?php echo esc_html(str_pad((string) $q_i, 2, '0', STR_PAD_LEFT)); ?></span><?php echo esc_html($step); ?></li><?php $q_i++; endforeach; ?></ol></div>
    </div>
</section>

<section class="wh-section">
    <div class="wh-container">
        <div class="wh-section-heading center"><p class="wh-eyebrow">Applications</p><h2>Built for Different B2B Buying Needs</h2><p>Whether you are developing a private label line or sourcing bulk wool products for retail and hospitality, WoolyHome can support flexible product programs.</p></div>
        <div class="wh-buyer-grid">
            <?php foreach (array('Home Textile Brands', 'Wholesalers & Importers', 'Home Retailers', 'Hotels & Hospitality Buyers', 'Gift Companies', 'Private Label Customers') as $buyer) : ?>
                <article class="wh-buyer-card"><span><?php echo esc_html(substr($buyer, 0, 2)); ?></span><h3><?php echo esc_html($buyer); ?></h3><p>Flexible wool product support for your buying program and target market.</p></article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="wh-section wh-section-cream">
    <div class="wh-container">
        <div class="wh-section-heading row"><div><p class="wh-eyebrow">Featured Collections</p><h2>Featured Wool & Sheepskin Collections</h2><p>Explore selected product directions for wholesale, private label, and OEM / ODM sourcing.</p></div><a class="wh-btn wh-btn-secondary" href="<?php echo esc_url(get_post_type_archive_link('products') ?: home_url('/products/')); ?>">View All Products</a></div>
        <div class="wh-products-grid">
            <?php
            $selected_products = woolyhome_b2b_field('selected_featured_products', get_the_ID(), array());
            $products = $selected_products ?: get_posts(array('post_type' => 'products', 'posts_per_page' => 6));
            if ($products) {
                foreach ($products as $product) {
                    get_template_part('template-parts/cards/product-card', null, array('product' => $product));
                }
            } else {
                foreach (woolyhome_b2b_demo_products() as $product) {
                    get_template_part('template-parts/cards/product-card', null, array('product' => $product));
                }
            }
            ?>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/components/inquiry-cta', null, array('title' => woolyhome_b2b_field('inquiry_cta_title', get_the_ID(), 'Looking for Wool Products for Your Brand?'), 'text' => woolyhome_b2b_field('inquiry_cta_text', get_the_ID(), 'Tell us what you are sourcing. We will help you review product options, customization details, and bulk order requirements.'), 'shortcode' => woolyhome_b2b_field('inquiry_form_shortcode', get_the_ID(), ''))); ?>

<section class="wh-section">
    <div class="wh-container">
        <div class="wh-section-heading row"><div><p class="wh-eyebrow">Sourcing Insights</p><h2><?php echo esc_html(woolyhome_b2b_field('blog_preview_title', get_the_ID(), 'Insights for Wool Product Sourcing')); ?></h2><p><?php echo esc_html(woolyhome_b2b_field('blog_preview_text', get_the_ID(), 'Read practical guides about wool materials, product development, private label sourcing, and care tips for natural wool products.')); ?></p></div><a class="wh-btn wh-btn-secondary" href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog/')); ?>">View Blog</a></div>
        <div class="wh-posts-grid">
            <?php
            $posts = get_posts(array('post_type' => 'post', 'posts_per_page' => 3));
            $demo_posts = array(
                array('title' => 'How to Source Wool Comforters for Private Label Bedding Brands', 'excerpt' => 'Key points for selecting materials, sizes, packaging, and bulk order specifications.', 'meta' => 'Private Label Guide'),
                array('title' => 'Sheepskin Rugs for Home Retail: What B2B Buyers Should Know', 'excerpt' => 'How to plan rug collections for lifestyle, decor, hospitality, and seasonal programs.', 'meta' => 'Retail Sourcing'),
                array('title' => 'Wool Dryer Balls: A Natural Laundry Product for Eco-Friendly Gift Sets', 'excerpt' => 'Why reusable wool dryer balls fit eco-friendly retail and private label programs.', 'meta' => 'Eco Gift Sets'),
            );
            if ($posts) {
                foreach ($posts as $post_item) {
                    get_template_part('template-parts/cards/post-card', null, array('post' => $post_item));
                }
            } else {
                foreach ($demo_posts as $post_item) {
                    get_template_part('template-parts/cards/post-card', null, array('post' => $post_item));
                }
            }
            ?>
        </div>
    </div>
</section>
<?php
get_footer();
