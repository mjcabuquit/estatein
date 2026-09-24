# Estatein WordPress Theme: Development Notes

**Author:** Mark Joseph Cabuquit
**Live site:** https://mjcabuquit-wp.infinityfreeapp.com
**Repository:** https://github.com/mjcabuquit/estatein
**Design source:** "Real Estate Business Website UI Template (Dark Theme)" Figma file (desktop, laptop and mobile frames)

## Scope

This was a time-boxed trial (4 hours), so I prioritized faithful, responsive pages and the reusable parts every page depends on (header, footer, global styles, content model) over covering every page shallowly.

**Built:**
- **Home:** announcement bar, header, hero with stats and badge, feature tiles, Featured Properties, testimonials, FAQ, call-to-action, footer.
- **About Us:** journey, values, achievements, six-step process, team, and valued clients.
- **Properties:** search and filters, property cards, and a working inquiry form.

**Not built:** Services and Contact Us pages, and the footer newsletter box (markup only).

## Approach

1. **Custom theme from scratch** (HTML, CSS, PHP, a little vanilla JavaScript), with no page builder and no starter theme.
2. **Reusable structure:** `header.php`, `footer.php` and `template-parts/cta.php` are shared. `functions.php` holds setup, asset loading, post types and helpers (`estatein_icon()`, `estatein_photo()`, `estatein_section_head()`, `estatein_pager()`, `estatein_field()`), so markup isn't repeated.
3. **Page templates:** `front-page.php`, `page-about.php` (slug `about`) and `page-properties.php` (slug `properties`).
4. **Design tokens as CSS variables** in `assets/css/main.css`, so a design change is a one-line edit.
5. **Responsive behavior:** below 900px the navigation becomes a toggle menu, layouts stack, and card sections become swipeable sliders using CSS scroll-snap. Arrows and the "01 of N" counter work with them (`assets/js/main.js`).

## Content management

- **Properties** are a custom post type. The client adds a title, excerpt and featured image, plus ACF fields: `bedrooms`, `bathrooms`, `property_type`, `price`, `location`, `size`, `build_year` and an optional `tagline`. `estatein_field()` falls back to plain post meta if ACF is inactive.
- **Ordering:** each property has an Order number (Page Attributes); the home page sorts by it, then by newest.
- **Filters:** the Properties page filters by keyword and by location, type, price range, size and build year. Option lists live in one function, `estatein_filters()`.
- **Inquiries:** the form posts to `admin-post.php`, is saved as a private **Inquiry** in the dashboard, and is also emailed to the site admin.
- **Menus:** managed under Appearance → Menus (with a built-in fallback).
- **Testimonials, FAQs, team and client cards** are written in the templates. This was a deliberate scope decision. The first thing I'd add next is post types for them.

## Form security

Nonce check, server-side sanitization and validation (name, valid email, terms accepted), a hidden honeypot field for bots, and escaped output everywhere.

## Accessibility, SEO and performance

- **Accessibility:** semantic landmarks, one `h1` per page, a skip link, visible keyboard focus, labelled form fields and icon buttons, `role="status"`/`"alert"` on form messages, and reduced-motion support.
- **SEO:** `title-tag` support, descriptive alt text on meaningful images, empty alt on decorative icons, and semantic HTML.
- **Performance:** SVG icons, lazy-loaded images, one web font (Urbanist, two weights), and photos resized and converted to WebP (each about 10 to 50 KB). The house and team photos have real transparency, so no white edges show on the dark cards. Stylesheet and script versions follow file modification time, so updates aren't served stale from cache.
- **Not yet done:** CSS/JS minification and responsive `srcset` tuning. On a production build I'd add a caching/optimization plugin or a build step.

## Known limitations

- Services and Contact Us pages are not built.
- Free hosting often blocks outgoing mail, so the admin email may not arrive. Inquiries are still saved in the dashboard.
- On desktop the slider arrows do not move anything, because all cards fit on screen. They work on mobile.
- The hero background image is set through Appearance → Customize → Additional CSS on the live site, so it lives in the database, not the theme files. [Update if you move it into the theme.]
- Fidelity was checked against screenshots of the Figma frames, not Figma's inspect values, so small spacing differences are possible.
- Cross-browser testing was done in Chrome, Firefox and Safari Mobile. Edge and desktop Safari were not tested.

## Tools

- **WordPress** with **Advanced Custom Fields** (free); hosted on InfinityFree; Git/GitHub for version control.
- **AI assistance:** I used Claude to generate the first pass of the theme code from the Figma screenshots and exported assets. I reviewed each file, installed and tested it on the live site, and directed the fixes (caching, icon sizing, image edges, layout details) based on what I saw in the browser.
