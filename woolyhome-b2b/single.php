<?php
/**
 * Single blog post.
 *
 * @package WoolyHome_B2B
 */

get_header();
while (have_posts()) :
    the_post();
    get_template_part('template-parts/components/page-hero', null, array(
        'label' => 'Sourcing Guide',
        'title' => get_the_title(),
        'subtitle' => get_the_excerpt() ?: 'WoolyHome sourcing insight for B2B wool and sheepskin product buyers.',
        'image' => get_post_thumbnail_id(),
    ));
    ?>
    <section class="wh-section">
        <div class="wh-container wh-content-sidebar">
            <article class="wh-rich-content">
                <?php the_content(); ?>
            </article>
            <aside class="wh-sidebar">
                <div class="wh-sidebar-box"><h3>Product Categories</h3><?php foreach (woolyhome_b2b_demo_categories() as $cat) : ?><a href="<?php echo esc_url(home_url('/product-category/' . $cat['slug'] . '/')); ?>"><?php echo esc_html($cat['name']); ?></a><?php endforeach; ?></div>
                <div class="wh-sidebar-box"><h3>Contact Sales</h3><p>Discuss product details, quantity, and OEM / ODM requirements.</p><a class="wh-btn wh-btn-primary" href="#inquiry">Request a Quote</a></div>
            </aside>
        </div>
    </section>
    <?php get_template_part('template-parts/components/faq', null, array('faq' => woolyhome_b2b_field('faq', get_the_ID(), array()))); ?>
    <section class="wh-section wh-section-cream">
        <div class="wh-container">
            <div class="wh-section-heading row"><div><p class="wh-eyebrow">Related Products</p><h2>Product Directions You May Need</h2></div><a class="wh-btn wh-btn-secondary" href="<?php echo esc_url(get_post_type_archive_link('products') ?: home_url('/products/')); ?>">View Products</a></div>
            <div class="wh-products-grid">
                <?php foreach (array_slice(woolyhome_b2b_demo_products(), 0, 3) as $product) { get_template_part('template-parts/cards/product-card', null, array('product' => $product)); } ?>
            </div>
        </div>
    </section>
    <section class="wh-section">
        <div class="wh-container">
            <div class="wh-section-heading center"><p class="wh-eyebrow">Related Posts</p><h2>More Sourcing Guides</h2></div>
            <div class="wh-posts-grid">
                <?php
                $related = get_posts(array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => array(get_the_ID())));
                foreach ($related as $post_item) {
                    get_template_part('template-parts/cards/post-card', null, array('post' => $post_item));
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    get_template_part('template-parts/components/inquiry-cta', null, array('title' => 'Need Wool Products for Your Brand?'));
endwhile;
get_footer();
