<?php

/**
 * Links Snippet
 */

$primary_cta = get_sub_field('primary_cta');
$secondary_cta = get_sub_field('secondary_cta');
?>
<div class="flex flex-col sm:flex-row gap-4 flex-wrap">
  <?php if ($primary_cta): ?>
    <a href="<?php echo esc_url($primary_cta['url']); ?>" class="button-primary">
      <?php echo esc_html($primary_cta['title']); ?>
    </a>
  <?php endif; ?>
  <?php if ($secondary_cta): ?>
    <a href="<?php echo esc_url($secondary_cta['url']); ?>" class="button-secondary">
      <?php echo esc_html($secondary_cta['title']); ?>
    </a>
  <?php endif; ?>
</div>