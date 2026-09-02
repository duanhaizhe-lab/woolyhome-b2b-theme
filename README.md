# WoolyHome B2B Website

A static B2B website for WoolyHome, a natural wool and sheepskin manufacturer. Plain HTML/CSS/JS &mdash; no build step, no backend, no CMS required.

Current product line: **Wool Dryer Balls** and **Sheepskin Gloves**.

## Pages

- `index.html` &mdash; Home
- `products.html` &mdash; Product overview
- `product-wool-dryer-balls.html` &mdash; Wool Dryer Balls detail page
- `product-sheepskin-gloves.html` &mdash; Sheepskin Gloves detail page
- `about.html` &mdash; About Us
- `contact.html` &mdash; Contact page with inquiry form

## Structure

- `assets/css/style.css` &mdash; all site styles
- `assets/js/main.js` &mdash; mobile menu toggle, footer year, and inquiry form handling
- `assets/images/` &mdash; logo mark and product illustrations (SVG placeholders, see below)

## Branding

`assets/images/logo-mark.svg` is a code-drawn WoolyHome icon (green house + sheep mark) used in the header, footer, and favicon. To use the official WoolyHome logo artwork instead, replace this file (keep the filename, or update the `<img>`/`<link rel="icon">` references across all pages). Brand green: `#5c8f52`.

## Replacing Placeholder Images

`assets/images/wool-dryer-balls.svg`, `sheepskin-gloves.svg`, and `hero.svg` are simple code-drawn illustrations standing in for real product photography. Swap them for real photos (same filenames, or update the `src` attributes) whenever they're ready.

## Contact Info

Email, WhatsApp, and address are written directly into each page's footer and the Contact page. To update them, find-and-replace across the HTML files:

- Email: `duanhaizhe@gmail.com`
- WhatsApp: `+86 135 8212 2653` (link: `https://wa.me/8613582122653`)
- Address (EN): `Science & Technology Building, Shijiazhuang, Hebei, China`
- Address (CN): `河北省石家庄市科技大厦`

## Inquiry Form

The form on `contact.html` has no backend. On submit, JavaScript builds a `mailto:` link from the form fields and opens the visitor's email client addressed to `duanhaizhe@gmail.com`. If you later want submissions to land in a database or inbox without opening the visitor's email app, swap this for a form backend (e.g. a serverless endpoint or a static-form service) in `assets/js/main.js`.

## Deployment

This is plain static HTML/CSS/JS &mdash; upload the whole folder as-is to any static host (Hostinger, Netlify, Vercel, GitHub Pages, S3, etc.). No build step is required.
