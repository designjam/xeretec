jQuery(document).ready(function($){
	
	$('#play-video').on('click', function() {
		var modal = $('.video__modal');
		modal.addClass('open');
		// setTimeout(function() { 
		// 	modal.append('<iframe width="560" height="315" title="Play" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" src="https://www.youtube-nocookie.com/embed/RXSGIsY_KqA?controls=0&amp;modestbranding=1&amp;rel=0&amp;enablejsapi=1&amp;playsinline=1&amp;loop=1&amp;autoplay=1"></iframe>');
		// }, 50);
		setTimeout(function() { 
			modal.addClass('transition');
			$('#homevideo').trigger('play');
		}, 250);
	});

	function closeVideo() {
		var modal = $('.video__modal');
		modal.removeClass('open');
		modal.removeClass('transition');
		// modal.find('iframe').remove();
		$('#homevideo').trigger('pause');
		var video = document.querySelector('video');
		video.currentTime = 0;
	}

	$('.video__modal .close-modal').on('click', function() {
		closeVideo();
	});
	// When Esc is clicked pause the video and close the modal
	$(document).on('keyup',function(evt) {
	    if (evt.keyCode == 27) {
	       closeVideo();
	    }
	});

});