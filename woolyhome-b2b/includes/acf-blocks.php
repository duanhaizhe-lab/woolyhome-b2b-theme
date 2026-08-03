<?php
/**
 * ACF Blocks for visual Home page editing.
 *
 * @package WoolyHome_B2B
 */

if (!defined('ABSPATH')) {
    exit;
}

function woolyhome_b2b_register_block_category(array $categories): array {
    foreach ($categories as $category) {
        if (($category['slug'] ?? '') === 'woolyhome') {
            return $categories;
        }
    }

    $categories[] = array(
        'slug'  => 'woolyhome',
        'title' => __('WoolyHome Sections', 'woolyhome-b2b'),
        'icon'  => 'screenoptions',
    );

    return $categories;
}
add_filter('block_categories_all', 'woolyhome_b2b_register_block_category');

function woolyhome_b2b_register_acf_blocks(): void {
    if (!function_exists('acf_register_block_type')) {
        return;
    }

    $blocks = array(
        'woolyhome-hero'               => array('WoolyHome Hero Block', 'cover-image'),
        'woolyhome-product-categories' => array('Product Categories Block', 'grid-view'),
        'woolyhome-why'                => array('Why WoolyHome Block', 'yes-alt'),
        'woolyhome-oem'                => array('OEM / ODM Block', 'admin-customizer'),
        'woolyhome-factory'            => array('Factory Preview Block', 'building'),
        'woolyhome-quality'            => array('Quality Control Block', 'shield'),
        'woolyhome-inquiry-cta'        => array('Inquiry CTA Block', 'email-alt'),
        'woolyhome-blog-preview'       => array('Blog Preview Block', 'welcome-write-blog'),
        'woolyhome-contact-info'       => array('Contact Info Block', 'phone'),
    );

    foreach ($blocks as $name => $settings) {
        acf_register_block_type(array(
            'name'            => $name,
            'title'           => __($settings[0], 'woolyhome-b2b'),
            'description'     => __('Editable WoolyHome home page section.', 'woolyhome-b2b'),
            'category'        => 'woolyhome',
            'icon'            => $settings[1],
            'keywords'        => array('woolyhome', 'home', 'b2b'),
            'mode'            => 'edit',
            'supports'        => array(
                'align'  => false,
                'mode'   => true,
                'jsx'    => false,
                'anchor' => true,
            ),
            'render_callback' => 'woolyhome_b2b_render_home_block',
        ));
    }

    woolyhome_b2b_seed_home_blocks_once();
}
add_action('acf/init', 'woolyhome_b2b_register_acf_blocks');

function woolyhome_b2b_acf_blocks_admin_notice(): void {
    if (!is_admin() || !function_exists('acf_add_local_field_group') || function_exists('acf_register_block_type')) {
        return;
    }

    echo '<div class="notice notice-info"><p><strong>WoolyHome B2B:</strong> ACF is active, but the ACF Blocks API is not available in this installation. The Home page can still be edited with the WoolyHome ACF field groups below the editor; install an ACF version that supports ACF Blocks to edit Home sections as Gutenberg blocks.</p></div>';
}
add_action('admin_notices', 'woolyhome_b2b_acf_blocks_admin_notice');

function woolyhome_b2b_home_block_names(): array {
    return array(
        'acf/woolyhome-hero',
        'acf/woolyhome-product-categories',
        'acf/woolyhome-why',
        'acf/woolyhome-oem',
        'acf/woolyhome-factory',
        'acf/woolyhome-quality',
        'acf/woolyhome-inquiry-cta',
        'acf/woolyhome-blog-preview',
        'acf/woolyhome-contact-info',
    );
}

function woolyhome_b2b_home_block_content(): string {
    $blocks = array();
    foreach (woolyhome_b2b_home_block_names() as $block_name) {
        $blocks[] = '<!-- wp:' . $block_name . ' ' . wp_json_encode(array('name' => $block_name, 'data' => array(), 'mode' => 'edit')) . ' /-->';
    }

    return implode("\n\n", $blocks);
}

function woolyhome_b2b_seed_home_blocks_once(): void {
    if (get_option('woolyhome_b2b_home_blocks_seeded')) {
        return;
    }

    if (!function_exists('acf_register_block_type')) {
        return;
    }

    $home_id = (int) get_option('page_on_front');
    if (!$home_id) {
        $home = get_page_by_path('home');
        $home_id = $home instanceof WP_Post ? (int) $home->ID : 0;
    }

    if (!$home_id) {
        return;
    }

    $home = get_post($home_id);
    if (!$home instanceof WP_Post) {
        return;
    }

    $content = trim((string) $home->post_content);
    $default_content = 'WoolyHome B2B manufacturer home page.';

    if ($content !== '' && $content !== $default_content) {
        update_option('woolyhome_b2b_home_blocks_seeded', time(), false);
        return;
    }

    wp_update_post(array(
        'ID'           => $home_id,
        'post_content' => woolyhome_b2b_home_block_content(),
    ));

    update_option('woolyhome_b2b_home_blocks_seeded', time(), false);
}

function woolyhome_b2b_has_home_blocks($post): bool {
    if (!function_exists('acf_register_block_type') || !$post instanceof WP_Post) {
        return false;
    }

    $blocks = parse_blocks($post->post_content);
    return woolyhome_b2b_contains_home_block($blocks);
}

function woolyhome_b2b_contains_home_block(array $blocks): bool {
    foreach ($blocks as $block) {
        $name = $block['blockName'] ?? '';
        if (is_string($name) && strpos($name, 'acf/woolyhome-') === 0) {
            return true;
        }

        if (!empty($block['innerBlocks']) && woolyhome_b2b_contains_home_block($block['innerBlocks'])) {
            return true;
        }
    }

    return false;
}

function woolyhome_b2b_block_field(string $key, $default = null) {
    return woolyhome_b2b_field($key, false, $default);
}

function woolyhome_b2b_render_home_block(array $block, string $content = '', bool $is_preview = false, int $post_id = 0): void {
    $name = str_replace('acf/', '', $block['name'] ?? '');

    echo '<div class="wh-acf-block wh-acf-block-' . esc_attr($name) . '">';

    switch ($name) {
        case 'woolyhome-hero':
            woolyhome_b2b_render_hero_block();
            break;
        case 'woolyhome-product-categories':
            woolyhome_b2b_render_product_categories_block();
            break;
        case 'woolyhome-why':
            woolyhome_b2b_render_why_block();
            break;
        case 'woolyhome-oem':
            woolyhome_b2b_render_oem_block();
            break;
        case 'woolyhome-factory':
            woolyhome_b2b_render_factory_block();
            break;
        case 'woolyhome-quality':
            woolyhome_b2b_render_quality_block();
            break;
        case 'woolyhome-inquiry-cta':
            woolyhome_b2b_render_inquiry_cta_block();
            break;
        case 'woolyhome-blog-preview':
            woolyhome_b2b_render_blog_preview_block();
            break;
        case 'woolyhome-contact-info':
            woolyhome_b2b_render_contact_info_block();
            break;
    }

    echo '</div>';
}

function woolyhome_b2b_render_hero_block(): void {
    $eyebrow = woolyhome_b2b_block_field('hero_eyebrow', 'Soft Natural Wool Lifestyle B2B Manufacturer');
    $title = woolyhome_b2b_block_field('hero_title', 'Natural Wool & Sheepskin Products for Global B2B Buyers');
    $subtitle = woolyhome_b2b_block_field('hero_subtitle', 'WoolyHome supplies soft, natural wool and sheepskin products for brands, wholesalers, retailers, hotels, and private label projects worldwide.');
    ?>
    <section class="wh-hero">
        <div class="wh-container wh-hero-grid">
            <div class="wh-hero-copy">
                <p class="wh-eyebrow"><?php echo esc_html($eyebrow); ?></p>
                <h1><?php echo esc_html($title); ?></h1>
                <p><?php echo esc_html($subtitle); ?></p>
                <div class="wh-trust-line"><span>OEM / ODM Available</span><span>Bulk Supply</span><span>Private Label Support</span></div>
                <div class="wh-actions">
                    <a class="wh-btn wh-btn-primary" href="<?php echo esc_url(woolyhome_b2b_block_field('hero_primary_button_link', '#inquiry')); ?>"><?php echo esc_html(woolyhome_b2b_block_field('hero_primary_button_text', 'Request a Quote')); ?></a>
                    <a class="wh-btn wh-btn-secondary" href="<?php echo esc_url(woolyhome_b2b_block_field('hero_secondary_button_link', '#products')); ?>"><?php echo esc_html(woolyhome_b2b_block_field('hero_secondary_button_text', 'View Product Range')); ?></a>
                </div>
            </div>
            <div class="wh-hero-visual">
                <?php echo woolyhome_b2b_image(woolyhome_b2b_block_field('hero_image', null), 'Wool comforter and sheepskin lifestyle image', 'wh-hero-image', 'large', 'hero'); ?>
                <div class="wh-note-card"><strong>Natural comfort, ready for private label.</strong><span>Custom size, material, label, and packaging support.</span></div>
            </div>
        </div>
    </section>
    <?php
}

function woolyhome_b2b_render_product_categories_block(): void {
    $cards = woolyhome_b2b_block_field('product_category_cards', array());
    if (!$cards) {
        $cards = array_map(function ($cat) {
            return array('title' => $cat['name'], 'description' => $cat['desc'], 'image' => null, 'link' => home_url('/product-category/' . $cat['slug'] . '/'));
        }, woolyhome_b2b_demo_categories());
    }
    ?>
    <section class="wh-section" id="products">
        <div class="wh-container">
            <div class="wh-section-heading center">
                <p class="wh-eyebrow">Product Range</p>
                <h2><?php echo esc_html(woolyhome_b2b_block_field('product_categories_section_title', 'Explore Our Wool & Sheepskin Product Range')); ?></h2>
                <p><?php echo esc_html(woolyhome_b2b_block_field('product_categories_section_text', 'From home textiles to wearable wool accessories, WoolyHome develops natural product collections for bulk buyers and private label partners.')); ?></p>
            </div>
            <div class="wh-category-grid">
                <?php foreach ($cards as $cat) : ?>
                    <?php
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
    <?php
}

function woolyhome_b2b_render_why_block(): void {
    $points = woolyhome_b2b_block_field('why_points', array());
    if (!$points) {
        $points = array(
            array('title' => 'Natural Wool Materials', 'description' => 'Selected wool and sheepskin materials for soft, breathable, and comfortable product lines.'),
            array('title' => 'OEM / ODM Support', 'description' => 'Custom size, color, label, packaging, and product development support for private label buyers.'),
            array('title' => 'Bulk Production', 'description' => 'Stable production planning for wholesale, retail, hotel, and seasonal purchasing needs.'),
            array('title' => 'Quality Inspection', 'description' => 'Material, stitching, size, cleanliness, and packing checks before shipment.'),
        );
    }
    ?>
    <section class="wh-section wh-section-blue">
        <div class="wh-container wh-value-grid">
            <div>
                <p class="wh-eyebrow">Why WoolyHome</p>
                <h2><?php echo esc_html(woolyhome_b2b_block_field('why_title', 'Why Global Buyers Work with WoolyHome')); ?></h2>
                <p><?php echo esc_html(woolyhome_b2b_block_field('why_text', 'We combine natural wool materials, flexible customization, and export-focused production support to help B2B buyers build reliable wool product collections.')); ?></p>
                <a class="wh-btn wh-btn-primary" href="#inquiry">Discuss Your Project</a>
            </div>
            <div class="wh-value-cards">
                <?php $i = 1; foreach ($points as $point) : ?>
                    <article class="wh-value-card <?php echo $i === count($points) && $i % 2 ? 'wh-wide' : ''; ?>">
                        <span><?php echo esc_html($point['icon'] ?? str_pad((string) $i, 2, '0', STR_PAD_LEFT)); ?></span>
                        <h3><?php echo esc_html($point['title'] ?? 'Value Point'); ?></h3>
                        <p><?php echo esc_html($point['description'] ?? $point['text'] ?? 'B2B manufacturer support.'); ?></p>
                    </article>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </section>
    <?php
}

function woolyhome_b2b_render_oem_block(): void {
    $options = woolyhome_b2b_repeater_values(woolyhome_b2b_block_field('oem_options', ''), array('Custom Size & Shape', 'Material & Wool Filling Options', 'Private Label & Woven Labels', 'Custom Packaging', 'Sample Development', 'Bulk Order Support'));
    ?>
    <section class="wh-section" id="oem">
        <div class="wh-container wh-split">
            <?php echo woolyhome_b2b_image(woolyhome_b2b_block_field('oem_image', null), 'OEM packaging image', 'wh-tall-image', 'large', 'oem packaging'); ?>
            <div>
                <p class="wh-eyebrow">OEM / ODM</p>
                <h2><?php echo esc_html(woolyhome_b2b_block_field('oem_title', 'OEM / ODM Wool Product Development')); ?></h2>
                <p><?php echo esc_html(woolyhome_b2b_block_field('oem_text', 'Support your brand with flexible customization for wool and sheepskin products, from material selection to branded packaging.')); ?></p>
                <div class="wh-option-grid">
                    <?php foreach ($options as $option) : ?>
                        <span><?php echo esc_html($option); ?></span>
                    <?php endforeach; ?>
                </div>
                <a class="wh-btn wh-btn-primary" href="<?php echo esc_url(woolyhome_b2b_block_field('oem_button_link', home_url('/oem-odm/'))); ?>"><?php echo esc_html(woolyhome_b2b_block_field('oem_button_text', 'Start OEM / ODM Project')); ?></a>
            </div>
        </div>
    </section>
    <?php
}

function woolyhome_b2b_render_factory_block(): void {
    $steps = woolyhome_b2b_block_field('factory_steps', array());
    if (!$steps) {
        $steps = array(
            array('title' => 'Material Preparation', 'description' => 'Incoming wool and sheepskin materials are prepared for order requirements.'),
            array('title' => 'Cutting & Sewing', 'description' => 'Shapes, covers, and textile parts are cut and sewn for bulk production.'),
            array('title' => 'Filling & Finishing', 'description' => 'Comforters and accessories are filled, finished, and checked before packing.'),
            array('title' => 'Packing for Shipment', 'description' => 'Orders are packed for export, retail programs, and private label needs.'),
        );
    }
    ?>
    <section class="wh-section wh-section-cream" id="factory">
        <div class="wh-container">
            <div class="wh-section-heading center">
                <p class="wh-eyebrow">Factory & Production</p>
                <h2><?php echo esc_html(woolyhome_b2b_block_field('factory_title', 'Clean, Organized Production for B2B Orders')); ?></h2>
                <p><?php echo esc_html(woolyhome_b2b_block_field('factory_text', 'Our production process is designed for consistent quality, practical customization, and reliable bulk order fulfillment.')); ?></p>
            </div>
            <div class="wh-process-grid">
                <?php foreach ($steps as $step) : ?>
                    <article class="wh-process-card">
                        <?php echo woolyhome_b2b_image(woolyhome_b2b_block_field('factory_image', null), 'Factory clean production image', 'wh-process-image', 'large', 'factory'); ?>
                        <h3><?php echo esc_html(is_array($step) ? ($step['title'] ?? 'Production Step') : $step); ?></h3>
                        <p><?php echo esc_html(is_array($step) ? ($step['description'] ?? 'Clean production support for wool and sheepskin B2B orders.') : 'Clean production support for wool and sheepskin B2B orders.'); ?></p>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php
}

function woolyhome_b2b_render_quality_block(): void {
    $steps = woolyhome_b2b_repeater_values(woolyhome_b2b_block_field('quality_steps', ''), array('Material Check', 'Size & Specification Check', 'Stitching & Finish Check', 'Cleanliness Review', 'Final Packing Inspection'));
    ?>
    <section class="wh-section wh-section-blue" id="quality">
        <div class="wh-container wh-quality-grid">
            <div>
                <p class="wh-eyebrow">Quality Control</p>
                <h2><?php echo esc_html(woolyhome_b2b_block_field('quality_title', 'Quality Control Before Every Shipment')); ?></h2>
                <p><?php echo esc_html(woolyhome_b2b_block_field('quality_text', 'From incoming materials to final packing, each order is checked to support stable quality for international buyers.')); ?></p>
                <a class="wh-btn wh-btn-primary" href="<?php echo esc_url(home_url('/quality-control/')); ?>">Learn About Quality Control</a>
            </div>
            <div class="wh-quality-panel">
                <?php echo woolyhome_b2b_image(woolyhome_b2b_block_field('quality_image', null), 'Quality inspection image', 'wh-quality-image', 'large', 'quality'); ?>
                <ol class="wh-step-list">
                    <?php $i = 1; foreach ($steps as $step) : ?>
                        <li><span><?php echo esc_html(str_pad((string) $i, 2, '0', STR_PAD_LEFT)); ?></span><?php echo esc_html($step); ?></li>
                    <?php $i++; endforeach; ?>
                </ol>
            </div>
        </div>
    </section>
    <?php
}

function woolyhome_b2b_render_inquiry_cta_block(): void {
    get_template_part('template-parts/components/inquiry-cta', null, array(
        'title'     => woolyhome_b2b_block_field('inquiry_title', 'Looking for Wool Products for Your Brand?'),
        'text'      => woolyhome_b2b_block_field('inquiry_text', 'Tell us what you are sourcing. We will help you review product options, customization details, and bulk order requirements.'),
        'shortcode' => woolyhome_b2b_block_field('inquiry_form_shortcode', ''),
    ));
}

function woolyhome_b2b_render_blog_preview_block(): void {
    ?>
    <section class="wh-section">
        <div class="wh-container">
            <div class="wh-section-heading row">
                <div>
                    <p class="wh-eyebrow">Sourcing Insights</p>
                    <h2><?php echo esc_html(woolyhome_b2b_block_field('blog_preview_title', 'Insights for Wool Product Sourcing')); ?></h2>
                    <p><?php echo esc_html(woolyhome_b2b_block_field('blog_preview_text', 'Read practical guides about wool materials, product development, private label sourcing, and care tips for natural wool products.')); ?></p>
                </div>
                <a class="wh-btn wh-btn-secondary" href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog/')); ?>">View Blog</a>
            </div>
            <div class="wh-posts-grid">
                <?php
                $posts = get_posts(array('post_type' => 'post', 'posts_per_page' => 3));
                $demo_posts = array(
                    array('title' => 'How to Source Wool Comforters for Private Label Bedding Brands', 'excerpt' => 'Key points for selecting materials, sizes, packaging, and bulk order specifications.', 'meta' => 'Private Label Guide'),
                    array('title' => 'Sheepskin Rugs for Home Retail: What B2B Buyers Should Know', 'excerpt' => 'How to plan rug collections for lifestyle, decor, hospitality, and seasonal programs.', 'meta' => 'Retail Sourcing'),
                    array('title' => 'Wool Dryer Balls: A Natural Laundry Product for Eco-Friendly Gift Sets', 'excerpt' => 'Why reusable wool dryer balls fit eco-friendly retail and private label programs.', 'meta' => 'Eco Gift Sets'),
                );
                foreach ($posts ?: $demo_posts as $post_item) {
                    get_template_part('template-parts/cards/post-card', null, array('post' => $post_item));
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}

function woolyhome_b2b_render_contact_info_block(): void {
    $email = woolyhome_b2b_block_field('contact_email', woolyhome_b2b_contact('contact_email'));
    $phone = woolyhome_b2b_block_field('contact_phone', woolyhome_b2b_contact('contact_phone'));
    $whatsapp = woolyhome_b2b_block_field('contact_whatsapp', woolyhome_b2b_contact('contact_whatsapp'));
    $address = woolyhome_b2b_block_field('contact_address', woolyhome_b2b_contact('contact_address'));
    ?>
    <section class="wh-section wh-section-cream">
        <div class="wh-container">
            <div class="wh-section-heading center">
                <p class="wh-eyebrow">Contact WoolyHome</p>
                <h2>Send Your Wool Product Inquiry</h2>
                <p>Share your product interest, quantity, customization needs, and target market. Our team will reply with sourcing support.</p>
            </div>
            <div class="wh-buyer-grid">
                <article class="wh-buyer-card"><span>@</span><h3>Email</h3><p><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></p></article>
                <article class="wh-buyer-card"><span>WA</span><h3>WhatsApp</h3><p><a href="<?php echo esc_url($whatsapp); ?>"><?php echo esc_html($phone); ?></a></p></article>
                <article class="wh-buyer-card"><span>PH</span><h3>Phone</h3><p><a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a></p></article>
                <article class="wh-buyer-card"><span>CN</span><h3>Address</h3><p><?php echo esc_html($address); ?></p></article>
            </div>
        </div>
    </section>
    <?php
}
