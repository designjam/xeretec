<?php
$type = get_sub_field('components');

if( $type ) {
  $template_path = 'templates/components/global/' . $type;
  $located = locate_template($template_path . '.php');
  
  if( $located ) {
    get_template_part('templates/components/global/' . $type);
  } else {
    get_template_part('templates/components/global/placeholder');
  }
}
?>
