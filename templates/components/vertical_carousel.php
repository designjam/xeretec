<?php

/**
 * Vertical Carousel Component
 * Uses Slick Carousel with vertical orientation
 */

$content = get_sub_field('content');
$repeatable_cards = get_sub_field('repeatable_cards');

if ($content && $repeatable_cards):
  $component_id = 'vertical-carousel-' . get_row_index();
?>
  <style>

    .cardStack {
      position: relative;
      min-height: 640px;
      border-radius: 20px;
    }

    .card {
      position: absolute;
      inset: 0;
      overflow: hidden;
      will-change: transform, opacity;
    }

    /* Mobile: no pinning, just stack normally */
    @media (max-width: 960px) {

      .cardStack {
        height: auto;
        overflow: visible;
        border-radius: 0;
      }

      .card {
        position: relative;
        inset: auto;
      }
    }
  </style>


  <section class="overflow-hidden relative py-32 text-white bg-dark" id="vertical-carousel">
    <div class="container mx-auto grid min-h-[80vh] items-center gap-48 grid-cols-1 lg:grid-cols-2">

      <?php if ($content): ?>
        <div class="left">
          <?php echo wp_kses_post($content); ?>
        </div>
      <?php endif; ?>
      <?php if ($repeatable_cards): ?>
        <div class="relative">
          <div class="cardStack" id="cardStack">
          <?php foreach ($repeatable_cards as $card): ?>

            <?php if ($card['link']): ?>
                    <a href="<?php echo esc_url($card['link']['url']); ?>" class=" card !p-0 block flex flex-col gap-6 bg-white shadow-xl transition cursor-pointer rounded-10 hover:shadow-xl text-dark group">
                  <?php else: ?>
                    <div class="card !p-0 flex flex-col gap-8 shadow-xl transition lg:gap-10 rounded-10 hover:shadow-xl text-dark" style="background: linear-gradient(180deg, #FFFFFF 0%, #EDEEF5 100%);">
                  <?php endif; ?>
                    <?php if ($card['image']): ?>
                      <div class="h-[300px] rounded-t-10 overflow-hidden">
                        <img src="<?php echo esc_url($card['image']['url']); ?>" alt="<?php echo esc_attr($card['image']['alt']); ?>" class="object-cover flex-shrink-0 w-full h-full">
                      </div>
                    <?php endif; ?>
                    <div class="flex flex-col gap-6 p-10 pt-4">

                      <?php if ($card['title']): ?>
                        <h3 class="text-[23px] font-bold text-brand"><?php echo esc_html($card['title']); ?></h3>
                      <?php endif; ?>

                      <?php if ($card['description']): ?>
                        <p class="text-[16px] lg:text-[18px] text-gray-600 !m-0 "><?php echo esc_html($card['description']); ?></p>
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
            <?php endforeach; ?>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>


  <!-- GSAP -->
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>

  <script>
    gsap.registerPlugin(ScrollTrigger);

    const mm = gsap.matchMedia();

    mm.add("(min-width: 961px)", () => {
      const section = document.querySelector("#vertical-carousel");
      const cards = gsap.utils.toArray("#cardStack .card");

      // Start hidden/off-screen (below)
      gsap.set(cards, {
        opacity: 0,
        yPercent: 35, // start below the visible area
        pointerEvents: "none"
      });

			gsap.set(cards[0], {
				opacity: 1,
				yPercent: 0
			});

      // Pinned section timeline: each card in -> hold -> out
      const hold = 0.5; // increase for longer "pin" per card
      const inDur = 0.35; // entrance speed
      const outDur = 0.35; // exit speed
      const gap = 0.15; // small gap between cards

      const tl = gsap.timeline({
        scrollTrigger: {
          trigger: section,
          start: "top top",
          end: () => "+=" + (cards.length * 900), // increase to slow down overall
          scrub: true,
          pin: true,
          anticipatePin: 1,
          // markers: true
          invalidateOnRefresh: true,
        }
      });

      cards.forEach((card, index) => {
        tl.to(card, {
          opacity: 1,
          yPercent: 0,
          duration: inDur,
          ease: "power2.out",
        });

        // "Pinned" hold moment (this is effectively the delay)
        tl.to({}, {
          duration: hold,
        });

				// Don't fade out the last card
				if (index == cards.length - 1) {
					return;
				}

        tl.to(card, {
          opacity: 0,
          yPercent: -35, // exit above
          duration: outDur,
          ease: "power2.in",
        });

        tl.to({}, {
          duration: gap,
        });
      });

      // Keep left side pinned too (without extra spacing)
      ScrollTrigger.create({
        trigger: section,
        start: "top top",
        end: () => "+=" + (cards.length * 1200),
        pin: section.querySelector(".left"),
        pinSpacing: false,
        invalidateOnRefresh: true,
      });
    });


    // Mobile version
    /*mm.add("(max-width: 960px)", () => {
			const cards = gsap.utils.toArray("#cardStack .card");

			cards.forEach((card, i) => {
				// Make the first card visible by default
				if (i === 0) {
					gsap.set(card, { opacity: 1, yPercent: 0 });
				} else {
					gsap.set(card, { opacity: 0, yPercent: 35 });
				}

				// Pin the card as it reaches the top
				ScrollTrigger.create({
					trigger: card,
					start: "top top",
					end: "bottom+=50% top", // pin until next card comes in
					pin: true,
					pinSpacing: false,
					onEnter: () => {
						gsap.to(card, { opacity: 1, yPercent: 0, duration: 0.5, ease: "power2.out" });
					},
					onLeaveBack: () => {
						if (i !== 0) {
						  gsap.to(card, { opacity: 0, yPercent: 35, duration: 0.5, ease: "power2.in" });
						}
					}
				});
			});
    });*/

  // Refresh on resize window
  window.addEventListener("resize", function() {
    console.log("resize");
    window.scrollTo(0,0);
    clearTimeout(window.resizeTimer);
    window.resizeTimer = setTimeout(() => {
      ScrollTrigger.refresh();
    }, 200);
  });

  document.addEventListener("DOMContentLoaded", function() {
    window.scrollTo(0,0);
    clearTimeout(window.resizeTimer);
    window.resizeTimer = setTimeout(() => {
      ScrollTrigger.refresh();
    }, 500);
  });
  </script>

<?php endif; ?>
