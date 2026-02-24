<?php 

$theme_includes = array(
  'lib/init.php',                       // Initial theme setup and constants
  'lib/config.php',                     // Configuration
  'lib/wysiwyg.php',                    // Editor helpers
  'lib/scripts.php',                    // Configuration
  'lib/nav.php',                        // Bootstrap Nav Walker
  'lib/mobile-menu-walker.php',        // Mobile Menu Walker
  'lib/media.php',                      // Handle the uploaded medias
  'lib/admin.php',                      // Admin pages utilities
  'lib/project.php',                    // Project-specific functions
  'lib/posts.php',                      // Posts utilities like AJAX loading

  'lib/modules/cpt-case-studies.php',   // Case Studies - Single template
  'lib/modules/cpt-partners.php',       // Partners - No single template
  'lib/modules/cpt-devices.php',        // Devices - No single template
  'lib/modules/cpt-testimonials.php',   // Testimonials - No single template

  'lib/modules/taxonomy-insights.php',  // Insights Post Taxonomy
  'lib/modules/taxonomy-pillar.php',    // Shared Post Taxonomy
);

foreach ($theme_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'theme'), $file), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);

?>