<?php
/**
 * Template Name: WoolyHome Static Home
 *
 * A hand-authored, non-ACF one-page layout. Assign it to any Page via
 * Page Attributes > Template (Pages > Home > Edit) to use it as-is.
 *
 * @package WoolyHome_B2B
 */

get_header();
?>

<div class="whs-page">

  <section class="whs-hero">
    <div class="whs-container whs-hero-grid">
      <div>
        <p class="whs-eyebrow">Natural Wool &amp; Sheepskin — B2B Manufacturer</p>
        <h1>Wool and sheepskin, made to <em>your</em> specification.</h1>
        <p class="whs-lede">WoolyHome supplies soft, natural wool and sheepskin products for brands, wholesalers, retailers, hotels, and private label projects worldwide — from raw material selection through to packed, labeled cartons.</p>
        <div class="whs-trust-line">
          <span>OEM / ODM Available</span>
          <span>Bulk Supply</span>
          <span>Private Label Support</span>
        </div>
        <div class="whs-actions">
          <a class="whs-btn whs-btn-primary" href="#whs-inquiry">Request a Quote</a>
          <a class="whs-btn whs-btn-ghost" href="#whs-products">View Product Range</a>
        </div>
      </div>
      <div class="whs-hero-visual">
        <div class="whs-swatch whs-hero-swatch" style="--tint: var(--whs-swatch-rug);"></div>
        <div class="whs-note-card">
          <strong>Natural comfort, ready for private label.</strong>
          <span>Custom size, material, label, and packaging support on every order.</span>
        </div>
      </div>
    </div>
  </section>

  <section class="whs-section" id="whs-products">
    <div class="whs-container">
      <div class="whs-section-head">
        <div>
          <p class="whs-eyebrow">Product Range</p>
          <h2>Five ways to bring wool into a home.</h2>
        </div>
        <p class="whs-lede">From home textiles to wearable wool accessories, WoolyHome develops natural product collections for bulk buyers and private label partners.</p>
      </div>
      <div class="whs-product-grid">
        <article class="whs-p-card">
          <div class="whs-swatch" style="--tint: var(--whs-swatch-rug);"></div>
          <div class="whs-p-body">
            <h3>Sheepskin Rugs</h3>
            <p>Natural single and double-pelt rugs for home and hospitality decor.</p>
            <a class="whs-p-link" href="<?php echo esc_url(home_url('/product-category/sheepskin-rugs/')); ?>">View Collection</a>
          </div>
        </article>
        <article class="whs-p-card">
          <div class="whs-swatch" style="--tint: var(--whs-swatch-comforter);"></div>
          <div class="whs-p-body">
            <h3>Wool Comforters</h3>
            <p>All-season fill weights for bedding brands and hotel programs.</p>
            <a class="whs-p-link" href="<?php echo esc_url(home_url('/product-category/wool-comforters/')); ?>">View Collection</a>
          </div>
        </article>
        <article class="whs-p-card">
          <div class="whs-swatch" style="--tint: var(--whs-swatch-dryerball);"></div>
          <div class="whs-p-body">
            <h3>Wool Dryer Balls</h3>
            <p>Reusable, undyed laundry sets suited to eco-friendly gift lines.</p>
            <a class="whs-p-link" href="<?php echo esc_url(home_url('/product-category/wool-dryer-balls/')); ?>">View Collection</a>
          </div>
        </article>
        <article class="whs-p-card">
          <div class="whs-swatch" style="--tint: var(--whs-swatch-gloves);"></div>
          <div class="whs-p-body">
            <h3>Wool Gloves</h3>
            <p>Insulated wool-blend gloves for winter accessory ranges.</p>
            <a class="whs-p-link" href="<?php echo esc_url(home_url('/product-category/wool-gloves/')); ?>">View Collection</a>
          </div>
        </article>
        <article class="whs-p-card">
          <div class="whs-swatch" style="--tint: var(--whs-swatch-socks);"></div>
          <div class="whs-p-body">
            <h3>Wool Socks</h3>
            <p>Warm, breathable sock lines in custom weights and colorways.</p>
            <a class="whs-p-link" href="<?php echo esc_url(home_url('/product-category/wool-socks/')); ?>">View Collection</a>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="whs-section whs-section-sage">
    <div class="whs-container">
      <div class="whs-section-head whs-stack" style="max-width: 620px;">
        <p class="whs-eyebrow">Why WoolyHome</p>
        <h2>Built for buyers who need to trust their supplier.</h2>
        <p class="whs-lede">We combine natural wool materials, flexible customization, and export-focused production support to help B2B buyers build reliable wool product collections.</p>
      </div>
      <div class="whs-why-grid">
        <div class="whs-why-card">
          <span class="whs-why-tag">Material</span>
          <h3>Natural Wool Materials</h3>
          <p>Selected wool and sheepskin materials for soft, breathable, comfortable product lines.</p>
        </div>
        <div class="whs-why-card">
          <span class="whs-why-tag">Service</span>
          <h3>OEM / ODM Support</h3>
          <p>Custom size, color, label, packaging, and product development for private label buyers.</p>
        </div>
        <div class="whs-why-card">
          <span class="whs-why-tag">Capacity</span>
          <h3>Bulk Production</h3>
          <p>Stable production planning for wholesale, retail, hotel, and seasonal purchasing needs.</p>
        </div>
        <div class="whs-why-card">
          <span class="whs-why-tag">Assurance</span>
          <h3>Quality Inspection</h3>
          <p>Material, stitching, size, cleanliness, and packing checks before every shipment.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="whs-section" id="whs-oem">
    <div class="whs-container whs-split">
      <div class="whs-swatch" style="--tint: var(--whs-swatch-gloves);"></div>
      <div>
        <p class="whs-eyebrow">OEM / ODM</p>
        <h2 style="font-size: clamp(1.7rem, 3vw, 2.3rem);">Your brand, our production line.</h2>
        <p class="whs-lede" style="margin-top:16px;">Support your brand with flexible customization for wool and sheepskin products, from material selection to branded packaging.</p>
        <div class="whs-tag-row">
          <span>Custom Size &amp; Shape</span>
          <span>Material &amp; Wool Filling Options</span>
          <span>Private Label &amp; Woven Labels</span>
          <span>Custom Packaging</span>
          <span>Sample Development</span>
          <span>Bulk Order Support</span>
        </div>
        <a class="whs-btn whs-btn-primary" href="<?php echo esc_url(home_url('/oem-odm/')); ?>">Start an OEM / ODM Project</a>
      </div>
    </div>
  </section>

  <section class="whs-section whs-section-cream" id="whs-factory">
    <div class="whs-container">
      <div class="whs-section-head whs-stack" style="max-width: 640px;">
        <p class="whs-eyebrow">Factory &amp; Production</p>
        <h2>Four stages, one quality standard.</h2>
        <p class="whs-lede">Our production process is designed for consistent quality, practical customization, and reliable bulk order fulfillment.</p>
      </div>
      <div class="whs-process-row">
        <div class="whs-process-cell">
          <span class="whs-process-num">01</span>
          <h3>Material Preparation</h3>
          <p>Sourcing and grading raw wool and sheepskin against order specifications.</p>
        </div>
        <div class="whs-process-cell">
          <span class="whs-process-num">02</span>
          <h3>Cutting &amp; Sewing</h3>
          <p>Precision cutting and stitching against buyer size and shape requirements.</p>
        </div>
        <div class="whs-process-cell">
          <span class="whs-process-num">03</span>
          <h3>Filling &amp; Finishing</h3>
          <p>Wool filling, trimming, and finishing to the agreed product spec.</p>
        </div>
        <div class="whs-process-cell">
          <span class="whs-process-num">04</span>
          <h3>Packing for Shipment</h3>
          <p>Labeling and carton packing prepared for export logistics.</p>
        </div>
      </div>
    </div>
  </section>

  <section class="whs-section whs-section-sage" id="whs-quality">
    <div class="whs-container whs-quality-grid">
      <div>
        <p class="whs-eyebrow">Quality Control</p>
        <h2 style="font-size: clamp(1.7rem, 3vw, 2.3rem);">Checked before it ever leaves the factory.</h2>
        <p class="whs-lede" style="margin-top:16px;">From incoming materials to final packing, each order is checked to support stable quality for international buyers.</p>
      </div>
      <ol class="whs-step-list">
        <li><span>01</span> Material Check</li>
        <li><span>02</span> Size &amp; Specification Check</li>
        <li><span>03</span> Stitching &amp; Finish Check</li>
        <li><span>04</span> Cleanliness Review</li>
        <li><span>05</span> Final Packing Inspection</li>
      </ol>
    </div>
  </section>

  <section class="whs-section" id="whs-buyers">
    <div class="whs-container">
      <div class="whs-section-head whs-stack" style="max-width: 640px;">
        <p class="whs-eyebrow">Applications</p>
        <h2>Built for different buying programs.</h2>
        <p class="whs-lede">Whether you're developing a private label line or sourcing bulk wool products for retail and hospitality, WoolyHome can support flexible product programs.</p>
      </div>
      <div class="whs-buyer-grid">
        <div class="whs-buyer-card"><span class="whs-buyer-code">HT</span><h3>Home Textile Brands</h3><p>Flexible wool product support for your buying program and target market.</p></div>
        <div class="whs-buyer-card"><span class="whs-buyer-code">WI</span><h3>Wholesalers &amp; Importers</h3><p>Consistent bulk supply for distribution across multiple regions.</p></div>
        <div class="whs-buyer-card"><span class="whs-buyer-code">HR</span><h3>Home Retailers</h3><p>Seasonal and year-round wool collections ready for retail floors.</p></div>
        <div class="whs-buyer-card"><span class="whs-buyer-code">HB</span><h3>Hotels &amp; Hospitality</h3><p>Durable, comfortable wool textiles suited to hospitality volumes.</p></div>
        <div class="whs-buyer-card"><span class="whs-buyer-code">GC</span><h3>Gift Companies</h3><p>Natural, giftable wool items for seasonal and eco-conscious lines.</p></div>
        <div class="whs-buyer-card"><span class="whs-buyer-code">PL</span><h3>Private Label Customers</h3><p>End-to-end OEM / ODM support from concept to packed carton.</p></div>
      </div>
    </div>
  </section>

  <section class="whs-section whs-section-dark" id="whs-inquiry">
    <div class="whs-container whs-inquiry-grid">
      <div>
        <p class="whs-eyebrow">Get in Touch</p>
        <h2>Looking for wool products for your brand?</h2>
        <p class="whs-lede">Tell us what you're sourcing — material, quantity, and timeline. We'll follow up with product options, customization details, and bulk order lead times.</p>
      </div>
      <div class="whs-contact-card">
        <dl>
          <div><dt>Email</dt><dd><?php echo esc_html(woolyhome_b2b_contact('contact_email')); ?></dd></div>
          <div><dt>Phone / WhatsApp</dt><dd><?php echo esc_html(woolyhome_b2b_contact('contact_phone')); ?></dd></div>
          <div><dt>Location</dt><dd><?php echo esc_html(woolyhome_b2b_contact('contact_address')); ?></dd></div>
        </dl>
        <a class="whs-btn whs-btn-primary" href="mailto:<?php echo esc_attr(woolyhome_b2b_contact('contact_email')); ?>?subject=Wool%20Product%20Inquiry">Email Us</a>
      </div>
    </div>
  </section>

</div>

<?php
get_footer();
