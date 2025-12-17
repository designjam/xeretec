<?php
    $args = array(
        'cardsrow' => [],
    );

    $multipleRows = get_field('rpt_support_tools');
    while(have_rows('rpt_support_tools')): the_row();
        $row = [
            'headline' => get_sub_field('fld_tools_headline'),
            'anchor' => sanitize_title(get_sub_field('fld_tools_headline')),
            'text' => get_sub_field('fld_tools_text'),
            'cards' => [],
        ];

        $multipleCards = get_sub_field('rpt_tools_cards');
        while(have_rows('rpt_tools_cards')): the_row();
            $card = [
	            'title' => get_sub_field('fld_tools_title'),
	            'text' => get_sub_field('fld_tools_text'),
	            'link' => get_sub_field('fld_tools_link'),
            ];

            $row['cards'][] = $card;
        endwhile;

        $args['cardsrow'][] = $row;

    endwhile;

    if ($args['cardsrow']):

    foreach ($args['cardsrow'] as $key => $row):
?>
	<section class="page-support" id="<?php echo $row['anchor']; ?>" role="region" aria-label="Support tools">
		<div class="container">
       		<div class="row module-products__row">
				<div class="offset-xl-1 col-xl-5">
					<div class="inner inner-spacing margin--basemd">
						<?php if ($row['headline']): ?><h2 class="delta delta--bold delta--uppercase"><?php echo preg_replace( '/\*\*(.*?)\*\*/', '<span>$1</span>', $row['headline']); ?></h2><?php endif; ?>
						<?php if ($row['text']) : echo "<p>" . $row['text'] . "</p>"; endif; ?>
					</div>
				</div>
		
				<div class="offset-xl-1 col-xl-10">
					<?php foreach ($row['cards'] as $key => $card): ?>
						<div class="inner inner-spacing">
							<?php if ($card['title']) : echo "<h3 class=\"zeta zeta--bold\">" . $card['title'] . "</h3>"; endif; ?>
							<?php if ($card['text']) : echo "<p>" . $card['text'] . "</p>"; endif; ?>
							<?php if($card['link']): ?>
								<a class="btn btn--default" href="<?php echo $card['link']['url']; ?>" target="<?php echo $card['link']['target']; ?>"><?php echo $card['link']['title']; ?></a>
							<?php endif; ?>
							<div class="divider"></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
<?php endforeach; endif; ?>