<?php if ($args['background']): ?>
	<div class="objectfit module-multiple-rows__background">
		<?php responsive_image($args['background']['id'],'100vw','1920px', 'parallax'); ?>
	</div>
<?php endif; ?>
<div class="container">
	<div class="row module-multiple-rows__row<?php if (!$args['background']): echo " flex-row-reverse"; endif; ?>">
		<div class="col-md-12 col-lg-4 <?php if (!$args['background']): echo "offset-xl-1 col-xl-3"; else: echo "col-xl-3"; endif; ?> margin--basemobile">
			<div class="inner inner-spacing">
				<?php if ($args['headline']): ?><h2 class="delta delta--bold delta--uppercase margin--topmd"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $args['headline']); ?></h2><?php endif; ?>
				<?php if ($args['excerpt']) : echo "<h3 class=\"zeta zeta--light\">" . $args['excerpt'] . "</h3>"; endif; ?>
				<?php if ($args['text']) : echo $args['text']; endif; ?>
				<?php if($args['link']): ?>
					<a class="btn <?php if (!$args['background']): echo "btn--default"; else: echo "btn--white"; endif; ?>" href="<?php echo $args['link']['url']; ?>" target="<?php echo $args['link']['target']; ?>" aria-label="Find out more about <?php echo preg_replace( '/\*\*(.*?)\*\*/', '$1', $args['headline']); ?>"><?php echo $args['link']['title']; ?></a>
				<?php endif; ?>
			</div>
		</div>
		<div class="col-md-12 col-lg-8 <?php if (!$args['background']): echo "col-xl-8"; else: echo "offset-xl-1 col-xl-8"; endif; ?>">
			<?php foreach ($args['cardsrow'] as $key => $row): ?>
				<div class="row module-multiple-rows__row margin--basesm">
					<?php if($row['title']): ?>
						<div class="col-md-12">
							<div class="inner inner-spacing">
								<?php echo "<h4 class=\"epsilon epsilon--bold epsilon--uppercase margin--basesm\">" . $row['title'] . "</h4>"; ?>
							</div>
						</div>
					<?php endif; ?>
					<div class="col-md-12">
						<div class="row module-multiple-rows__row">
							<?php foreach ($row['cards'] as $key => $card): ?>
								<div class="col-md-6 col-xl-3 module-multiple-rows__col">
									<div class="card">
										<?php if ($card['title']) : echo "<h5 class=\"zeta zeta--bold\">" . $card['title'] . "</h5>"; endif; ?>
										<?php if ($card['highlight']) : echo "<h6 class=\"delta delta--bold color--secondary fade-in\">" . $card['highlight'] . "</h6>"; endif; ?>
										<?php if ($card['text']) : echo "<div>" . $card['text'] . "</div>"; endif; ?>
										<?php if ($card['link']) :?>
											<a href="<?php echo $card['link']['url']; ?>" target="<?php echo $card['link']['target']; ?>"><?php echo $card['link']['title']; ?></a>
										<?php endif; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>