<?php

/**
 * Video Player Component
 */

$content = get_sub_field('content');
$video_url = get_sub_field('video_url');
$video_file = get_sub_field('video_file');
$poster_image = get_sub_field('poster_image');

// Get video URL from either video_url field or video_file field
$final_video_url = '';
if ($video_file && is_array($video_file) && isset($video_file['url'])) {
  // Video file upload - get URL from file array
  $final_video_url = $video_file['url'];
} elseif ($video_url) {
  // Video URL field
  $final_video_url = $video_url;
}

if ($final_video_url):
  $component_id = 'video-player-' . get_row_index();

  // Convert YouTube/Vimeo URL to embed format
  $embed_url = '';
  if (strpos($final_video_url, 'youtube.com') !== false || strpos($final_video_url, 'youtu.be') !== false) {
    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $final_video_url, $matches);
    if (!empty($matches[1])) {
      $embed_url = 'https://www.youtube.com/embed/' . $matches[1];
    }
  } elseif (strpos($final_video_url, 'vimeo.com') !== false) {
    preg_match('/vimeo.com\/(\d+)/', $final_video_url, $matches);
    if (!empty($matches[1])) {
      $embed_url = 'https://player.vimeo.com/video/' . $matches[1];
    }
  }
?>

  <section class="bg-white component-wrapper" id="<?php echo esc_attr($component_id); ?>">
    <div class="container flex flex-col gap-8 px-4 mx-auto lg:gap-16">

      <?php if ($content): ?>
        <div class="mx-auto max-w-[900px] text-center">
          <?php echo wp_kses_post($content); ?>
        </div>
      <?php endif; ?>

      <!-- Video Thumbnail/Poster -->
      <div class="overflow-hidden relative cursor-pointer rounded-20 lg:h-[550px] shadow-custom group" data-video-player>
        <?php if ($poster_image): ?>
          <div class="relative h-full lg:max-h-[550px]">
            <img
              src="<?php echo esc_url($poster_image['url']); ?>"
              alt="<?php echo esc_attr($poster_image['alt'] ?: 'Video thumbnail'); ?>"
              class="object-cover object-center w-full h-full">
            <button
              class="flex absolute inset-0 !rounded-20 bg-black bg-opacity-10 border-none z-10 justify-center items-center duration-300 tansition-all group-hover:bg-opacity-40"
              data-video-play
              aria-label="Play video">
              <img
                src="<?php echo get_template_directory_uri(); ?>/assets/images/play-white.svg"
                alt="Play video"
                class="w-32 h-32 lg:w-52 lg:h-52">
            </button>
          </div>
        <?php else: ?>
          <!-- Fallback if no poster image -->
          <div class="flex relative justify-center items-center bg-gray-900 aspect-video">
            <button
              class="flex z-10 justify-center items-center p-8 bg-black bg-opacity-30 rounded-full transition-all duration-300 hover:bg-opacity-40"
              data-video-play
              aria-label="Play video">
              <img
                src="<?php echo get_template_directory_uri(); ?>/assets/images/play-white.svg"
                alt="Play video"
                class="w-20 h-20">
            </button>
          </div>
        <?php endif; ?>
      </div>
    </div>


  </section>

  <!-- Video Modal (outside section to avoid z-index stacking context issues) -->
  <div class="fixed inset-0 z-[99999] items-center justify-center hidden opacity-0 transition-opacity duration-300" data-video-modal="<?php echo esc_attr($component_id); ?>">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black bg-opacity-90 cursor-pointer" data-modal-overlay></div>

    <!-- Modal Content -->
    <div class="relative w-[90%] max-w-[1200px] z-10 transform scale-90 transition-transform duration-300" data-modal-content>
      <!-- Close Button -->
      <button
        class="absolute right-0 -top-12 z-20 p-2.5 bg-transparent border-none opacity-100 transition-opacity duration-200 cursor-pointer hover:opacity-70"
        data-modal-close
        aria-label="Close video modal">
        <img
          src="<?php echo get_template_directory_uri(); ?>/assets/images/close-white.svg"
          alt="Close"
          class="w-6 h-6">
      </button>

      <!-- Video Player Container -->
      <div class="relative w-full pb-[56.25%] bg-black rounded-lg overflow-hidden">
        <?php if ($embed_url): ?>
          <!-- YouTube/Vimeo Embed -->
          <iframe
            src=""
            data-src="<?php echo esc_url($embed_url); ?>"
            class="absolute top-0 left-0 w-full h-full border-0"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        <?php else: ?>
          <!-- Direct Video File -->
          <video class="object-contain absolute top-0 left-0 w-full h-full" controls>
            <source src="<?php echo esc_url($final_video_url); ?>" type="video/mp4">
          </video>
        <?php endif; ?>
      </div>
    </div>
  </div>

<?php endif; ?>