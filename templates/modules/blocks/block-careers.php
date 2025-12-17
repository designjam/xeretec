<section class="module-careers padding--md" role="complementary" id="careers" aria-label="Careers">
	<div class="container">
		<div class="row module-careers__row">
			<div class="col-md-12 offset-xl-1 col-xl-10">
				<div class="row module-careers__row">
					<?php foreach ($args['careers'] as $key => $card): ?>
						<div class="<?php if ($args['format'] === 'twocol'): echo "col-md-6"; elseif ($args['format'] === 'threecol'): echo "col-md-4"; endif; ?> module-careers__col">
							<div class="card">
								<?php if ($card['title']) : echo "<h3 class=\"zeta zeta--bold color--tertiary\">" . $card['title'] . "</h3>"; endif; ?>
								<?php if ($card['location']) : echo "<span class=\"icon icon--globe\">" . $card['location'] . "</span>"; endif; ?>
								<?php if ($card['salary']) : echo "<span class=\"icon icon--money\">" . $card['salary'] . "</span>"; endif; ?>
								<?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>
								<?php if ($card['link']) : echo "<a href=\"" . $card['link']['url'] . "\" class=\"btn btn--default\">" . $card['link']['title'] . "</a>"; else: ?>
									<a class="btn btn--default" href="mailto:info@xeretec.co.uk?Subject=Im interested in the following career at Xeretec: <?php echo $card['title']; ?>" aria-label="Email us to find out more about this career"><?php _e('Apply', 'Rouge'); ?></a>
								<?php endif; ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>