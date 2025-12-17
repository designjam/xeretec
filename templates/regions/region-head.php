<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->

<head>
	<?php if (!empty(get_field('gtm_head_tag', 'option'))) {
		echo get_field('gtm_head_tag', 'option');
	} ?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<title><?php echo wp_title('-', false, 'right'); ?></title>

	<link rel="preconnect"
		href="https://fonts.gstatic.com"
		crossorigin />

	<link rel="preload"
		as="style"
		href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;600;700;800&display=swap" />

	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;600;700;800&display=swap"
		media="print" onload="this.media='all'" />

	<noscript>
		<link rel="stylesheet"
			href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;600;700;800&display=swap" />
	</noscript>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php if (!empty(get_field('gtm_body_tag', 'option'))) {
		echo get_field('gtm_body_tag', 'option');
	} ?>