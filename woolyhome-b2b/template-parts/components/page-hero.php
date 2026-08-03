<?php
/**
 * Page hero.
 *
 * @package WoolyHome_B2B
 */

$title    = $args['title'] ?? woolyhome_b2b_field('banner_title', get_the_ID(), get_the_title());
$subtitle = $args['subtitle'] ?? woolyhome_b2b_field('banner_subtitle', get_the_ID(), '');
$image    = $args['image'] ?? woolyhome_b2b_field('banner_image', get_the_ID(), null);
$label    = $args['label'] ?? 'WoolyHome';
?>
<section class="wh-page-hero">
    <div class="wh-container wh-page-hero-grid">
        <div>
            <?php woolyhome_b2b_breadcrumbs(); ?>
            <p class="wh-eyebrow"><?php echo esc_html($label); ?></p>
            <h1><?php echo esc_html($title); ?></h1>
            <?php if ($subtitle) : ?>
                <p><?php echo esc_html($subtitle); ?></p>
            <?php endif; ?>
            <div class="wh-actions">
                <a class="wh-btn wh-btn-primary" href="#inquiry">Request a Quote</a>
                <a class="wh-btn wh-btn-secondary" href="<?php echo esc_url(home_url('/products/')); ?>">View Products</a>
            </div>
        </div>
        <?php echo woolyhome_b2b_image($image, $label . ' banner image', 'wh-page-hero-image'); ?>
    </div>
</section>
