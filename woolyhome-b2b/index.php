<?php
/**
 * Fallback template.
 *
 * @package WoolyHome_B2B
 */

get_header();
get_template_part('template-parts/components/page-hero', null, array(
    'label' => 'WoolyHome',
    'title' => 'Natural Wool & Sheepskin Products',
    'subtitle' => 'B2B manufacturer website for product display, OEM / ODM support, factory capability, quality control, and inquiry conversion.',
));
?>
<section class="wh-section">
    <div class="wh-container">
        <?php if (have_posts()) : ?>
            <div class="wh-posts-grid">
                <?php while (have_posts()) : the_post(); get_template_part('template-parts/cards/post-card', null, array('post' => get_post())); endwhile; ?>
            </div>
        <?php else : ?>
            <div class="wh-section-heading center"><h2>Welcome to WoolyHome</h2><p>Use the theme templates to build the home page, product pages, OEM / ODM, factory, quality control, blog, and contact pages.</p></div>
        <?php endif; ?>
    </div>
</section>
<?php
get_template_part('template-parts/components/inquiry-cta');
get_footer();
