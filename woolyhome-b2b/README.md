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

## Content Management

Use WordPress admin:

- Pages: Home, Products, OEM / ODM, Factory, Quality Control, Contact.
- Posts: Blog articles.
- Products custom post type: Product entries.
- Product Categories taxonomy: Sheepskin Rugs, Wool Comforters, Wool Dryer Balls, Wool Gloves, Wool Socks.
- Customizer > WoolyHome Contact & Forms: contact info, Chinese link, inquiry form shortcode, newsletter shortcode.
- ACF fields: page banners, home modules, product details, FAQ, CTA, and form shortcode.

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

V0 uses CSS placeholder panels when images are not selected. Replace images in:

- Home page ACF: `hero_image`
- Page ACF: `banner_image`, `section_images`
- Product ACF: `product_main_image`, `product_gallery`
- Blog Featured Image

## Form Replacement

The built-in form is only a visual placeholder. Add a Contact Form 7 or Web3Forms shortcode in:

- Customizer > WoolyHome Contact & Forms > Inquiry Form Shortcode
- Or page-level ACF field `form_shortcode`

## Notes for Future Development

Future code changes may be needed for:

- More advanced ACF layouts or flexible content.
- Real import/demo content tools.
- Deeper multilingual support for `/cn/`.
- Production-grade form handling if not using a plugin.
- Advanced SEO controls beyond the safe schema placeholders included here.
