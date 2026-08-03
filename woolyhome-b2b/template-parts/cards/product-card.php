<?php
/**
 * Product card.
 *
 * @package WoolyHome_B2B
 */

$product = $args['product'] ?? null;

if ($product instanceof WP_Post) {
    $product_id = $product->ID;
    $title      = get_the_title($product_id);
    $desc       = woolyhome_b2b_field('product_short_description', $product_id, get_the_excerpt($product_id));
    $terms      = get_the_terms($product_id, 'product-category');
    $category   = $terms && !is_wp_error($terms) ? $terms[0]->name : 'Wool Product';
    $link       = get_permalink($product_id);
    $image      = woolyhome_b2b_field('product_main_image', $product_id, get_post_thumbnail_id($product_id));
} else {
    $title    = $product['title'] ?? 'Natural Wool Product';
    $desc     = $product['desc'] ?? 'B2B wool product direction for private label and wholesale sourcing.';
    $category = $product['category'] ?? 'Wool Product';
    $link     = home_url('/contact/#inquiry');
    $image    = null;
}
?>
<article class="wh-product-card">
    <?php echo woolyhome_b2b_image($image, 'Product image', 'wh-product-image'); ?>
    <span class="wh-product-meta"><?php echo esc_html($category); ?></span>
    <h3><?php echo esc_html($title); ?></h3>
    <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags($desc), 24)); ?></p>
    <a href="<?php echo esc_url($link); ?>">Send Inquiry</a>
</article>
