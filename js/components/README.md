# Component JavaScript System

## Overview
This system conditionally loads JavaScript files based on which components are used on a page. It supports both regular components and nested `global_components`.

## How It Works

### Detection
The system automatically detects which components are present by:
1. Looping through the `flexible_components` ACF field
2. Checking if a component is `global_components` and reading its `components` sub-field
3. Mapping components to their required JavaScript files
4. Enqueuing only the scripts needed

### File Structure
```
js/components/
├── accordion.js    # FAQ accordion functionality
├── carousel.js     # All carousel components (regular & global)
├── video.js        # Video player functionality
└── form.js         # Form validation
```

## Adding New Component Scripts

### Step 1: Create the JavaScript File
Create a new file in `js/components/` directory, e.g., `solutions.js`

### Step 2: Add to Component Mapping
In `lib/scripts.php`, add your component to the `$component_scripts` array:

```php
$component_scripts = array(
    // ... existing mappings ...
    'solutions' => 'solutions',  // Regular component
    'global_-solutions' => 'solutions',  // Global component version
);
```

### Step 3: Update Defer Filter (Optional)
If you want the script to be deferred, add it to the `$scripts_to_defer` array in `add_defer_attribute()`:

```php
$scripts_to_defer = array(
    // ... existing scripts ...
    'component_solutions',
);
```

## Component Mappings

### Current Mappings
- `faqs` → `accordion.js`
- `product_feature_carousel` → `carousel.js`
- `video_player` → `video.js`
- `contact_form` → `form.js`
- `global_-customer_carousel` → `carousel.js`
- `global_-partner_carousel` → `carousel.js`

## Benefits

1. **Performance**: Only loads scripts for components actually used
2. **Modular**: Each component has its own JavaScript file
3. **Maintainable**: Easy to find and update component-specific code
4. **Scalable**: Simple to add new components
5. **Automatic**: No manual script enqueuing needed

## Notes

- Scripts are automatically deferred for better performance
- The system handles both regular and nested `global_components`
- Scripts load in the footer (non-blocking)
- Each script is self-contained and initializes on DOM ready

