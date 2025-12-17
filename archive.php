<?php
    get_template_part('templates/regions/region', 'head'); 
    get_template_part('templates/regions/region', 'header');
?>
    
<main id="content">
	<?php 
		echo get_template_part('templates/archive', 'default'); 
	?>
</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>