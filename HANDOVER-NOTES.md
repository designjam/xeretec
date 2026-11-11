# Xeretec WordPress handover notes

Prepared for client handover of **xeretec.co.uk**.  
Local project reviewed: November 2026.  
This file lives in the theme repository so it can be shared via GitHub.

**How to read this document**

- **Work done by Designjam** — flexible components system, Tailwind build, related CSS/JS/PHP, later fixes.
- **Inherited / not our work** — original Rouge theme, Gulp/Bootstrap build, older page templates and ACF field groups.
- Items marked **unsure** could not be attributed with confidence from local evidence alone.

---

## Work done by Designjam

### Context

The live site was inherited with no Git repository. Designjam set up local development on top of the existing theme (`rouge-wp-start-theme`), added an ACF flexible-content component system styled with Tailwind, and deployed via WP Engine staging, with Cremarc pushing approved changes to live.

Theme Git history (author Jason Salmon / designjam.co.uk) runs from December 2025 onwards. The first commit already contains most of the components system, so separation below relies on naming, build config, folder structure and later commits — not “everything after first commit”.

### Git

| Location | Present? | Notes |
|---|---|---|
| WordPress project root (`/Sites/xeretec`) | No | Full WP install is not a Git repo |
| Theme | Yes | `wp-content/themes/rouge-wp-start-theme/.git` |
| Remote | Yes | `https://github.com/designjam/xeretec.git` (`main`) |
| Authors | Jason Salmon only | Includes early theme snapshot commits, later feature/fix commits, and the client handover notes |

**Recent fix included in this handover**

- `lib/scripts.php` — maps `comparison_cards` → `carousel` JS so mobile carousel navigation loads
- `templates/components/comparison_cards.php` — mobile padding tweak (`py-4` / `lg:py-0`)

Deploy these theme files to staging/live if that environment does not yet include the comparison cards script mapping.

### Landscape sister site ([landscape.uk.com](https://landscape.uk.com/))

Landscape is a Xeretec Group brand site that reuses the **same WordPress theme** (`rouge-wp-start-theme`). There is **no separate Landscape repository**, theme fork, or brand-switcher in code.

The Landscape request came **late**, after the initial Xeretec components setup. The quickest way to deliver a differently branded look was to edit that site’s theme file `css/custom-global.css` directly on the Landscape environment (rather than building a second theme or a domain-based style system).

**How Landscape is styled differently**

Live Landscape `custom-global.css` is mostly the same as the Xeretec/theme-repo file, with **extra colour overrides** near the end of the file. Notable differences vs the GitHub / local Xeretec copy:

| Area | Landscape | Xeretec (this repo) |
|---|---|---|
| Primary / label gradients (`.button-primary`, `.label-heading`, `.bg-linear-gradient`) | Blue-purple ramp: `#1b1449` → `#2e4ea0` → `#3f479c` → `#6058a6` | Xeretec purple/red branding (no this override block) |
| Homepage hero overlay (`.gradient-purple-blue:before`) | `#1e1b38` → `#5a369a` → `#2f9ac2` | Not present |
| Heading accent (`h1–h6 span:first-child`, etc.) | `#2f9ac2` | `#e51728` (and scoped away from `.component-wrapper`) |
| Dark-background primary buttons | Extra white-button rules under `.bg-dark` | Not present |

**Implications for handover**

- Landscape branding lives on the **Landscape site’s own** `custom-global.css` (and CMS content/logo), not in `https://github.com/designjam/xeretec`.
- Updating this GitHub theme and deploying only to Xeretec will **not** automatically update Landscape colours.
- If Landscape and Xeretec ever share a single theme deploy path, take care not to overwrite Landscape’s colour overrides (or extract them into a clear Landscape-only CSS partial first).

### Build tooling (Designjam Tailwind layer)

Build tooling lives under the theme’s **`.npm/`** folder. That entire folder is **gitignored** (`.gitignore` contains only `.npm/`), so it exists locally and must be included in any file handover even though it is not on GitHub.

**Relevant files**

| File | Role |
|---|---|
| `.npm/package.json` | npm scripts + dependencies (inherited Gulp deps + Designjam Tailwind scripts) |
| `.npm/package-lock.json` | Lockfile (lockfileVersion 2) |
| `.npm/node_modules/` | Installed packages (local only) |
| `tailwind.config.js` | Tailwind content paths and brand tokens (**tracked in Git**) |
| `assets/scss/components/components.scss` | Tailwind entry / component source styles |
| `css/components.css` | Compiled Tailwind output (enqueued on flexible-component pages) |
| `.npm/browsersync-components.js` | BrowserSync proxy for component CSS live reload |
| `.npm/COMPONENTS_DEV.md` | Local dev notes for `dev:components` |
| `COMPONENTS_SETUP.md` | Setup guide for the components system (**tracked**) |

**Install and build commands**

```bash
cd wp-content/themes/rouge-wp-start-theme/.npm
npm install
npm run build:components
```

Development:

```bash
npm run watch:components          # rebuild CSS on change
npm run dev:components            # watch + BrowserSync
# optional: WP_URL=https://your-local-url npm run dev:components
```

**Source → compiled**

| Source | Output |
|---|---|
| `assets/scss/components/components.scss` + PHP under `templates/components/**` (scanned by Tailwind) | `css/components.css` |
| `js/components/*.js` | Loaded as-is (not bundled by the Tailwind scripts; enqueued per component) |
| `css/custom-global.css` | Hand-maintained overrides (not produced by Tailwind) |

`tailwind.config.js` content paths (evidence this build is for Designjam components only):

- `templates/components/**/*.php`
- `template-components.php`

**Dependencies and versions (from `.npm/package.json` / lockfile)**

| Package | Version range / note |
|---|---|
| `tailwindcss` | `^3.4.1` (engines: Node `>=14`) |
| `postcss` | `^8.4.35` |
| `concurrently` | `^9.2.1` (engines: Node `>=18` — used only by `dev:components`) |
| Bootstrap, Slick, Gulp, node-sass, etc. | Inherited original build (see Inherited section) |

**Runtime noted on this machine (not a project pin):** Node `v16.17.1`, npm `8.15.0`, PHP `8.3.30`.  
There is no `.nvmrc`, `.node-version`, or theme `composer.json`. For Designjam CSS builds, Node 14+ is enough for `build:components`; for `dev:components`, prefer Node 18+ because of `concurrently`.

The original Gulp pipeline was **not** modified for Designjam work; Tailwind was added as separate npm scripts in the same `.npm/package.json`.

### PHP / enqueue integration

| File | Designjam role |
|---|---|
| `template-components.php` | Page template “Flexible components” |
| `single-case_studies-components.php` | Case study flexible-components single |
| `single-post-components.php` | Post flexible-components single |
| `lib/scripts.php` | Enqueues `components.css` and per-component JS when flexible template is used |
| `lib/posts.php` | Meta box to choose Flexible Components template on posts |
| `lib/modules/cpt-case-studies.php` | Meta box for case study template choice |
| `lib/wysiwyg.php` | Underline button for TinyMCE / ACF Full toolbar (July 2026) |
| `lib/mobile-menu-walker.php` + `js/mobile-menu.js` + `templates/components/mobile-menu.php` | Custom mobile menu (replaces older mmenu approach) |
| `functions.php` | Includes mobile menu walker (small wiring change) |
| `css/custom-global.css` | Header/menu overrides, HubSpot form styling, mobile menu styles, sticky header tweaks |
| `js/components/*` | Component-specific front-end JS |
| `js/components/README.md` | How conditional component scripts work |

Component CSS/JS load only on pages using the flexible components template (or case studies/posts with that template selected).

### ACF field groups (Designjam)

Synced via theme `acf-json/`. Requires **Advanced Custom Fields Pro**.

**Parent / options**

| File | Title | One-line description |
|---|---|---|
| `group_flexible_components.json` | Flexible Components | Flexible Content layouts for the new page builder |
| `ui_options_page_6927093764532.json` | Global Components | Options UI for shared global blocks |
| `group_block_options.json` | Block Options | Shared block options (**unsure** how widely used vs inherited options) |
| `group_694314a03c235.json` | Menu Items | ACF fields on menu items (mobile menu content) |
| `group_697a570edb8fe.json` | Mobile menu options | Mobile menu settings |
| `group_699eb129e2153.json` | Case Study Overview | Case study overview fields |

**Flexible layouts currently registered** (from `group_flexible_components.json`)

| Layout | Template | One-line description |
|---|---|---|
| `hero` | `templates/components/hero.php` | Hero with subtypes: standard, HubSpot form, stats |
| `image_text` | `image_text.php` | Image and text section |
| `full_width` | `full_width.php` | Full-width WYSIWYG content block |
| `repeatable_cards` | `repeatable_cards.php` | Grid of repeatable cards |
| `metrics_grid` | `metrics_grid.php` | Metrics / results grid |
| `testimonial` | `testimonial.php` | Single testimonial |
| `testimonial_grid` | `testimonial_grid.php` | Logo grid with featured hover testimonial |
| `faqs` | `faqs.php` | FAQ accordion |
| `vertical_carousel` | `vertical_carousel.php` | Sticky / scroll-driven vertical feature carousel |
| `cta_banner` | `cta_banner.php` | Call-to-action banner |
| `product_feature_carousel` | `product_feature_carousel.php` | Product feature image carousel |
| `recommended_products` | `recommended_products.php` | Recommended products carousel/cards |
| `vertical_tabs` | `vertical_tabs.php` | Vertical tabbed content |
| `comparison_cards` | `comparison_cards.php` | Comparison cards (grid desktop, carousel mobile) |
| `stat_metric` | `stat_metric.php` | Large statistic / metric block |
| `comparison_table` | `comparison_table.php` | Product comparison table (swipe on mobile) |
| `challenge_list` | `challenge_list.php` | Challenge list content |
| `product_detail` | `product_detail.php` | Product detail layout with mobile carousel |
| `application_cards` | `application_cards.php` | Application cards around a centre image |
| `contact_form` | `contact_form.php` | Contact section with HubSpot embed field |
| `video_player` | `video_player.php` | Video player block |
| `about_company` | `about_company.php` | About company section |
| `useful_contacts` | `useful_contacts.php` | Useful contacts cards |
| `logo_carousel` | `logo_carousel.php` | Logo carousel (CSS conveyor) |
| `global_components` | `global_components.php` | Wrapper that loads a selected global component |

**Component ACF clone groups** (`group_component_*.json`) — field definitions cloned into flexible layouts / globals, including: About Company, Application Cards, Benefits Grid, Challenge List, Company Info Card, Comparison Cards, Comparison Table, Contact Form, Contact Map, Content Section, CTA Banner, Customer Carousel, Download Banner, Faqs, Full width, Hero, Image Text, Metrics Grid, Partner Carousel, Pricing Plans, Product Detail, Product Feature Carousel, Repeatable Cards, Resources, Service Cards / Repeatable Cards (title duplication), Solutions, Stat Metric, Success Stories, Testimonial, Testimonials, Vertical Tabs, Video Player.

Also: `group_693e82d7868bf.json` (Vertical Carousel), `group_6941712fd873b.json` (Recommended Products), `group_6953b34064d67.json` (Useful Contacts).

**Global component PHP** under `templates/components/global/`: contact map, customer/partner carousels (CSS and older Slick variants), latest resources, solutions, success stories, testimonials.

### CSS / JS clearly belonging to Designjam

- `css/components.css` + `assets/scss/components/components.scss`
- `css/custom-global.css` (header/menu work, HubSpot `.hbspt-form` / `.hubspot-one-col` styles, mobile menu)
- `js/components/` (`carousel.js`, `faqs.js`, `form.js`, `product-detail.js`, `solutions.js`, `testimonials.js`, `vertical-tabs.js`, `vertical-carousel.js`, `application-cards.js`, `video.js`, etc.)
- `js/mobile-menu.js`
- Docs: `COMPONENTS_SETUP.md`, `js/components/README.md`

### Hidden / local / gitignored files to include or strip

| Path | Purpose | Credentials? |
|---|---|---|
| Theme `.npm/` (entire folder) | Build tooling, lockfile, BrowserSync helper, **node_modules** | No secrets expected; `gulp.config.json` holds a **local proxy hostname** (old Rouge-dev URL) — review before sharing |
| Theme `.gitignore` | Ignores `.npm/` only | No |
| Theme `.git/` | Designjam theme history + remote | Contains GitHub remote URL for `designjam/xeretec` |
| Project `wp-config.php` | Local DB and WordPress salts | **Yes — contains DB credentials, auth keys/salts, `WP2FA_ENCRYPT_KEY`. Remove or replace before handover** |
| `.htaccess` | Standard WordPress rewrites | No |
| `xeretec.code-workspace` | Local VS Code/Cursor workspace | No |
| `.DS_Store` | macOS folder metadata | No — omit |
| Root `js/components/carousel.js` | Tiny stub (3 bytes) outside the theme | **Unsure** purpose; looks accidental — do not treat as production |
| `wp-content/uploads/` | Media library | May contain client media; not theme source |
| `wp-content/plugins/` + licences | Full plugin set from local/staging copy | Licence keys may live in DB/options — see Incomplete |
| `wp-content/cache/`, `upgrade/`, etc. | Runtime | Omit from source handover |

### Incomplete / known issues / dependencies

1. **ACF Pro** — required for flexible content, clones, options pages and Local JSON.
2. **HubSpot** — hero/contact forms embed HubSpot code; styling depends on HubSpot markup (`.hbspt-form`). HubSpot / Leadin account access is external.
3. **Comparison cards carousel** — JS enqueue mapping was missing and is fixed in theme Git (`comparison_cards` → `carousel` in `lib/scripts.php`). Confirm staging/live have been updated with that commit.
4. **ACF groups without PHP templates** (field groups exist; layouts may be unused or fall through to placeholder): `benefits_grid`, `company_info_card`, `content_section`, `download_banner`, `pricing_plans`, `resources`, `service_cards`.
5. **Leftover / experimental files**: `templates/components/vertical_carousel_old.php`, `-vertical_carousel.php`, `scrolltrigger.html`, `js/components/vertical-carousel-old.js`, ACF group **JM Test** (`group_6842f766d0118.json`).
6. **Placeholder templates** — `placeholder.php` / `global/placeholder.php` show when a layout has no matching template.
7. **`comparison_cards.php` markup** — content `div` class string still contains a stray PHP fragment (`' : ''; ?>`) in the class attribute (cosmetic/markup bug).
8. **Google Maps API** — `lib/init.php` still has placeholder `'API_KEY'` for ACF Google Map (**inherited pattern**; confirm whether maps are used).
9. **Licensed plugins on this local copy** (client/host must own licences): ACF Pro, Formidable Pro (+ HubSpot/Salesforce/API add-ons), Search Filter Pro, Folders Pro, WP Migrate DB Pro, Yoast, etc.
10. **No Composer** for the theme; PHP plugins ship with their own vendor trees where applicable.
11. **`.npm/` not in Git** — anyone cloning only `designjam/xeretec` will get compiled `css/components.css` and source SCSS/PHP, but **not** `package.json` / lockfile / BrowserSync helper unless those are supplied separately.
12. **Landscape.uk.com colours** — brand overrides exist only on the Landscape install’s `custom-global.css`; they are not in this repo (late request; see Landscape section above).

### Files that exist locally but are probably not on live/staging (or not needed there)

Include these in a “source + tooling” handover package if the client needs to rebuild CSS:

- Theme `.npm/` (especially `package.json`, `package-lock.json`, `browsersync-components.js`, `COMPONENTS_DEV.md`, `gulpfile.js`, configs) — **exclude or regenerate `node_modules`**
- `tailwind.config.js`, `assets/scss/components/`, docs (`COMPONENTS_SETUP.md`)
- Local-only: `wp-config.php` (sanitize first), `xeretec.code-workspace`, `.DS_Store`, full `node_modules`, WordPress core, caches, local DB dumps if any

Live/staging typically need the **compiled** theme assets (`css/components.css`, `css/custom-global.css`, PHP templates, `js/components/*`, `acf-json`) rather than Node tooling.

---

## Inherited / not our work

### Theme identity

- Theme name: **Rouge WP Start Theme** (`style.css`; description notes updates by Cremarc).
- Original README is a Bitbucket stub, not Designjam documentation.
- Letter-coded page templates (`template-about-tb.php`, `template-team-td.php`, `template-contact-us-tg.php`, etc.) and `template-modules.php`.
- Classic structure: `templates/modules/`, `templates/regions/`, `templates/posts/`, `assets/scss` Bootstrap/module SCSS, `webfonts/`.

### Original build process (do not treat as Designjam’s Tailwind workflow)

| Item | Role |
|---|---|
| `.npm/gulpfile.js` | Gulp 3 tasks: Sass → `css/global-styles*.css`, JS bundles → `js/global-scripts*.js`, BrowserSync |
| `.npm/gulp.config.json` / `.sample` | Proxy URL for original BrowserSync |
| Dependencies | Bootstrap 4, Popper, Slick, simple-parallax, gulp-sass / node-sass, etc. |

Compiled outputs from that pipeline (inherited):

- `css/global-styles.css` / `css/global-styles.min.css`
- `css/template-team-styles*.css`
- `js/global-scripts.js` / `js/global-scripts.min.js` (includes Slick)
- `js/template-home-scripts*.js`, `js/template-team-scripts*.js`
- Source: `assets/scss/**` (except Designjam `components/`), `assets/js/custom.js`

Designjam did **not** rewrite this Gulp setup; `css/global-styles.min.css` was touched in an “Update from live” commit (**unsure** whether that diff was Cremarc/live sync vs intentional Designjam edit).

### Inherited ACF / content model

Dozens of `acf-json/group_626*.json` (and similar hex IDs from ~2022) for the original **Page Builder** and module fields (e.g. `group_5ecfc45f104bc.json` title “Page Builder”). These back the older templates/modules, not the Tailwind flexible components system.

### Inherited PHP / assets still in active use

- `lib/admin.php`, `lib/config.php`, `lib/media.php`, `lib/nav.php` (Bootstrap nav walker), `lib/project.php`, shortcodes/TinyMCE setup in `lib/wysiwyg.php` (aside from the later underline filter)
- CPTs/taxonomies under `lib/modules/` (case studies, partners, devices, testimonials, insights, pillar) — Designjam extended case studies/posts for flexible templates
- Header/footer regions, archive templates, front-page, many `templates/modules/*`
- Plugins and WordPress core as installed locally (not authored by Designjam)

### Unsure attribution (touched by Designjam commits but rooted in inherited code)

- Edits to `templates/regions/region-header.php` / `region-footer.php`, `page.php`, search/404/sitemap templates
- Changes to `assets/js/custom.js`, `js/observer.js`, `js/global-scripts.js`
- Whether live `global-styles.min.css` differences are Designjam or host sync
- Exact ownership of every line in `css/custom-global.css` before HubSpot/mobile-menu sections (file was introduced/expanded for Designjam header work, but sits as an override layer on the inherited theme)

---

## Quick reference for the client

| Need | Where |
|---|---|
| Edit a flexible page | WP Admin → page using template **Flexible components** → Flexible Components field |
| Rebuild component CSS | Theme `.npm` → `npm install` → `npm run build:components` |
| Component PHP | `templates/components/` |
| Component fields | `acf-json/group_component_*.json` + `group_flexible_components.json` |
| Global shared blocks | ACF Options / Global Components + `templates/components/global/` |
| Site-wide CSS overrides (HubSpot, header, mobile menu) | `css/custom-global.css` |
| Landscape brand colours | Landscape site only — overrides in that install’s `css/custom-global.css` (no separate repo) |
| Original theme CSS | `css/global-styles.min.css` (Gulp; inherited) |
