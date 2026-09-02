<?php
/**
 * Site header.
 *
 * @package WoolyHome_B2B
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="wh-site-header" data-header>
    <div class="wh-container wh-header-inner">
        <div class="wh-logo-area">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a class="wh-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('WoolyHome home', 'woolyhome-b2b'); ?>"><?php echo woolyhome_b2b_logo(); ?></a>
            <?php endif; ?>
        </div>
        <button class="wh-menu-toggle" type="button" aria-label="<?php esc_attr_e('Open menu', 'woolyhome-b2b'); ?>" aria-expanded="false" data-menu-toggle><span></span><span></span><span></span></button>
        <nav class="wh-primary-nav" aria-label="<?php esc_attr_e('Primary navigation', 'woolyhome-b2b'); ?>" data-primary-nav>
            <?php
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '<ul class="wh-menu">%3$s</ul>',
                    'depth'          => 1,
                ));
            } else {
                ?>
                <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
                <div class="wh-nav-dropdown">
                    <a href="<?php echo esc_url(get_post_type_archive_link('products') ?: home_url('/products/')); ?>">Products</a>
                    <div class="wh-nav-panel">
                        <?php foreach (woolyhome_b2b_demo_categories() as $cat) : ?>
                            <a href="<?php echo esc_url(home_url('/product-category/' . $cat['slug'] . '/')); ?>"><?php echo esc_html($cat['name']); ?></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/oem-odm/')); ?>">OEM / ODM</a>
                <a href="<?php echo esc_url(home_url('/factory/')); ?>">Factory</a>
                <a href="<?php echo esc_url(home_url('/quality-control/')); ?>">Quality Control</a>
                <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts')) ?: home_url('/blog/')); ?>">Blog</a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact</a>
                <?php
            }
            ?>
        </nav>
        <div class="wh-header-actions">
            <div class="wh-language"><a href="<?php echo esc_url(home_url('/')); ?>">EN</a><span>/</span><a href="<?php echo esc_url(woolyhome_b2b_contact('cn_language_link')); ?>">中文</a></div>
            <a class="wh-btn wh-btn-primary" href="<?php echo esc_url(home_url('/contact/#inquiry')); ?>">Request a Quote</a>
        </div>
    </div>
</header>
<main id="content" class="wh-site-main">
