jQuery(document).ready(function($){
	
	// Fancy pixels-per-second scrolling to team sections
	// $('.menu-jump__link').on('click', function(e) {
	// 	e.preventDefault();

	// 	var currentScrollPos = $(window).scrollTop();
	// 	var hash = $(this).attr('href');
	// 	var $element = $(hash);
	// 	var elementOffset = $element.offset().top;

	// 	var distance = 0;

	// 	if( currentScrollPos > elementOffset ) {
	// 		distance = currentScrollPos - elementOffset;
	// 	}else{
	// 		distance = elementOffset - currentScrollPos;
	// 	}

	// 	var pixelsPerSecond = 1500;
	// 	var speed = ( distance / pixelsPerSecond ) * 1000;
			
	// 	jQuery('html, body').animate( { scrollTop: elementOffset - 60 }, speed );

	// });

	// Handle clicking on team cards
	jQuery('.module-team__grid').on('click', '.module-team__card', function() {
		
		$card = jQuery(this);

		if( !$card.hasClass('module-team__card--animating') ) {

			if( $card.hasClass('module-team__card--open') ) {
				team_dropdown_close( $card );
			}else{

				if( $('.module-team__card--open').length > 0 ) {

					$('.module-team__card--open').each(function() {
						team_dropdown_close( jQuery(this) );
					});

					setTimeout(function() {
						team_dropdown_open( $card );
					}, 600, $card);

				}else{

					team_dropdown_open( $card );

				}

			}
		
		}

	});

	// Handle dropdown 
	function team_dropdown_open( $card ) {
		$card.addClass('module-team__card--animating');

		jQuery(window).trigger('resize');

		var card_height = $card.innerHeight();
		var team_offset = $card.closest('.module-team__grid').offset().top;
		var card_offset = $card.offset().top;
		var card_offset_relative = $card.offset().top - team_offset;
		var $dropdown = $( '#' + $card.data('team_id') );
		var dropdown_height = $dropdown.find('.module-team__dropdown-content').innerHeight();

		$dropdown.css('height', '0');
		$dropdown.css('top', (card_height+card_offset_relative) + 'px');
		$card.removeClass('module-team__card--closed');
		$card.addClass('module-team__card--open');

		setTimeout(function() {

			$card.css('margin-bottom', dropdown_height + 'px');
			$dropdown.css('height', dropdown_height + 'px');

			$("html, body").animate(
				{scrollTop: ( (card_height+card_offset-150) + 'px')
			}, 600);

		}, 100, $card, $dropdown, card_height, team_offset);

		setTimeout(function() {
			$card.removeClass('module-team__card--animating');
			$dropdown.addClass('module-team__dropdown--open');
		}, 700, $card);

	}

	function team_dropdown_close( $card ) {
		$card.addClass('module-team__card--animating');

		jQuery(window).trigger('resize');

		$card.css('margin-bottom', '');

		var $dropdown = $( '#' + $card.data('team_id') );
		$dropdown.css('height', 0);

		$card.addClass('module-team__card--closed');
		$card.removeClass('module-team__card--open');

		setTimeout(function() {

			$dropdown.css('top', '');
			$card.removeClass('module-team__card--animating');
			$dropdown.removeClass('module-team__dropdown--open');

		}, 600, $card, $dropdown);

		jQuery(window).trigger('resize');

	}

	jQuery(window).on('resize', function() {
		jQuery('.module-team-card--open').each(function() {
			adjust_open_team_dropdown_height( jQuery(this) );
		});
	});

	function adjust_open_team_dropdown_height( $card ) {

		var card_height = $card.innerHeight();
		var team_offset = $card.closest('.module-team__grid').offset().top;
		var card_offset = $card.offset().top
		var card_offset_relative = $card.offset().top - team_offset;

		var $dropdown = $( '#' + $card.data('team_id') );
		var dropdown_height = $dropdown.find('.module-team__dropdown-content').innerHeight();

		$dropdown.css('top', (card_height+card_offset_relative) + 'px');
		$card.css('margin-bottom', dropdown_height + 'px');
		$dropdown.css('height', dropdown_height + 'px');

	}

});