# WoolyHome B2B WordPress Theme V0

Theme folder: `woolyhome-b2b`

This is a custom WordPress theme for a wool / sheepskin B2B manufacturer website. It is not a WooCommerce theme and does not include cart, payment, price, discounts, ratings, or Add to Cart features.

Deployment target: upload the contents of this folder into `wp-content/themes/woolyhome-b2b/`.

## Included Templates

- `front-page.php`: Home page with hero, product categories, value points, OEM / ODM, factory, quality control, buyer types, featured products, inquiry CTA, and blog preview.
- `archive-products.php`: Products archive.
- `page-products.php`: Products page template.
- `taxonomy-product-category.php`: Product category archive.
- `single-products.php`: Product detail page.
- `page-oem-odm.php`: OEM / ODM page template.
- `page-factory.php`: Factory page template.
- `page-quality-control.php`: Quality Control page template.
- `page-contact.php`: Contact page template.
- `home.php`: Blog index.
- `single.php`: Blog post.
- `archive.php`, `page.php`, `index.php`: fallback templates.

## Required / Recommended Plugins

- Advanced Custom Fields. ACF Pro is recommended if you want repeater, gallery, and relationship fields exactly as registered.
- Contact Form 7 or another form plugin if you want to replace the built-in placeholder inquiry form with a shortcode.
- Yoast SEO or Rank Math is optional. The theme avoids outputting its own basic schema when these plugins are active.

## ACF Field Registration

Local ACF field groups are registered in:

- `includes/acf-fields.php`

The file is loaded from `functions.php` with:

- `require_once WOOLYHOME_B2B_DIR . '/includes/acf-fields.php';`

The registration function is attached to both `acf/init` and `acf/include_fields`, with an internal one-time guard to avoid duplicate registration.

The Home field group uses these location rules:

- `page_type == front_page`
- The current `page_on_front` page ID, when WordPress has a static front page set
- The page with slug `home`, when it exists

After deploying, reopen `Pages > Home > Edit` to see the Home field group below the editor.

## Content Management

Use WordPress admin:

- Pages: Home, Products, OEM / ODM, Factory, Quality Control, Contact.
- Posts: Blog articles.
- Products custom post type: Product entries.
- Product Categories taxonomy: Sheepskin Rugs, Wool Comforters, Wool Dryer Balls, Wool Gloves, Wool Socks.
- Customizer > WoolyHome Contact & Forms: contact info, Chinese link, inquiry form shortcode, newsletter shortcode.
- ACF fields: page banners, home modules, product details, FAQ, CTA, and form shortcode.

## Automatic Page Setup

The theme safely creates the basic website pages once:

- Home
- Products
- OEM / ODM
- Factory
- Quality Control
- Blog
- Contact

It sets Home as the front page, Blog as the posts page, creates product categories, and creates a primary menu. Existing pages are reused and not overwritten.

## Demo Fallback Content

The theme displays demo fallback cards when there are no Products or Posts yet:

- Natural Sheepskin Rug
- All-Season Wool Comforter
- Reusable Wool Dryer Balls
- Winter Wool Gloves
- Warm Wool Socks

Demo blog fallback:

- How to Source Wool Comforters for Private Label Bedding Brands
- Sheepskin Rugs for Home Retail: What B2B Buyers Should Know
- Wool Dryer Balls: A Natural Laundry Product for Eco-Friendly Gift Sets

The theme does not automatically create posts or pages on activation, so it will not modify existing website content.

## Replace Images

V0 includes local SVG default visuals in `assets/images/`. The front end will not show text placeholders. Replace images in:

- Home hero image: edit the Home page ACF field `hero_image`.
- Home hero title/subtitle/buttons: edit `hero_title`, `hero_subtitle`, `hero_primary_button_text`, `hero_primary_button_link`, `hero_secondary_button_text`, `hero_secondary_button_link`.
- Product category images: V0 uses local default SVGs. For fully editable taxonomy images, add ACF fields to Product Categories in a future version.
- OEM page image: edit the OEM / ODM page ACF fields `banner_image` and `section_images`.
- Factory page image: edit the Factory page ACF fields `banner_image` and `section_images`.
- Quality Control page image: edit the Quality Control page ACF fields `banner_image` and `section_images`.
- Contact page image: edit the Contact page ACF field `banner_image`.
- Products: edit each Products CPT item fields `product_main_image` and `product_gallery`.
- Blog: edit each post Featured Image.

If ACF is not installed, replace the default SVG files directly:

- `assets/images/hero-wool-home.svg`
- `assets/images/sheepskin-rugs.svg`
- `assets/images/wool-comforters.svg`
- `assets/images/wool-dryer-balls.svg`
- `assets/images/wool-gloves.svg`
- `assets/images/wool-socks.svg`
- `assets/images/oem-packaging.svg`
- `assets/images/factory-preview.svg`
- `assets/images/quality-control.svg`
- `assets/images/contact-bg.svg`

## Form Replacement

The built-in form is only a visual placeholder. Add a Contact Form 7 or Web3Forms shortcode in:

- Customizer > WoolyHome Contact & Forms > Inquiry Form Shortcode
- Or page-level ACF field `form_shortcode`

Contact page form replacement:

- Edit Contact page ACF field `form_shortcode`, or
- Use Customizer > WoolyHome Contact & Forms > Inquiry Form Shortcode for the global fallback.

## Notes for Future Development

Future code changes may be needed for:

- More advanced ACF layouts or flexible content.
- Real import/demo content tools.
- Deeper multilingual support for `/cn/`.
- Production-grade form handling if not using a plugin.
- Advanced SEO controls beyond the safe schema placeholders included here.
