(function (wp) {
    if (!wp || !wp.blocks || !wp.element || !wp.components || !wp.blockEditor) {
        return;
    }

    var el = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var PanelBody = wp.components.PanelBody;
    var InspectorControls = wp.blockEditor.InspectorControls;

    function setAttr(props, key) {
        return function (value) {
            var update = {};
            update[key] = value;
            props.setAttributes(update);
        };
    }

    function textField(props, label, key) {
        return el(TextControl, {
            label: label,
            value: props.attributes[key] || '',
            onChange: setAttr(props, key)
        });
    }

    function textareaField(props, label, key, help) {
        return el(TextareaControl, {
            label: label,
            help: help || '',
            rows: 4,
            value: props.attributes[key] || '',
            onChange: setAttr(props, key)
        });
    }

    function editPanel(props, title, fields) {
        return el(
            'div',
            { className: 'wh-editor-section-card' },
            el(InspectorControls, {},
                el(PanelBody, { title: title + ' Settings', initialOpen: true }, fields)
            ),
            el('div', { className: 'wh-editor-section-card-inner' },
                el('strong', {}, title),
                el('p', {}, 'Edit this WoolyHome home section in the block settings panel. The front end uses the theme design and fallback content for empty fields.')
            )
        );
    }

    function attrs() {
        var keys = [
            'hero_eyebrow', 'hero_title', 'hero_subtitle', 'hero_image', 'hero_primary_button_text', 'hero_primary_button_link', 'hero_secondary_button_text', 'hero_secondary_button_link',
            'product_categories_section_title', 'product_categories_section_text', 'product_category_cards',
            'why_title', 'why_text', 'why_points',
            'oem_title', 'oem_text', 'oem_image', 'oem_options', 'oem_button_text', 'oem_button_link',
            'factory_title', 'factory_text', 'factory_image', 'factory_steps',
            'quality_title', 'quality_text', 'quality_image', 'quality_steps',
            'inquiry_title', 'inquiry_text', 'inquiry_form_shortcode',
            'blog_preview_title', 'blog_preview_text',
            'contact_email', 'contact_phone', 'contact_whatsapp', 'contact_address'
        ];
        var schema = {};
        keys.forEach(function (key) {
            schema[key] = { type: 'string', default: '' };
        });
        return schema;
    }

    function register(name, title, icon, fields) {
        registerBlockType('woolyhome/' + name, {
            title: title,
            icon: icon,
            category: 'woolyhome',
            attributes: attrs(),
            edit: function (props) {
                return editPanel(props, title, fields(props));
            },
            save: function () {
                return null;
            }
        });
    }

    register('hero', 'WoolyHome Hero Block', 'cover-image', function (props) {
        return [
            textField(props, 'Hero Eyebrow', 'hero_eyebrow'),
            textField(props, 'Hero Title', 'hero_title'),
            textareaField(props, 'Hero Subtitle', 'hero_subtitle'),
            textField(props, 'Hero Image URL', 'hero_image'),
            textField(props, 'Primary Button Text', 'hero_primary_button_text'),
            textField(props, 'Primary Button Link', 'hero_primary_button_link'),
            textField(props, 'Secondary Button Text', 'hero_secondary_button_text'),
            textField(props, 'Secondary Button Link', 'hero_secondary_button_link')
        ];
    });

    register('product-categories', 'Product Categories Block', 'grid-view', function (props) {
        return [
            textField(props, 'Section Title', 'product_categories_section_title'),
            textareaField(props, 'Section Text', 'product_categories_section_text'),
            textareaField(props, 'Category Cards', 'product_category_cards', 'One card per line: Title | Description | Link | Image URL')
        ];
    });

    register('why', 'Why WoolyHome Block', 'yes-alt', function (props) {
        return [
            textField(props, 'Section Title', 'why_title'),
            textareaField(props, 'Section Text', 'why_text'),
            textareaField(props, 'Value Points', 'why_points', 'One point per line: Title | Description | Icon label')
        ];
    });

    register('oem', 'OEM / ODM Block', 'admin-customizer', function (props) {
        return [
            textField(props, 'Section Title', 'oem_title'),
            textareaField(props, 'Section Text', 'oem_text'),
            textField(props, 'Image URL', 'oem_image'),
            textareaField(props, 'Options', 'oem_options', 'One option per line'),
            textField(props, 'Button Text', 'oem_button_text'),
            textField(props, 'Button Link', 'oem_button_link')
        ];
    });

    register('factory', 'Factory Preview Block', 'building', function (props) {
        return [
            textField(props, 'Section Title', 'factory_title'),
            textareaField(props, 'Section Text', 'factory_text'),
            textField(props, 'Image URL', 'factory_image'),
            textareaField(props, 'Production Steps', 'factory_steps', 'One step per line: Title | Description')
        ];
    });

    register('quality', 'Quality Control Block', 'shield', function (props) {
        return [
            textField(props, 'Section Title', 'quality_title'),
            textareaField(props, 'Section Text', 'quality_text'),
            textField(props, 'Image URL', 'quality_image'),
            textareaField(props, 'Quality Steps', 'quality_steps', 'One step per line')
        ];
    });

    register('inquiry-cta', 'Inquiry CTA Block', 'email-alt', function (props) {
        return [
            textField(props, 'CTA Title', 'inquiry_title'),
            textareaField(props, 'CTA Text', 'inquiry_text'),
            textareaField(props, 'Form Shortcode', 'inquiry_form_shortcode')
        ];
    });

    register('blog-preview', 'Blog Preview Block', 'welcome-write-blog', function (props) {
        return [
            textField(props, 'Section Title', 'blog_preview_title'),
            textareaField(props, 'Section Text', 'blog_preview_text')
        ];
    });

    register('contact-info', 'Contact Info Block', 'phone', function (props) {
        return [
            textField(props, 'Email', 'contact_email'),
            textField(props, 'Phone', 'contact_phone'),
            textField(props, 'WhatsApp Link', 'contact_whatsapp'),
            textField(props, 'Address', 'contact_address')
        ];
    });
})(window.wp);
