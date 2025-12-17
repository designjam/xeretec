<div class="share" role="complementary" aria-label="Share this article">
	<a role="button" role="button" href="JavaScript:newPopup('https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink();?>');" class="share__link"><img class="share__icon" src="<?php bloginfo('template_url'); ?>/assets/images/facebook-primary.svg" alt="Facebook logo"></a>
	<a role="button" role="button" href="JavaScript:newPopup('http://twitter.com/intent/tweet?url=<?php the_permalink();?>&text=<?php the_title();?> by Xeretec ');" class="share__link"><img class="share__icon" src="<?php bloginfo('template_url'); ?>/assets/images/twitter-primary.svg" alt="Twitter logo"></a>
	<a role="button" href="JavaScript:newPopup('https://www.linkedin.com/cws/share?url=<?php the_permalink();?>');" class="share__link"><img class="share__icon" src="<?php bloginfo('template_url'); ?>/assets/images/linkedin-primary.svg" alt="LinkedIn logo"></a>
	<a role="button" class="share__link" href="mailto:?subject=Hey%2C%20checkout%20this%20link!&body=<?php the_permalink();?>"><img class="share__icon" src="<?php bloginfo('template_url'); ?>/assets/images/email-primary.svg" alt="Email icon"></a>
</div>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/clipboard.min.js"></script>
<script>
var clipboard = new ClipboardJS('.link');
</script>