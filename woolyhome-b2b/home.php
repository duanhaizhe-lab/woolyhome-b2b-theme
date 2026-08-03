<?php
/**
 * Blog index.
 *
 * @package WoolyHome_B2B
 */

get_header();
get_template_part('template-parts/components/page-hero', null, array(
    'label' => 'Blog',
    'title' => 'Wool Product Sourcing Insights',
    'subtitle' => 'Practical guides about wool materials, private label sourcing, OEM / ODM development, care, and B2B product planning.',
));
?>
<section class="wh-section">
    <div class="wh-container wh-content-sidebar">
        <div>
            <div class="wh-section-heading"><p class="wh-eyebrow">Articles</p><h2>Latest Sourcing Guides</h2></div>
            <div class="wh-posts-grid">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        get_template_part('template-parts/cards/post-card', null, array('post' => get_post()));
                    }
                } else {
                    $demo_posts = array(
                        array('title' => 'How to Source Wool Comforters for Private Label Bedding Brands', 'excerpt' => 'Key points for selecting materials, sizes, packaging, and bulk order specifications.', 'meta' => 'Private Label Guide'),
                        array('title' => 'Sheepskin Rugs for Home Retail: What B2B Buyers Should Know', 'excerpt' => 'How to plan rug collections for lifestyle, decor, hospitality, and seasonal programs.', 'meta' => 'Retail Sourcing'),
                        array('title' => 'Wool Dryer Balls: A Natural Laundry Product for Eco-Friendly Gift Sets', 'excerpt' => 'Why reusable wool dryer balls fit eco-friendly retail and private label programs.', 'meta' => 'Eco Gift Sets'),
                    );
                    foreach ($demo_posts as $post_item) {
                        get_template_part('template-parts/cards/post-card', null, array('post' => $post_item));
                    }
                }
                ?>
            </div>
            <?php the_posts_pagination(); ?>
        </div>
        <aside class="wh-sidebar">
            <div class="wh-sidebar-box"><h3>Categories</h3><?php wp_list_categories(array('title_li' => '', 'show_count' => false)); ?></div>
            <div class="wh-sidebar-box"><h3>Request a Quote</h3><p>Need wool or sheepskin products for your brand?</p><a class="wh-btn wh-btn-primary" href="<?php echo esc_url(home_url('/contact/#inquiry')); ?>">Contact Sales</a></div>
        </aside>
    </div>
</section>
<?php
get_template_part('template-parts/components/inquiry-cta', null, array('title' => 'Need Help with Wool Product Sourcing?'));
get_footer();
