<?php
/*
 * Template Name: Shop
 * Description: Page template without sidebar
 */


get_header(); ?>
<section class='hp-masthead'>
	<div class="jumbotron" style="">
		<div class="container">
	  <h1 class="display-4">Our Latest Collections</h1>
	  <p class="lead">Hiker Tan is an outdoors outfitter specializing in Ultra Light gear, apparel, and accesories. View some of our specially crafted kits today to get you on the trail in no time.</p>
	 
	  <a class="btn btn-secondary btn-lg" href="#" role="button">Outdoor Tech</a> <a class="btn btn-secondary btn-lg" href="#" role="button">Pack Essentials</a> <a class="btn btn-secondary btn-lg" href="#" role="button">Multi-Day Trips</a>
	  </div>

	</div>
</section>

<section>
	<div class="container">
	<h2>Outdoor Tech</h2>
	<p>Ut laoreet efficitur sollicitudin. Curabitur volutpat, nisi posuere ultrices porta, nisi mauris tempor mauris, in luctus lorem nisl porta ipsum. </p>
	<?php
	echo do_shortcode( ' [wps_products add-to-cart="true" tags="tech"] ' );
	?>
	</div>
</section>

<section>
	<div class="container">
	<h2>Pack Essentials</h2>
	<p>Ut laoreet efficitur sollicitudin. Curabitur volutpat, nisi posuere ultrices porta, nisi mauris tempor mauris, in luctus lorem nisl porta ipsum. </p>
	<?php
	echo do_shortcode( ' [wps_products add-to-cart="true" tags="essentials"] ' );
	?>
	</div>
</section>

<section>
	<div class="container">
	<h2>Multi-Day Trips</h2>
	<p>Ut laoreet efficitur sollicitudin. Curabitur volutpat, nisi posuere ultrices porta, nisi mauris tempor mauris, in luctus lorem nisl porta ipsum. </p>
	<?php
	echo do_shortcode( ' [wps_products add-to-cart="true" tags="advanced"] ' );
	?>
	</div>
</section>


<?php get_footer(); ?>
