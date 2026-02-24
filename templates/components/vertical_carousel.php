<?php

/**
 * Vertical Carousel Component
 * Uses CSS sticky positioning and Intersection Observer for natural scrolling
 */

$content = get_sub_field('content');
$repeatable_cards = get_sub_field('repeatable_cards');

if ($content && $repeatable_cards):
  $component_id = 'vertical-carousel-scroll-' . get_row_index();
?>
  <style>
    /* Scoped styles with new class names */
    .vc-scroll-section {
      position: relative;
      overflow: visible !important; /* Override overflow-hidden class */
      padding-top: 10vh; /* Add top padding so sticky doesn't activate too early */
      padding-bottom: 10vh; /* Add bottom padding */
    }

    .vc-scroll-container {
      display: grid;
      grid-template-columns: 1fr;
      gap: 4rem;
      min-height: 80vh;
      align-items: start; /* Important for sticky to work */
    }

    @media (min-width: 1024px) {
      .vc-scroll-container {
        grid-template-columns: 1fr 1fr 80px; /* Left content | Cards | Navigation */
        gap: 0;
        align-items: start; /* Important for sticky to work */
      }
    }

    /* Left content - sticky pinned */
    .vc-scroll-left {
      position: relative;
    }

    @media (min-width: 1024px) {
      .vc-scroll-left {
        position: -webkit-sticky; /* Safari support */
        position: sticky;
        top: 20vh; /* Stick when 20vh from top - allows natural scroll in first */
        align-self: start;
        height: fit-content;
        max-height: calc(100vh - 4rem); /* Prevent overflow */
        overflow: hidden;
      }
    }

    /* Cards column - natural document flow */
    .vc-scroll-cards-column {
      position: relative;
    }
    @media (min-width: 1024px) {
      .vc-scroll-cards-column {
        padding-left: 100px;
      }
    }

    /* Card stack - natural document flow */
    .vc-scroll-card-stack {
      display: flex;
      flex-direction: column;
      gap: 100px;
      position: relative;
    }

    /* Individual cards - natural flow */
    .vc-scroll-card {
      position: relative;
      width: 100%;
      opacity: 1;
      transform: none;
      transition: opacity 0.3s ease;
    }

    /* Navigation bullets column - sticky pinned */
    .vc-scroll-nav-column {
      position: relative;
      display: none;
    }

    @media (min-width: 1024px) {
      .vc-scroll-nav-column {
        display: block;
        position: -webkit-sticky; /* Safari support */
        position: sticky;
        top: 45vh; /* Stick when 20vh from top - allows natural scroll in first */
        align-self: start;
        height: fit-content;
      }
    }

    .vc-scroll-nav {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1.5rem;
      position: relative;
      pointer-events: none;
    }

    .vc-scroll-nav-line {
      position: absolute;
      width: 2px;
      height: calc(100% - 20px);
      background: rgba(255, 255, 255, 0.3);
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
    }

    .vc-scroll-nav-bullet {
      width: 16px;
      height: 16px;
      border-radius: 50%;
      border: 2px solid white;
      background: #120E25;
      position: relative;
      z-index: 2;
      transition: all 0.3s ease;
      cursor: pointer;
      pointer-events: all;
    }

    .vc-scroll-nav-bullet.active {
      background: white;
      border-color: white;
    }

    /* Card styling */
    .vc-scroll-card-content {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      padding: 0;
      background: linear-gradient(180deg, #FFFFFF 0%, #EDEEF5 100%);
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
      transition: box-shadow 0.3s ease;
    }

    @media (min-width: 1024px) {
      .vc-scroll-card-content {
        gap: 2.5rem;
      }
    }

    .vc-scroll-card-content:hover {
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .vc-scroll-card-image {
      height: 300px;
      border-radius: 20px 20px 0 0;
      overflow: hidden;
    }

    .vc-scroll-card-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .vc-scroll-card-body {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      padding: 2.5rem;
      padding-top: 1rem;
    }

    .vc-scroll-card-title {
      font-size: 30px;
      font-weight: bold;
      margin: 0;
    }

    .vc-scroll-card-description {
      margin: 0;
      color: #333;
    }

    /* Mobile: no pinning, normal flow */
    @media (max-width: 1023px) {
      .vc-scroll-nav-column {
        display: none;
      }
      
      .vc-scroll-left {
        position: relative;
        transform: none;
      }
    }
  </style>

  <section class="overflow-hidden relative text-white component-wrapper bg-dark vc-scroll-section" id="<?php echo esc_attr($component_id); ?>">
    <div class="container mx-auto vc-scroll-container">
      
      <?php if ($content): ?>
        <div class="vc-scroll-left">
          <?php echo wp_kses_post($content); ?>
          <div class="flex" style="padding-top: 20px;">
            <?php get_template_part('templates/components/snippets/links'); ?>
          </div>
        </div>
      <?php endif; ?>

      <?php if ($repeatable_cards): ?>
        <!-- Cards Column -->
        <div class="vc-scroll-cards-column">
          <div class="vc-scroll-card-stack" id="vc-scroll-card-stack-<?php echo esc_attr($component_id); ?>">
            <?php foreach ($repeatable_cards as $index => $card): ?>
              <div class="vc-scroll-card" 
                   id="vc-card-<?php echo esc_attr($component_id); ?>-<?php echo $index; ?>"
                   data-card-index="<?php echo $index; ?>">
                
                <?php if ($card['link']): ?>
                  <a href="<?php echo esc_url($card['link']['url']); ?>" class="block vc-scroll-card-content text-dark group">
                <?php else: ?>
                  <div class="vc-scroll-card-content text-dark">
                <?php endif; ?>

                  <?php if ($card['image']): ?>
                    <div class="vc-scroll-card-image">
                      <img src="<?php echo esc_url($card['image']['url']); ?>" 
                           alt="<?php echo esc_attr($card['image']['alt']); ?>">
                    </div>
                  <?php endif; ?>

                  <div class="vc-scroll-card-body">
                    <?php if ($card['title']): ?>
                      <h3 class="vc-scroll-card-title text-brand"><?php echo esc_html($card['title']); ?></h3>
                    <?php endif; ?>

                    <?php if ($card['description']): ?>
                      <p class="vc-scroll-card-description"><?php echo esc_html($card['description']); ?></p>
                    <?php endif; ?>

                    <?php if ($card['link']): ?>
                      <span class="inline-block button-tertiary">
                        <?php echo esc_html($card['link']['title'] ?: 'Explore'); ?>
                      </span>
                    <?php endif; ?>
                  </div>

                <?php if ($card['link']): ?>
                  </a>
                <?php else: ?>
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Navigation Bullets Column -->
        <div class="vc-scroll-nav-column">
          <div class="vc-scroll-nav" id="vc-scroll-nav-<?php echo esc_attr($component_id); ?>">
            <div class="vc-scroll-nav-line"></div>
            <?php foreach ($repeatable_cards as $index => $card): ?>
              <div class="vc-scroll-nav-bullet <?php echo $index === 0 ? 'active' : ''; ?>" 
                   data-index="<?php echo $index; ?>"
                   data-card-id="vc-card-<?php echo esc_attr($component_id); ?>-<?php echo $index; ?>"></div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <script>
  (function() {
    'use strict';
    
    function initVerticalCarouselScroll() {
      // Only run on desktop (min-width: 1024px)
      if (window.innerWidth < 1024) {
        return;
      }

      const section = document.getElementById('<?php echo esc_js($component_id); ?>');
      if (!section) return;

      const cards = section.querySelectorAll('.vc-scroll-card');
      const bullets = section.querySelectorAll('.vc-scroll-nav-bullet');

      if (cards.length === 0 || bullets.length === 0) return;

      // Function to update active bullet
      function updateActiveBullet(index) {
        bullets.forEach((bullet, i) => {
          if (i === index) {
            bullet.classList.add('active');
          } else {
            bullet.classList.remove('active');
          }
        });
      }

      // Function to get distance from viewport center
      function getDistanceFromCenter(card) {
        const rect = card.getBoundingClientRect();
        const viewportHeight = window.innerHeight;
        const cardCenter = rect.top + rect.height / 2;
        const viewportCenter = viewportHeight / 2;
        
        return Math.abs(cardCenter - viewportCenter);
      }

      // Function to find the most centered card
      function findMostCenteredCard() {
        let mostCenteredIndex = 0;
        let smallestDistance = Infinity;
        
        cards.forEach((card, index) => {
          const rect = card.getBoundingClientRect();
          // Only consider cards that are visible in viewport
          if (rect.bottom > 0 && rect.top < window.innerHeight) {
            const distance = getDistanceFromCenter(card);
            if (distance < smallestDistance) {
              smallestDistance = distance;
              mostCenteredIndex = index;
            }
          }
        });
        
        return mostCenteredIndex;
      }

      // Intersection Observer to detect visible cards
      const observerOptions = {
        root: null,
        rootMargin: '-20% 0px -20% 0px', // Trigger when card is in center 60% of viewport
        threshold: [0, 0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1]
      };

      const observer = new IntersectionObserver((entries) => {
        // Find the most centered card among all intersecting entries
        const visibleCards = entries
          .filter(entry => entry.isIntersecting)
          .map(entry => ({
            index: parseInt(entry.target.dataset.cardIndex, 10),
            distance: getDistanceFromCenter(entry.target),
            ratio: entry.intersectionRatio
          }));
        
        if (visibleCards.length > 0) {
          // Sort by distance from center, then by intersection ratio
          visibleCards.sort((a, b) => {
            if (Math.abs(a.distance - b.distance) < 50) {
              // If distances are close, prefer higher intersection ratio
              return b.ratio - a.ratio;
            }
            return a.distance - b.distance;
          });
          
          updateActiveBullet(visibleCards[0].index);
        }
      }, observerOptions);

      // Observe all cards
      cards.forEach(card => {
        observer.observe(card);
      });

      // Scroll event handler - finds most centered card
      let scrollTimeout;
      let lastActiveIndex = 0;
      
      function checkCenteredCards() {
        clearTimeout(scrollTimeout);
        scrollTimeout = setTimeout(() => {
          const mostCenteredIndex = findMostCenteredCard();
          // Only update if it's different to avoid unnecessary DOM updates
          if (mostCenteredIndex !== lastActiveIndex) {
            updateActiveBullet(mostCenteredIndex);
            lastActiveIndex = mostCenteredIndex;
          }
        }, 50); // Reduced timeout for more responsive updates
      }

      window.addEventListener('scroll', checkCenteredCards, { passive: true });

      // Bullet click navigation - smooth scroll to card
      bullets.forEach((bullet, index) => {
        bullet.addEventListener('click', (e) => {
          e.preventDefault();
          const targetCardId = bullet.dataset.cardId;
          const targetCard = document.getElementById(targetCardId);
          
          if (targetCard) {
            // Calculate offset to center the card
            const cardRect = targetCard.getBoundingClientRect();
            const scrollOffset = window.pageYOffset + cardRect.top - (window.innerHeight / 2) + (cardRect.height / 2);
            
            window.scrollTo({
              top: scrollOffset,
              behavior: 'smooth'
            });
          }
        });
      });

      // Initial check - find most centered card on load
      const initialIndex = findMostCenteredCard();
      updateActiveBullet(initialIndex);
      lastActiveIndex = initialIndex;
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', initVerticalCarouselScroll);
    } else {
      initVerticalCarouselScroll();
    }

    // Re-initialize on resize (to handle mobile/desktop switching)
    let resizeTimeout;
    window.addEventListener('resize', () => {
      clearTimeout(resizeTimeout);
      resizeTimeout = setTimeout(() => {
        initVerticalCarouselScroll();
      }, 250);
    });
  })();
  </script>

<?php endif; ?>
