<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' : '; } ?><?php bloginfo('name'); ?> : Ultra Light Camping : Austin, Texas</title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<link rel="apple-touch-icon-precomposed" sizes="57x57" href="/wp-content/themes/hikertan/assets/icons/apple-touch-icon-57x57.png" />
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="/wp-content/themes/hikertan/assets/icons/apple-touch-icon-114x114.png" />
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="/wp-content/themes/hikertan/assets/icons/apple-touch-icon-72x72.png" />
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="/wp-content/themes/hikertan/assets/icons/apple-touch-icon-144x144.png" />
		<link rel="apple-touch-icon-precomposed" sizes="60x60" href="/wp-content/themes/hikertan/assets/icons/apple-touch-icon-60x60.png" />
		<link rel="apple-touch-icon-precomposed" sizes="120x120" href="/wp-content/themes/hikertan/assets/icons/apple-touch-icon-120x120.png" />
		<link rel="apple-touch-icon-precomposed" sizes="76x76" href="/wp-content/themes/hikertan/assets/icons/apple-touch-icon-76x76.png" />
		<link rel="apple-touch-icon-precomposed" sizes="152x152" href="/wp-content/themes/hikertan/assets/icons/apple-touch-icon-152x152.png" />
		<link rel="icon" type="image/png" href="/wp-content/themes/hikertan/assets/icons/favicon-196x196.png" sizes="196x196" />
		<link rel="icon" type="image/png" href="/wp-content/themes/hikertan/assets/icons/favicon-96x96.png" sizes="96x96" />
		<link rel="icon" type="image/png" href="/wp-content/themes/hikertan/assets/icons/favicon-32x32.png" sizes="32x32" />
		<link rel="icon" type="image/png" href="/wp-content/themes/hikertan/assets/icons/favicon-16x16.png" sizes="16x16" />
		<link rel="icon" type="image/png" href="/wp-content/themes/hikertan/assets/icons/favicon-128.png" sizes="128x128" />
		<meta name="application-name" content="&nbsp;"/>
		<meta name="msapplication-TileColor" content="#FFFFFF" />
		<meta name="msapplication-TileImage" content="/wp-content/themes/hikertan/assets/icons/mstile-144x144.png" />
		<meta name="msapplication-square70x70logo" content="/wp-content/themes/hikertan/assets/icons/mstile-70x70.png" />
		<meta name="msapplication-square150x150logo" content="/wp-content/themes/hikertan/assets/icons/mstile-150x150.png" />
		<meta name="msapplication-wide310x150logo" content="/wp-content/themes/hikertan/assets/icons/mstile-310x150.png" />
		<meta name="msapplication-square310x310logo" content="/wp-content/themes/hikertan/assets/icons/mstile-310x310.png" />


		<?php wp_head(); ?>
		

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">

			<!-- header -->
			<header class="header" role="banner">
				<div class="inner">
					<button id="menu-btn">
						<span class="icon"></span>
					</button>
					<a href="/" class="logo">
						
					</a>


					<ul>
						
						<li><a href="/our-kits/">Our Kits</a></li>
						<li><a href="/field-reports/">Field Reports</a></li>
						<li><a href="/shop/">Shop</a></li>

					</ul>


					<div class="shopping-cart">

											<?php echo do_shortcode( ' [wps_cart] ' );?>
											
											<h6>Items</h6>

										</div>
				<div>
					

			</header>
			<!-- /header -->

			<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
