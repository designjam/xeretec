<?php
  /**
   * Image Text Component
   */

  $colour = get_sub_field('colour') ?: 'light';
  $content = get_sub_field('content');
  $component_id = 'image-text-' . get_row_index();
  // Set background and text classes based on colour selection
  $bg_class = $colour === 'dark' ? 'bg-dark' : 'bg-white';
  $text_class = $colour === 'dark' ? 'text-white' : 'text-gray-900';
?>
<?php if ($content): ?>
  <section class="component-wrapper <?php echo esc_attr($bg_class); ?> <?php echo esc_attr($text_class); ?>" id="<?php echo esc_attr($component_id); ?>">
    <div class="container mx-auto">
      <div class="max-w-none <?php echo esc_attr($text_class); ?>">
        <?php echo wp_kses_post($content); ?>
      </div>
    </div>
  </section>
<?php endif; ?>