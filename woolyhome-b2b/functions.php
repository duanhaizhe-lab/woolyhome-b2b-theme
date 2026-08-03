<?php
/**
 * WoolyHome B2B theme functions.
 *
 * @package WoolyHome_B2B
 */

if (!defined('ABSPATH')) {
    exit;
}

define('WOOLYHOME_B2B_VERSION', '0.1.4');
define('WOOLYHOME_B2B_DIR', get_template_directory());
define('WOOLYHOME_B2B_URI', get_template_directory_uri());

function woolyhome_b2b_setup(): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 280,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_editor_style('assets/css/main.css');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'woolyhome-b2b'),
        'footer'  => __('Footer Menu', 'woolyhome-b2b'),
    ));
}
add_action('after_setup_theme', 'woolyhome_b2b_setup');

function woolyhome_b2b_assets(): void {
    wp_enqueue_style(
        'woolyhome-fonts',
        'https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Manrope:wght@400;500;600;700;800&display=swap',
        array(),
        null
    );
    wp_enqueue_style('woolyhome-b2b-main', WOOLYHOME_B2B_URI . '/assets/css/main.css', array('woolyhome-fonts'), WOOLYHOME_B2B_VERSION);
    wp_enqueue_script('woolyhome-b2b-main', WOOLYHOME_B2B_URI . '/assets/js/main.js', array(), WOOLYHOME_B2B_VERSION, true);
}
add_action('wp_enqueue_scripts', 'woolyhome_b2b_assets');

function woolyhome_b2b_register_content_types(): void {
    register_post_type('products', array(
        'labels' => array(
            'name'          => __('Products', 'woolyhome-b2b'),
            'singular_name' => __('Product', 'woolyhome-b2b'),
            'add_new_item'  => __('Add New Product', 'woolyhome-b2b'),
            'edit_item'     => __('Edit Product', 'woolyhome-b2b'),
        ),
        'public'       => true,
        'has_archive'  => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-products',
        'supports'     => array('title', 'editor', 'thumbnail', 'excerpt', 'revisions'),
        'rewrite'      => array('slug' => 'products'),
    ));

    register_taxonomy('product-category', array('products'), array(
        'labels' => array(
            'name'          => __('Product Categories', 'woolyhome-b2b'),
            'singular_name' => __('Product Category', 'woolyhome-b2b'),
        ),
        'public'       => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => array('slug' => 'product-category'),
    ));
}
add_action('init', 'woolyhome_b2b_register_content_types');

function woolyhome_b2b_customize_register(WP_Customize_Manager $wp_customize): void {
    $wp_customize->add_section('woolyhome_contact', array(
        'title'    => __('WoolyHome Contact & Forms', 'woolyhome-b2b'),
        'priority' => 35,
    ));

    $settings = array(
        'contact_email'          => array('Email', 'duanhaizhe@gmail.com'),
        'contact_phone'          => array('Phone', '+86 135 8212 2653'),
        'contact_whatsapp'       => array('WhatsApp Link', 'https://wa.me/8613582122653'),
        'contact_phone_link'     => array('Phone Link', 'tel:+8613582122653'),
        'contact_address'        => array('Address', 'ShiJiaZhuang 050000, China'),
        'inquiry_form_shortcode' => array('Inquiry Form Shortcode', ''),
        'newsletter_shortcode'   => array('Newsletter Shortcode', ''),
        'cn_language_link'       => array('Chinese Link', '/cn/'),
    );

    foreach ($settings as $key => $data) {
        $wp_customize->add_setting($key, array(
            'default'           => $data[1],
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control($key, array(
            'section' => 'woolyhome_contact',
            'label'   => $data[0],
            'type'    => $key === 'inquiry_form_shortcode' || $key === 'newsletter_shortcode' ? 'textarea' : 'text',
        ));
    }
}
add_action('customize_register', 'woolyhome_b2b_customize_register');

function woolyhome_b2b_contact(string $key): string {
    $defaults = array(
        'contact_email'          => 'duanhaizhe@gmail.com',
        'contact_phone'          => '+86 135 8212 2653',
        'contact_whatsapp'       => 'https://wa.me/8613582122653',
        'contact_phone_link'     => 'tel:+8613582122653',
        'contact_address'        => 'ShiJiaZhuang 050000, China',
        'inquiry_form_shortcode' => '',
        'newsletter_shortcode'   => '',
        'cn_language_link'       => '/cn/',
    );
    return (string) get_theme_mod($key, $defaults[$key] ?? '');
}

function woolyhome_b2b_acf_admin_notice(): void {
    if (function_exists('acf_add_local_field_group')) {
        return;
    }

    echo '<div class="notice notice-warning"><p><strong>WoolyHome B2B:</strong> Install and activate Advanced Custom Fields to edit Home sections, page banners, product fields, FAQ, CTA text, and form shortcodes in the WordPress admin. The front end will continue to use theme fallback content until ACF is installed.</p></div>';
}
add_action('admin_notices', 'woolyhome_b2b_acf_admin_notice');

function woolyhome_b2b_field(string $key, $post_id = false, $default = null) {
    if (function_exists('get_field')) {
        $value = get_field($key, $post_id);
        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }
    }
    return $default;
}

function woolyhome_b2b_first_field(array $keys, $post_id = false, $default = null) {
    foreach ($keys as $key) {
        $value = woolyhome_b2b_field($key, $post_id, null);
        if ($value !== null && $value !== false && $value !== '') {
            return $value;
        }
    }
    return $default;
}

function woolyhome_b2b_textarea_lines($value, array $default = array()): array {
    if (is_array($value)) {
        return $value;
    }
    if (!is_string($value) || trim($value) === '') {
        return $default;
    }
    $lines = array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $value)));
    return $lines ?: $default;
}

function woolyhome_b2b_repeater_values($value, array $default = array()): array {
    if (!is_array($value) || !$value) {
        return woolyhome_b2b_textarea_lines($value, $default);
    }

    $items = array();
    foreach ($value as $row) {
        if (is_string($row) && trim($row) !== '') {
            $items[] = trim($row);
            continue;
        }
        if (!is_array($row)) {
            continue;
        }
        foreach (array('title', 'description', 'text', 'option', 'step', 'item') as $key) {
            if (!empty($row[$key])) {
                $items[] = trim((string) $row[$key]);
                break;
            }
        }
    }

    return $items ?: $default;
}

function woolyhome_b2b_default_image_file(string $context = ''): string {
    $context = strtolower($context);
    $map = array(
        'hero'               => 'hero-wool-home.svg',
        'sheepskin'          => 'sheepskin-rugs.svg',
        'comforter'          => 'wool-comforters.svg',
        'dryer'              => 'wool-dryer-balls.svg',
        'glove'              => 'wool-gloves.svg',
        'sock'               => 'wool-socks.svg',
        'oem'                => 'oem-packaging.svg',
        'packaging'          => 'oem-packaging.svg',
        'factory'            => 'factory-preview.svg',
        'workshop'           => 'factory-preview.svg',
        'quality'            => 'quality-control.svg',
        'inspection'         => 'quality-control.svg',
        'contact'            => 'contact-bg.svg',
        'blog'               => 'wool-comforters.svg',
        'product category'   => 'wool-comforters.svg',
        'product'            => 'wool-comforters.svg',
    );

    foreach ($map as $needle => $file) {
        if ($context && strpos($context, $needle) !== false) {
            return $file;
        }
    }

    return 'hero-wool-home.svg';
}

function woolyhome_b2b_default_image_uri(string $context = ''): string {
    return WOOLYHOME_B2B_URI . '/assets/images/' . woolyhome_b2b_default_image_file($context);
}

function woolyhome_b2b_placeholder(string $label, string $class = ''): string {
    return '<img class="wh-image wh-default-image ' . esc_attr($class) . '" src="' . esc_url(woolyhome_b2b_default_image_uri($label . ' ' . $class)) . '" alt="' . esc_attr($label) . '">';
}

function woolyhome_b2b_image($image, string $label, string $class = '', string $size = 'large', string $fallback_context = ''): string {
    if (is_array($image) && !empty($image['ID'])) {
        return wp_get_attachment_image((int) $image['ID'], $size, false, array('class' => trim('wh-image ' . $class)));
    }
    if (is_numeric($image) && (int) $image > 0) {
        return wp_get_attachment_image((int) $image, $size, false, array('class' => trim('wh-image ' . $class)));
    }
    if (is_string($image) && $image !== '') {
        return '<img class="wh-image ' . esc_attr($class) . '" src="' . esc_url($image) . '" alt="' . esc_attr($label) . '">';
    }
    return '<img class="wh-image wh-default-image ' . esc_attr($class) . '" src="' . esc_url(woolyhome_b2b_default_image_uri($fallback_context ?: $label . ' ' . $class)) . '" alt="' . esc_attr($label) . '">';
}

function woolyhome_b2b_create_page_once(string $title, string $slug, string $content = ''): int {
    $existing = get_page_by_path($slug);
    if ($existing instanceof WP_Post) {
        return (int) $existing->ID;
    }

    $found = get_page_by_title($title, OBJECT, 'page');
    if ($found instanceof WP_Post) {
        return (int) $found->ID;
    }

    return (int) wp_insert_post(array(
        'post_title'   => $title,
        'post_name'    => $slug,
        'post_type'    => 'page',
        'post_status'  => 'publish',
        'post_content' => $content,
    ));
}

function woolyhome_b2b_create_product_terms_once(): void {
    foreach (woolyhome_b2b_demo_categories() as $cat) {
        if (!term_exists($cat['slug'], 'product-category')) {
            wp_insert_term($cat['name'], 'product-category', array(
                'slug'        => $cat['slug'],
                'description' => $cat['desc'],
            ));
        }
    }
}

function woolyhome_b2b_page_setup_once(bool $force = false): void {
    if (!$force && get_option('woolyhome_b2b_demo_pages_created')) {
        return;
    }

    woolyhome_b2b_create_product_terms_once();

    $pages = array(
        'home'            => woolyhome_b2b_create_page_once('Home', 'home', 'WoolyHome B2B manufacturer home page.'),
        'products'        => woolyhome_b2b_create_page_once('Products', 'products', 'Wool and sheepskin product collections for B2B sourcing.'),
        'oem-odm'         => woolyhome_b2b_create_page_once('OEM / ODM', 'oem-odm', 'Custom wool product development, private label, packaging, samples, and bulk production.'),
        'factory'         => woolyhome_b2b_create_page_once('Factory', 'factory', 'Clean production, workshop gallery, packing, and export preparation.'),
        'quality-control' => woolyhome_b2b_create_page_once('Quality Control', 'quality-control', 'Material, size, stitching, filling, appearance, and packing inspection.'),
        'blog'            => woolyhome_b2b_create_page_once('Blog', 'blog', 'Wool product sourcing insights and B2B buying guides.'),
        'contact'         => woolyhome_b2b_create_page_once('Contact', 'contact', 'Contact WoolyHome for quote, OEM / ODM, samples, and product requirements.'),
    );

    if (!empty($pages['home'])) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $pages['home']);
    }

    if (!empty($pages['blog'])) {
        update_option('page_for_posts', $pages['blog']);
    }

    $menu_name = 'WoolyHome Primary Menu';
    $menu = wp_get_nav_menu_object($menu_name);
    $menu_id = $menu ? (int) $menu->term_id : (int) wp_create_nav_menu($menu_name);

    if ($menu_id && !is_wp_error($menu_id)) {
        $existing_items = wp_get_nav_menu_items($menu_id);
        $existing_object_ids = array();
        if ($existing_items) {
            foreach ($existing_items as $item) {
                $existing_object_ids[] = (int) $item->object_id;
            }
        }

        foreach ($pages as $page_id) {
            if ($page_id && !in_array((int) $page_id, $existing_object_ids, true)) {
                wp_update_nav_menu_item($menu_id, 0, array(
                    'menu-item-object-id' => (int) $page_id,
                    'menu-item-object'    => 'page',
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                ));
            }
        }

        $locations = get_theme_mod('nav_menu_locations', array());
        if (empty($locations['primary'])) {
            $locations['primary'] = $menu_id;
            set_theme_mod('nav_menu_locations', $locations);
        }
    }

    update_option('woolyhome_b2b_demo_pages_created', time(), false);
    flush_rewrite_rules(false);
}
add_action('after_switch_theme', function () {
    woolyhome_b2b_page_setup_once(true);
});
add_action('init', function () {
    if (!is_admin() && !get_option('woolyhome_b2b_demo_pages_created')) {
        woolyhome_b2b_page_setup_once(false);
    }
}, 30);

function woolyhome_b2b_demo_categories(): array {
    return array(
        array('name' => 'Sheepskin Rugs', 'slug' => 'sheepskin-rugs', 'desc' => 'Soft natural sheepskin rugs for home retail, hospitality, and lifestyle collections.'),
        array('name' => 'Wool Comforters', 'slug' => 'wool-comforters', 'desc' => 'Breathable wool-filled comforters for bedding brands, hotels, and home textile buyers.'),
        array('name' => 'Wool Dryer Balls', 'slug' => 'wool-dryer-balls', 'desc' => 'Reusable wool dryer balls for eco-friendly laundry, gift sets, and private label programs.'),
        array('name' => 'Wool Gloves', 'slug' => 'wool-gloves', 'desc' => 'Warm wool gloves for seasonal retail, outdoor use, and custom brand programs.'),
        array('name' => 'Wool Socks', 'slug' => 'wool-socks', 'desc' => 'Comfortable wool socks for lifestyle, outdoor, travel, and wholesale collections.'),
    );
}

function woolyhome_b2b_demo_products(): array {
    return array(
        array('title' => 'Natural Sheepskin Rug', 'category' => 'Sheepskin Rugs', 'desc' => 'Soft rug direction for home retail, decor brands, and hospitality spaces.'),
        array('title' => 'All-Season Wool Comforter', 'category' => 'Wool Comforters', 'desc' => 'Breathable wool bedding direction for private label and hotel sourcing.'),
        array('title' => 'Reusable Wool Dryer Balls', 'category' => 'Wool Dryer Balls', 'desc' => 'Natural laundry product for eco-friendly gift sets and retail programs.'),
        array('title' => 'Winter Wool Gloves', 'category' => 'Wool Gloves', 'desc' => 'Warm seasonal accessory option for outdoor, lifestyle, and wholesale buyers.'),
        array('title' => 'Warm Wool Socks', 'category' => 'Wool Socks', 'desc' => 'Comfortable wool sock programs for retail, travel, and outdoor collections.'),
    );
}

function woolyhome_b2b_default_faq(): array {
    return array(
        array('question' => 'Can WoolyHome support OEM / ODM orders?', 'answer' => 'Yes. We can support custom size, material, label, packaging, and sample development for B2B buyers.'),
        array('question' => 'Can I replace the inquiry form later?', 'answer' => 'Yes. Replace the form shortcode in the Customizer or page ACF field with Contact Form 7, Web3Forms, or another form plugin shortcode.'),
        array('question' => 'How are products managed in this theme?', 'answer' => 'Products are managed with a dedicated B2B Products post type for inquiry-based sourcing and product presentation.'),
    );
}

function woolyhome_b2b_render_inquiry_form($shortcode = ''): void {
    $shortcode = $shortcode ?: woolyhome_b2b_contact('inquiry_form_shortcode');
    if ($shortcode) {
        echo '<div class="wh-form-shortcode">' . do_shortcode($shortcode) . '</div>';
        return;
    }
    ?>
    <form class="wh-inquiry-form" action="#" method="post">
        <label><span>Name</span><input type="text" name="name" placeholder="Your name"></label>
        <label><span>Email</span><input type="email" name="email" placeholder="you@example.com"></label>
        <label><span>Company</span><input type="text" name="company" placeholder="Company name"></label>
        <label><span>Product Interest</span><select name="product_interest"><option>Wool Comforters</option><option>Sheepskin Rugs</option><option>Wool Dryer Balls</option><option>Wool Gloves</option><option>Wool Socks</option><option>OEM / ODM Project</option></select></label>
        <label><span>Quantity</span><input type="text" name="quantity" placeholder="Estimated quantity"></label>
        <label class="full"><span>Message</span><textarea name="message" rows="5" placeholder="Share your sourcing requirements"></textarea></label>
        <button class="wh-btn wh-btn-light" type="submit">Submit Inquiry</button>
    </form>
    <?php
}

function woolyhome_b2b_render_page_section_content(int $post_id): void {
    $section_text = woolyhome_b2b_field('section_text', $post_id, '');
    $section_image = woolyhome_b2b_field('section_image', $post_id, null);
    $section_images = woolyhome_b2b_field('section_images', $post_id, array());

    if ($section_text) {
        echo '<div class="wh-acf-section-text wh-rich-content">' . wp_kses_post($section_text) . '</div>';
    }

    if ($section_image) {
        echo '<div class="wh-section-gallery wh-section-gallery-single">';
        echo woolyhome_b2b_image($section_image, 'Section image', 'wh-gallery-image');
        echo '</div>';
    }

    if (is_array($section_images) && $section_images) {
        echo '<div class="wh-section-gallery">';
        foreach ($section_images as $image) {
            echo woolyhome_b2b_image($image, 'Section image', 'wh-gallery-image');
        }
        echo '</div>';
    }
}

function woolyhome_b2b_breadcrumbs(): void {
    if (is_front_page()) {
        return;
    }
    echo '<nav class="wh-breadcrumbs" aria-label="Breadcrumbs"><a href="' . esc_url(home_url('/')) . '">Home</a><span>/</span>';
    if (is_singular('products')) {
        echo '<a href="' . esc_url(get_post_type_archive_link('products')) . '">Products</a><span>/</span><span>' . esc_html(get_the_title()) . '</span>';
    } elseif (is_tax('product-category')) {
        echo '<a href="' . esc_url(get_post_type_archive_link('products')) . '">Products</a><span>/</span><span>' . esc_html(single_term_title('', false)) . '</span>';
    } elseif (is_singular('post')) {
        echo '<a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '">Blog</a><span>/</span><span>' . esc_html(get_the_title()) . '</span>';
    } else {
        echo '<span>' . esc_html(wp_get_document_title()) . '</span>';
    }
    echo '</nav>';
}

function woolyhome_b2b_faq_schema(array $faq): void {
    if (!$faq || defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION')) {
        return;
    }
    $entities = array();
    foreach ($faq as $item) {
        $q = $item['question'] ?? '';
        $a = $item['answer'] ?? '';
        if ($q && $a) {
            $entities[] = array('@type' => 'Question', 'name' => wp_strip_all_tags($q), 'acceptedAnswer' => array('@type' => 'Answer', 'text' => wp_strip_all_tags($a)));
        }
    }
    if ($entities) {
        echo '<script type="application/ld+json">' . wp_json_encode(array('@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $entities), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }
}

function woolyhome_b2b_schema(): void {
    if (defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION')) {
        return;
    }
    $schema = array(
        '@context' => 'https://schema.org',
        '@type'    => 'Organization',
        'name'     => 'WoolyHome',
        'url'      => home_url('/'),
        'email'    => woolyhome_b2b_contact('contact_email'),
        'telephone'=> woolyhome_b2b_contact('contact_phone'),
        'address'  => array('@type' => 'PostalAddress', 'addressLocality' => 'ShiJiaZhuang', 'postalCode' => '050000', 'addressCountry' => 'CN'),
    );
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';

    if (is_singular('post')) {
        $article = array('@context' => 'https://schema.org', '@type' => 'Article', 'headline' => get_the_title(), 'datePublished' => get_the_date('c'), 'dateModified' => get_the_modified_date('c'), 'author' => array('@type' => 'Organization', 'name' => 'WoolyHome'));
        echo '<script type="application/ld+json">' . wp_json_encode($article, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }
    if (is_singular('products')) {
        $product = array('@context' => 'https://schema.org', '@type' => 'Product', 'name' => get_the_title(), 'description' => wp_strip_all_tags(get_the_excerpt() ?: woolyhome_b2b_field('product_short_description', get_the_ID(), 'Natural wool and sheepskin B2B product.')), 'brand' => array('@type' => 'Brand', 'name' => 'WoolyHome'));
        echo '<script type="application/ld+json">' . wp_json_encode($product, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }

    if (!is_front_page()) {
        $items = array(
            array('@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => home_url('/')),
            array('@type' => 'ListItem', 'position' => 2, 'name' => wp_strip_all_tags(wp_get_document_title()), 'item' => esc_url_raw(home_url(add_query_arg(array(), $GLOBALS['wp']->request ?? '')))),
        );
        echo '<script type="application/ld+json">' . wp_json_encode(array('@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>';
    }
}
add_action('wp_head', 'woolyhome_b2b_schema', 20);

require_once WOOLYHOME_B2B_DIR . '/includes/acf-fields.php';
require_once WOOLYHOME_B2B_DIR . '/includes/acf-blocks.php';
