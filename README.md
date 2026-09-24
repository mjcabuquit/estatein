# Estatein WordPress Theme: Development Notes

**Author:** Mark Joseph Cabuquit
**Live site:** https://mjcabuquit-wp.infinityfreeapp.com
**Repository:** [add GitHub URL]
**Design source:** "Real Estate Business Website UI Template (Dark Theme)" Figma file, home page (desktop, laptop and mobile frames)

## Scope

This was a time-boxed trial (4 hours), so I prioritized a faithful, responsive **home page** and the reusable parts every other page depends on (header, footer, global styles, content model) over covering every page shallowly.

**Built:** announcement bar, header and navigation, hero with stats and badge, feature tiles, Featured Properties, client testimonials, FAQ, call-to-action band, and footer. All are responsive across mobile, tablet and desktop.

**Not built yet:** the other pages in the Figma file, and a working contact/subscribe form. The footer email box is markup only.

## Approach

1. **Custom theme from scratch** (HTML, CSS, PHP, a little vanilla JavaScript). No page builder and no starter theme, so the code stays small and readable.
2. **Reusable structure:** `header.php` and `footer.php` are shared by every template. `functions.php` handles setup, asset loading, the Property post type, and small helper functions (`estatein_icon()`, `estatein_logo()`, `estatein_field()`) so markup isn't repeated.
3. **Design tokens as CSS variables** (colors, radius, spacing) in `assets/css/main.css`, so a design change is a one-line edit.
4. **Mobile behavior:** below 900px the navigation becomes a toggle menu, the hero stacks with the image on top, and each card section becomes a swipeable slider driven by CSS scroll-snap. The arrow buttons and "01 of N" counter work with it (`assets/js/main.js`).

## Content management

- **Properties** are a custom post type. The client adds a title, excerpt and featured image, then fills four fields: bedrooms, bathrooms, property type and price.
- **Fields** use the free **Advanced Custom Fields (ACF)** plugin. `estatein_field()` falls back to plain post meta if ACF isn't active.
- **Ordering:** each property has an **Order** number (Page Attributes panel). The home page sorts by it, then by newest.
- **Menus:** the header menu uses WordPress's menu system (Appearance → Menus), with a hardcoded fallback.
- **Testimonials and FAQs** are written directly in `front-page.php`. This was a deliberate scope decision. Making them editable would mean two more post types, and is the first thing I would add next.

## Accessibility, SEO and performance

- **Accessibility:** semantic landmarks (`header`, `nav`, `main`, `footer`), one `h1`, a skip link, visible keyboard focus, labelled icon buttons, `aria-label` on the star ratings, and reduced-motion support.
- **SEO:** WordPress's `title-tag` support for page titles, descriptive alt text on meaningful images, and semantic HTML. Decorative icons use empty alt text.
- **Performance:** icons are small SVGs, photos are lazy-loaded, the hero badge is resized to 2x its display size, and only one web font (Urbanist, two weights) is loaded. Stylesheet and script versions are tied to file modification time, so updates are never served stale from cache.
- **Not yet done:** CSS and JS minification, and responsive `srcset` tuning for property photos. On a production build I would add a caching/optimization plugin or a build step.

## Known limitations

- Only the home page is implemented.
- The hero background image is set through **Appearance → Customize → Additional CSS** on the live site, so it lives in the database rather than the theme files. [Update this line if you move it into the theme.]
- Pixel-level fidelity was checked against screenshots of the Figma frames, not against Figma's inspect values, so small spacing differences are possible.
- Cross-browser testing: [state which browsers and devices you actually tested].

## Tools

- **WordPress** with **Advanced Custom Fields** (free); hosted on InfinityFree.
- **Git/GitHub** for version control.
- **AI assistance:** I used Claude to generate the first pass of the theme code from the Figma screenshots and exported assets. I reviewed each file, installed and tested it on the live site, and directed the fixes (for example, caching, tag icon sizing, and tile alignment) based on what I saw in the browser.
