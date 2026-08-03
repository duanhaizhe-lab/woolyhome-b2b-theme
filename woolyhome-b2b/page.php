<?php
/**
 * Default page template.
 *
 * @package WoolyHome_B2B
 */

get_header();
while (have_posts()) :
    the_post();
    get_template_part('template-parts/components/page-hero', null, array('label' => 'WoolyHome'));
    ?>
    <section class="wh-section">
        <div class="wh-container wh-content-sidebar">
            <article class="wh-rich-content"><?php the_content(); ?></article>
            <aside class="wh-sidebar"><div class="wh-sidebar-box"><h3>Need Help?</h3><p>Send your wool product requirements and our team will review suitable options.</p><a class="wh-btn wh-btn-primary" href="#inquiry">Request a Quote</a></div></aside>
        </div>
    </section>
    <?php
    get_template_part('template-parts/components/inquiry-cta');
endwhile;
get_footer();
