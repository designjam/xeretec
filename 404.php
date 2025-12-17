<?php
    get_template_part('templates/regions/region', 'head'); 
    get_template_part('templates/regions/region', 'header');
?>
    
<main id="content" role="main">

    <!-- CONTENT -->
    <?php echo get_template_part('templates/page', '404'); ?>

    <!-- SERVICES 2 -->
    <?php echo get_template_part('templates/modules/module', 'services-full'); ?>

</main>

<?php
    get_template_part('templates/regions/region', 'footer');
?>