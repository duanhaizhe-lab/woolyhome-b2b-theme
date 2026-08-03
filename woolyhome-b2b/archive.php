<?php
/**
 * Generic archive template.
 *
 * @package WoolyHome_B2B
 */

get_header();
get_template_part('template-parts/components/page-hero', null, array(
    'label' => 'Archive',
    'title' => get_the_archive_title(),
    'subtitle' => get_the_archive_description() ?: 'Browse WoolyHome content and sourcing information.',
));
?>
<section class="wh-section">
    <div class="wh-container">
        <div class="wh-posts-grid">
            <?php
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('template-parts/cards/post-card', null, array('post' => get_post()));
                }
            } else {
                echo '<p>No content found.</p>';
            }
            ?>
        </div>
        <?php the_posts_pagination(); ?>
    </div>
</section>
<?php
get_template_part('template-parts/components/inquiry-cta');
get_footer();
