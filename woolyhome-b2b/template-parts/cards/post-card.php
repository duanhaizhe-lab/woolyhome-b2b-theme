<?php
/**
 * Post card.
 *
 * @package WoolyHome_B2B
 */

$post_obj = $args['post'] ?? null;

if ($post_obj instanceof WP_Post) {
    $post_id = $post_obj->ID;
    $title   = get_the_title($post_id);
    $excerpt = get_the_excerpt($post_id);
    $link    = get_permalink($post_id);
    $cat     = get_the_category($post_id);
    $meta    = $cat ? $cat[0]->name : 'Sourcing Guide';
    $image   = get_post_thumbnail_id($post_id);
} else {
    $title   = $post_obj['title'] ?? 'Wool Product Sourcing Guide';
    $excerpt = $post_obj['excerpt'] ?? 'Practical sourcing guidance for global wool product buyers.';
    $link    = home_url('/blog/');
    $meta    = $post_obj['meta'] ?? 'Sourcing Guide';
    $image   = null;
}
?>
<article class="wh-post-card">
    <?php echo woolyhome_b2b_image($image, 'Blog featured image', 'wh-post-image', 'large', 'blog ' . $title); ?>
    <span class="wh-post-meta"><?php echo esc_html($meta); ?></span>
    <h3><?php echo esc_html($title); ?></h3>
    <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags($excerpt), 24)); ?></p>
    <a href="<?php echo esc_url($link); ?>">Read More</a>
</article>
