# Components Setup Guide

## Overview
This theme now includes a flexible component system using ACF Flexible Content fields. All components use Tailwind CSS and are isolated from existing theme styles.

## Installation Steps

### 1. Install Dependencies
```bash
cd wp-content/themes/rouge-wp-start-theme/.npm
npm install
```

### 2. Build Tailwind CSS
```bash
npm run build:components
```

For development with watch mode:
```bash
npm run watch:components
```

### 3. WordPress Setup
1. Go to WordPress Admin → Custom Fields → Field Groups
2. The "Flexible Components" field group should appear automatically (via Local JSON)
3. Assign it to pages using the `template-components.php` template

### 4. Create a Page
1. Create a new page in WordPress
2. Select "Flexible components" as the page template
3. Add components using the "Flexible Components" field
4. Publish the page

## Component List

### Global Components (8)
1. **hero** - Hero banner with 4 sub-types (standard, video, cards_two, cards_three)
2. **solutions** - Solution cards with timeline navigation
3. **contact_map** - Contact cards grid
4. **testimonials** - Testimonial cards
5. **resources** - Resource download with navigation
6. **customer_carousel** - Customer logos carousel
7. **partner_carousel** - Partner logos carousel
8. **success_stories** - Success stories/metrics grid

### Page-Specific Components (19)
1. **company_info_card** - Company info with image and data box
2. **stat_metric** - Single statistic display
3. **comparison_table** - Product comparison table
4. **faqs** - FAQ accordion
5. **cta_banner** - CTA banner with image
6. **product_feature_carousel** - Product feature carousel
7. **pricing_plans** - Service plans grid
8. **download_banner** - Download brochure banner
9. **challenge_list** - Challenge list with icons
10. **benefits_grid** - Benefits grid
11. **product_detail** - Product detail page
12. **application_cards** - Application cards with central image
13. **contact_form** - Contact form component
14. **video_player** - Video player component
15. **metrics_grid** - Metrics/results grid
16. **about_company** - About company section
17. **service_cards** - Service cards component
18. **content_section** - General content section
19. **image_text** - Image/text layout component

## File Structure

```
theme/
├── templates/
│   └── components/          # All 27 component template files
├── assets/
│   └── scss/
│       └── components/
│           └── components.scss  # Tailwind imports
├── css/
│   └── components.css      # Compiled Tailwind CSS (generated)
├── js/
│   ├── components/
│   │   └── components-main.js   # Component JavaScript source
│   └── components.js       # Compiled JavaScript (for production)
├── acf-json/
│   └── group_flexible_components.json  # ACF field group
└── template-components.php  # Page template that uses components
```

## Important Notes

- **CSS/JS Isolation**: Component assets only load on pages using `template-components.php`
- **No Conflicts**: Tailwind CSS is scoped to component templates only
- **Existing Templates**: All existing templates remain unchanged
- **Field Naming**: Uses clean field names (no fld_*, img_* prefixes required)

## Development

### Building CSS
```bash
npm run build:components    # Production build (minified)
npm run watch:components    # Development watch mode
```

### JavaScript
The JavaScript file (`js/components.js`) is currently a direct copy of `js/components/components-main.js`. For production, you may want to:
- Minify the JavaScript
- Bundle multiple files if needed
- Add source maps

## Troubleshooting

### Components not showing
- Check that the page is using `template-components.php` template
- Verify ACF field group is assigned to the template
- Check browser console for JavaScript errors

### Styles not loading
- Run `npm run build:components` to generate CSS
- Check that `css/components.css` exists
- Verify the file is being enqueued (check page source)

### JavaScript not working
- Check browser console for errors
- Verify `js/components.js` exists
- Ensure jQuery is loaded (components.js depends on it)

