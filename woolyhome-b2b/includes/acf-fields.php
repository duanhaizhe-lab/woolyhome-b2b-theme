<?php
/**
 * Local ACF field groups for WoolyHome B2B.
 *
 * @package WoolyHome_B2B
 */

if (!defined('ABSPATH')) {
    exit;
}

function woolyhome_b2b_home_acf_locations(): array {
    $locations = array(
        array(
            array(
                'param'    => 'page_type',
                'operator' => '==',
                'value'    => 'front_page',
            ),
        ),
    );

    $front_page_id = (int) get_option('page_on_front');
    if ($front_page_id) {
        $locations[] = array(
            array(
                'param'    => 'page',
                'operator' => '==',
                'value'    => (string) $front_page_id,
            ),
        );
    }

    $home_page = get_page_by_path('home');
    if ($home_page instanceof WP_Post) {
        $locations[] = array(
            array(
                'param'    => 'page',
                'operator' => '==',
                'value'    => (string) $home_page->ID,
            ),
        );
    }

    return $locations;
}

function woolyhome_b2b_register_local_acf_fields(): void {
    static $registered = false;

    if ($registered) {
        return;
    }

    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $registered = true;

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_home_v2',
        'title' => 'WoolyHome Home Page Fields',
        'fields' => array(
            array('key' => 'field_wh_home_hero_tab', 'label' => 'Hero Section', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_wh_home_hero_eyebrow', 'label' => 'Hero Eyebrow', 'name' => 'hero_eyebrow', 'type' => 'text'),
            array('key' => 'field_wh_home_hero_title', 'label' => 'Hero Title', 'name' => 'hero_title', 'type' => 'text'),
            array('key' => 'field_wh_home_hero_subtitle', 'label' => 'Hero Subtitle', 'name' => 'hero_subtitle', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_home_hero_image', 'label' => 'Hero Image', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_home_hero_primary_button_text', 'label' => 'Primary Button Text', 'name' => 'hero_primary_button_text', 'type' => 'text'),
            array('key' => 'field_wh_home_hero_primary_button_link', 'label' => 'Primary Button Link', 'name' => 'hero_primary_button_link', 'type' => 'url'),
            array('key' => 'field_wh_home_hero_secondary_button_text', 'label' => 'Secondary Button Text', 'name' => 'hero_secondary_button_text', 'type' => 'text'),
            array('key' => 'field_wh_home_hero_secondary_button_link', 'label' => 'Secondary Button Link', 'name' => 'hero_secondary_button_link', 'type' => 'url'),

            array('key' => 'field_wh_home_categories_tab', 'label' => 'Product Categories', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_wh_home_product_categories_section_title', 'label' => 'Section Title', 'name' => 'product_categories_section_title', 'type' => 'text'),
            array('key' => 'field_wh_home_product_categories_section_text', 'label' => 'Section Description', 'name' => 'product_categories_section_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_home_product_category_cards', 'label' => 'Category Cards', 'name' => 'product_category_cards', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Category Card', 'sub_fields' => array(
                array('key' => 'field_wh_home_category_card_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_wh_home_category_card_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_wh_home_category_card_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_wh_home_category_card_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'),
            )),

            array('key' => 'field_wh_home_why_tab', 'label' => 'Why WoolyHome', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_wh_home_why_title', 'label' => 'Why Title', 'name' => 'why_title', 'type' => 'text'),
            array('key' => 'field_wh_home_why_text', 'label' => 'Why Text', 'name' => 'why_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_home_why_points', 'label' => 'Value Points', 'name' => 'why_points', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Value Point', 'sub_fields' => array(
                array('key' => 'field_wh_home_why_point_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_wh_home_why_point_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_wh_home_why_point_icon', 'label' => 'Icon Label', 'name' => 'icon', 'type' => 'text'),
            )),

            array('key' => 'field_wh_home_oem_tab', 'label' => 'OEM Section', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_wh_home_oem_title', 'label' => 'OEM Title', 'name' => 'oem_title', 'type' => 'text'),
            array('key' => 'field_wh_home_oem_text', 'label' => 'OEM Text', 'name' => 'oem_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_home_oem_image', 'label' => 'OEM Image', 'name' => 'oem_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_home_oem_options', 'label' => 'OEM Options', 'name' => 'oem_options', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Option', 'sub_fields' => array(
                array('key' => 'field_wh_home_oem_option', 'label' => 'Option', 'name' => 'option', 'type' => 'text'),
            )),
            array('key' => 'field_wh_home_oem_button_text', 'label' => 'Button Text', 'name' => 'oem_button_text', 'type' => 'text'),
            array('key' => 'field_wh_home_oem_button_link', 'label' => 'Button Link', 'name' => 'oem_button_link', 'type' => 'url'),

            array('key' => 'field_wh_home_factory_tab', 'label' => 'Factory Section', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_wh_home_factory_title', 'label' => 'Factory Title', 'name' => 'factory_title', 'type' => 'text'),
            array('key' => 'field_wh_home_factory_text', 'label' => 'Factory Text', 'name' => 'factory_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_home_factory_image', 'label' => 'Factory Image', 'name' => 'factory_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_home_factory_steps', 'label' => 'Factory Steps', 'name' => 'factory_steps', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Factory Step', 'sub_fields' => array(
                array('key' => 'field_wh_home_factory_step_title', 'label' => 'Step Title', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_wh_home_factory_step_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
            )),

            array('key' => 'field_wh_home_quality_tab', 'label' => 'Quality Section', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_wh_home_quality_title', 'label' => 'Quality Title', 'name' => 'quality_title', 'type' => 'text'),
            array('key' => 'field_wh_home_quality_text', 'label' => 'Quality Text', 'name' => 'quality_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_home_quality_image', 'label' => 'Quality Image', 'name' => 'quality_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_home_quality_steps', 'label' => 'Quality Steps', 'name' => 'quality_steps', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add QC Step', 'sub_fields' => array(
                array('key' => 'field_wh_home_quality_step', 'label' => 'Step', 'name' => 'step', 'type' => 'text'),
            )),

            array('key' => 'field_wh_home_inquiry_tab', 'label' => 'Inquiry CTA', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_wh_home_inquiry_title', 'label' => 'Inquiry Title', 'name' => 'inquiry_title', 'type' => 'text'),
            array('key' => 'field_wh_home_inquiry_text', 'label' => 'Inquiry Text', 'name' => 'inquiry_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_home_inquiry_form_shortcode', 'label' => 'Inquiry Form Shortcode', 'name' => 'inquiry_form_shortcode', 'type' => 'textarea', 'rows' => 2),

            array('key' => 'field_wh_home_blog_tab', 'label' => 'Blog Preview', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_wh_home_blog_preview_title', 'label' => 'Blog Preview Title', 'name' => 'blog_preview_title', 'type' => 'text'),
            array('key' => 'field_wh_home_blog_preview_text', 'label' => 'Blog Preview Text', 'name' => 'blog_preview_text', 'type' => 'textarea', 'rows' => 3),

            array('key' => 'field_wh_home_contact_tab', 'label' => 'Contact Info', 'type' => 'tab', 'placement' => 'top'),
            array('key' => 'field_wh_home_contact_email', 'label' => 'Contact Email', 'name' => 'contact_email', 'type' => 'email'),
            array('key' => 'field_wh_home_contact_phone', 'label' => 'Contact Phone', 'name' => 'contact_phone', 'type' => 'text'),
            array('key' => 'field_wh_home_contact_whatsapp', 'label' => 'Contact WhatsApp', 'name' => 'contact_whatsapp', 'type' => 'url'),
            array('key' => 'field_wh_home_contact_address', 'label' => 'Contact Address', 'name' => 'contact_address', 'type' => 'text'),
        ),
        'location' => woolyhome_b2b_home_acf_locations(),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_pages_v2',
        'title' => 'WoolyHome Page Fields',
        'fields' => array(
            array('key' => 'field_wh_page_banner_title', 'label' => 'Banner Title', 'name' => 'banner_title', 'type' => 'text'),
            array('key' => 'field_wh_page_banner_subtitle', 'label' => 'Banner Subtitle', 'name' => 'banner_subtitle', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_page_banner_image', 'label' => 'Banner Image', 'name' => 'banner_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_page_section_text', 'label' => 'Section Text', 'name' => 'section_text', 'type' => 'wysiwyg'),
            array('key' => 'field_wh_page_section_image', 'label' => 'Section Image', 'name' => 'section_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_page_faq', 'label' => 'FAQ', 'name' => 'faq', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add FAQ', 'sub_fields' => array(
                array('key' => 'field_wh_page_faq_question', 'label' => 'Question', 'name' => 'question', 'type' => 'text'),
                array('key' => 'field_wh_page_faq_answer', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3),
            )),
            array('key' => 'field_wh_page_cta_title', 'label' => 'CTA Title', 'name' => 'cta_title', 'type' => 'text'),
            array('key' => 'field_wh_page_cta_text', 'label' => 'CTA Text', 'name' => 'cta_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_page_form_shortcode', 'label' => 'Form Shortcode', 'name' => 'form_shortcode', 'type' => 'textarea', 'rows' => 2),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'page',
                ),
            ),
        ),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_products_v2',
        'title' => 'WoolyHome Product Fields',
        'fields' => array(
            array('key' => 'field_wh_product_short_description', 'label' => 'Short Description', 'name' => 'product_short_description', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_product_main_image', 'label' => 'Main Image', 'name' => 'product_main_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_product_gallery', 'label' => 'Gallery', 'name' => 'product_gallery', 'type' => 'gallery', 'return_format' => 'array'),
            array('key' => 'field_wh_product_key_features', 'label' => 'Key Features', 'name' => 'key_features', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Feature', 'sub_fields' => array(
                array('key' => 'field_wh_product_key_feature', 'label' => 'Feature', 'name' => 'feature', 'type' => 'text'),
            )),
            array('key' => 'field_wh_product_specifications', 'label' => 'Specifications', 'name' => 'specifications', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Specification', 'sub_fields' => array(
                array('key' => 'field_wh_product_spec_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text'),
                array('key' => 'field_wh_product_spec_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text'),
            )),
            array('key' => 'field_wh_product_materials', 'label' => 'Materials', 'name' => 'materials', 'type' => 'textarea'),
            array('key' => 'field_wh_product_sizes', 'label' => 'Sizes', 'name' => 'sizes', 'type' => 'textarea'),
            array('key' => 'field_wh_product_custom_options', 'label' => 'Custom Options', 'name' => 'custom_options', 'type' => 'textarea'),
            array('key' => 'field_wh_product_packaging_options', 'label' => 'Packaging Options', 'name' => 'packaging_options', 'type' => 'textarea'),
            array('key' => 'field_wh_product_applications', 'label' => 'Applications', 'name' => 'applications', 'type' => 'textarea'),
            array('key' => 'field_wh_product_faq', 'label' => 'FAQ', 'name' => 'faq', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add FAQ', 'sub_fields' => array(
                array('key' => 'field_wh_product_faq_question', 'label' => 'Question', 'name' => 'question', 'type' => 'text'),
                array('key' => 'field_wh_product_faq_answer', 'label' => 'Answer', 'name' => 'answer', 'type' => 'textarea', 'rows' => 3),
            )),
            array('key' => 'field_wh_product_inquiry_cta', 'label' => 'Inquiry CTA', 'name' => 'inquiry_cta', 'type' => 'textarea'),
        ),
        'location' => array(
            array(
                array(
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'products',
                ),
            ),
        ),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));
}
add_action('acf/init', 'woolyhome_b2b_register_local_acf_fields');
add_action('acf/include_fields', 'woolyhome_b2b_register_local_acf_fields');

function woolyhome_b2b_acf_block_location(string $block_name): array {
    return array(
        array(
            array(
                'param'    => 'block',
                'operator' => '==',
                'value'    => 'acf/' . $block_name,
            ),
        ),
    );
}

function woolyhome_b2b_register_acf_block_fields(): void {
    static $registered = false;

    if ($registered) {
        return;
    }

    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $registered = true;

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_block_hero_v1',
        'title' => 'Block: WoolyHome Hero',
        'fields' => array(
            array('key' => 'field_wh_block_hero_eyebrow', 'label' => 'Hero Eyebrow', 'name' => 'hero_eyebrow', 'type' => 'text'),
            array('key' => 'field_wh_block_hero_title', 'label' => 'Hero Title', 'name' => 'hero_title', 'type' => 'text'),
            array('key' => 'field_wh_block_hero_subtitle', 'label' => 'Hero Subtitle', 'name' => 'hero_subtitle', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_block_hero_image', 'label' => 'Hero Image', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_block_hero_primary_button_text', 'label' => 'Primary Button Text', 'name' => 'hero_primary_button_text', 'type' => 'text'),
            array('key' => 'field_wh_block_hero_primary_button_link', 'label' => 'Primary Button Link', 'name' => 'hero_primary_button_link', 'type' => 'url'),
            array('key' => 'field_wh_block_hero_secondary_button_text', 'label' => 'Secondary Button Text', 'name' => 'hero_secondary_button_text', 'type' => 'text'),
            array('key' => 'field_wh_block_hero_secondary_button_link', 'label' => 'Secondary Button Link', 'name' => 'hero_secondary_button_link', 'type' => 'url'),
        ),
        'location' => woolyhome_b2b_acf_block_location('woolyhome-hero'),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_block_categories_v1',
        'title' => 'Block: Product Categories',
        'fields' => array(
            array('key' => 'field_wh_block_categories_title', 'label' => 'Section Title', 'name' => 'product_categories_section_title', 'type' => 'text'),
            array('key' => 'field_wh_block_categories_text', 'label' => 'Section Description', 'name' => 'product_categories_section_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_block_category_cards', 'label' => 'Category Cards', 'name' => 'product_category_cards', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Category Card', 'sub_fields' => array(
                array('key' => 'field_wh_block_category_card_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_wh_block_category_card_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_wh_block_category_card_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
                array('key' => 'field_wh_block_category_card_link', 'label' => 'Link', 'name' => 'link', 'type' => 'url'),
            )),
        ),
        'location' => woolyhome_b2b_acf_block_location('woolyhome-product-categories'),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_block_why_v1',
        'title' => 'Block: Why WoolyHome',
        'fields' => array(
            array('key' => 'field_wh_block_why_title', 'label' => 'Section Title', 'name' => 'why_title', 'type' => 'text'),
            array('key' => 'field_wh_block_why_text', 'label' => 'Section Text', 'name' => 'why_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_block_why_points', 'label' => 'Value Points', 'name' => 'why_points', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Value Point', 'sub_fields' => array(
                array('key' => 'field_wh_block_why_point_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_wh_block_why_point_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 3),
                array('key' => 'field_wh_block_why_point_icon', 'label' => 'Icon / Number Label', 'name' => 'icon', 'type' => 'text'),
            )),
        ),
        'location' => woolyhome_b2b_acf_block_location('woolyhome-why'),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_block_oem_v1',
        'title' => 'Block: OEM / ODM',
        'fields' => array(
            array('key' => 'field_wh_block_oem_title', 'label' => 'Section Title', 'name' => 'oem_title', 'type' => 'text'),
            array('key' => 'field_wh_block_oem_text', 'label' => 'Section Text', 'name' => 'oem_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_block_oem_image', 'label' => 'Image', 'name' => 'oem_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_block_oem_options', 'label' => 'Options', 'name' => 'oem_options', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add Option', 'sub_fields' => array(
                array('key' => 'field_wh_block_oem_option', 'label' => 'Option', 'name' => 'option', 'type' => 'text'),
            )),
            array('key' => 'field_wh_block_oem_button_text', 'label' => 'Button Text', 'name' => 'oem_button_text', 'type' => 'text'),
            array('key' => 'field_wh_block_oem_button_link', 'label' => 'Button Link', 'name' => 'oem_button_link', 'type' => 'url'),
        ),
        'location' => woolyhome_b2b_acf_block_location('woolyhome-oem'),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_block_factory_v1',
        'title' => 'Block: Factory Preview',
        'fields' => array(
            array('key' => 'field_wh_block_factory_title', 'label' => 'Section Title', 'name' => 'factory_title', 'type' => 'text'),
            array('key' => 'field_wh_block_factory_text', 'label' => 'Section Text', 'name' => 'factory_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_block_factory_image', 'label' => 'Image', 'name' => 'factory_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_block_factory_steps', 'label' => 'Production Steps', 'name' => 'factory_steps', 'type' => 'repeater', 'layout' => 'block', 'button_label' => 'Add Step', 'sub_fields' => array(
                array('key' => 'field_wh_block_factory_step_title', 'label' => 'Step Title', 'name' => 'title', 'type' => 'text'),
                array('key' => 'field_wh_block_factory_step_description', 'label' => 'Description', 'name' => 'description', 'type' => 'textarea', 'rows' => 2),
            )),
        ),
        'location' => woolyhome_b2b_acf_block_location('woolyhome-factory'),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_block_quality_v1',
        'title' => 'Block: Quality Control',
        'fields' => array(
            array('key' => 'field_wh_block_quality_title', 'label' => 'Section Title', 'name' => 'quality_title', 'type' => 'text'),
            array('key' => 'field_wh_block_quality_text', 'label' => 'Section Text', 'name' => 'quality_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_block_quality_image', 'label' => 'Image', 'name' => 'quality_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium'),
            array('key' => 'field_wh_block_quality_steps', 'label' => 'Quality Steps', 'name' => 'quality_steps', 'type' => 'repeater', 'layout' => 'table', 'button_label' => 'Add QC Step', 'sub_fields' => array(
                array('key' => 'field_wh_block_quality_step', 'label' => 'Step', 'name' => 'step', 'type' => 'text'),
            )),
        ),
        'location' => woolyhome_b2b_acf_block_location('woolyhome-quality'),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_block_inquiry_v1',
        'title' => 'Block: Inquiry CTA',
        'fields' => array(
            array('key' => 'field_wh_block_inquiry_title', 'label' => 'CTA Title', 'name' => 'inquiry_title', 'type' => 'text'),
            array('key' => 'field_wh_block_inquiry_text', 'label' => 'CTA Text', 'name' => 'inquiry_text', 'type' => 'textarea', 'rows' => 3),
            array('key' => 'field_wh_block_inquiry_shortcode', 'label' => 'Form Shortcode', 'name' => 'inquiry_form_shortcode', 'type' => 'textarea', 'rows' => 2),
        ),
        'location' => woolyhome_b2b_acf_block_location('woolyhome-inquiry-cta'),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_block_blog_v1',
        'title' => 'Block: Blog Preview',
        'fields' => array(
            array('key' => 'field_wh_block_blog_title', 'label' => 'Section Title', 'name' => 'blog_preview_title', 'type' => 'text'),
            array('key' => 'field_wh_block_blog_text', 'label' => 'Section Text', 'name' => 'blog_preview_text', 'type' => 'textarea', 'rows' => 3),
        ),
        'location' => woolyhome_b2b_acf_block_location('woolyhome-blog-preview'),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));

    acf_add_local_field_group(array(
        'key' => 'group_woolyhome_block_contact_v1',
        'title' => 'Block: Contact Info',
        'fields' => array(
            array('key' => 'field_wh_block_contact_email', 'label' => 'Email', 'name' => 'contact_email', 'type' => 'email'),
            array('key' => 'field_wh_block_contact_phone', 'label' => 'Phone', 'name' => 'contact_phone', 'type' => 'text'),
            array('key' => 'field_wh_block_contact_whatsapp', 'label' => 'WhatsApp Link', 'name' => 'contact_whatsapp', 'type' => 'url'),
            array('key' => 'field_wh_block_contact_address', 'label' => 'Address', 'name' => 'contact_address', 'type' => 'text'),
        ),
        'location' => woolyhome_b2b_acf_block_location('woolyhome-contact-info'),
        'position' => 'normal',
        'style' => 'default',
        'active' => true,
        'show_in_rest' => 1,
    ));
}
add_action('acf/init', 'woolyhome_b2b_register_acf_block_fields');
add_action('acf/include_fields', 'woolyhome_b2b_register_acf_block_fields');
