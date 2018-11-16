<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage twia
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<section class='hp-masthead'>
	<div class="jumbotron" style="">
		<div class="container">
	  <h1 class="display-4">Make your next adventure epic.</h1>
	  <p class="lead">Hiker Tan is an outdoors outfitter specializing in Ultra Light gear, apparel, and accesories. View some of our specially crafted kits today to get you on the trail in no time.</p>
	  <a class="btn btn-dark btn-lg" href="/shop/" role="button">Shop Gear</a>
	  <a class="btn btn-primary btn-lg" href="/our-kits/" role="button">Shop Kits</a>

	  </div>
	  <div class="video-container">
	  <video autoplay muted loop>
	    <source src="/wp-content/themes/hikertan/assets/video/epic-cover.mp4" type="video/mp4">
	    <source src="" type="video/ogg">
	    <source src="" type="video/webm">
	  Your browser does not support the video tag.
	  </video>
	  </div>
	</div>
</section>


<section class="featured-kits">
	<div class="container">
		<h3>Featured Kits</h3>
		<div class="kit-listing-container">
			<div class="container">
			  

		  	<?php
		  	    $loop = new WP_Query( array( 'post_type' => 'kits','paged' => $paged ) );
		  	    if ( $loop->have_posts() ) :
		  	        while ( $loop->have_posts() ) : $loop->the_post(); ?>
		  	        	<div class="card-module">
		  	            <div class="card <?php echo get_the_title(); ?>" style="background-image:url('<?php the_field( 'card_cover');?>');">
		  	                	<div class="card-content">		  	                
		  	                    <h2><?php echo get_the_title(); ?></h2>
		  	                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Get Started</a>
		  	                	</div>
		  	            </div>
		  	        	</div>
		  	        <?php endwhile;
		  	        
		  	    endif;
		  	    wp_reset_postdata();
		  	?>

			    
			    
			  
			</div>

			

							
		</div>
	</div>
</section>

<section class="featured-reports">
	<div class="container">	<h3>Featured Reports</h3>


		<div class="report-listing-container">
			<div class="container">
				<?php
				    $loop = new WP_Query( array( 'post_type' => 'field_reports','paged' => $paged ) );
				    if ( $loop->have_posts() ) :
				        while ( $loop->have_posts() ) : $loop->the_post(); ?>
				        	<div class="card-module">
				            <div class="card <?php echo get_the_title(); ?>" style="background-image:url('<?php the_field( 'card_cover');?>');">
				                	<div class="card-content">		  	                
				                    <h2><?php echo get_the_title(); ?></h2>
				                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Get Started</a>
				                	</div>
				            </div>
				        	</div>
				        <?php endwhile;
				        
				    endif;
				    wp_reset_postdata();
				?>
			</div>
		</div>
	</div>

</section>
			
			<div class="container">
				<hr>
			</div>
<section class="featured-category">
	<div class="container">
	<h2>Outdoor Tech</h2>
	<p>Ut laoreet efficitur sollicitudin. Curabitur volutpat, nisi posuere ultrices porta, nisi mauris tempor mauris, in luctus lorem nisl porta ipsum. </p>
	<?php
	echo do_shortcode( ' [wps_products add-to-cart="true" tags="tech" limit="3" order="price"] ' );
	?>
	</div>
</section>

<section class="featured-category">
	<div class="container">
	<h2>Pack Essentials</h2>
	<p>Ut laoreet efficitur sollicitudin. Curabitur volutpat, nisi posuere ultrices porta, nisi mauris tempor mauris, in luctus lorem nisl porta ipsum. </p>
	<?php
	echo do_shortcode( ' [wps_products add-to-cart="true" tags="essentials" limit="3" order="price"] ' );
	?>
	</div>
</section>

<section class="featured-category">
	<div class="container">
	<h2>Multi-Day Trips</h2>
	<p>Ut laoreet efficitur sollicitudin. Curabitur volutpat, nisi posuere ultrices porta, nisi mauris tempor mauris, in luctus lorem nisl porta ipsum. </p>
	<?php
	echo do_shortcode( ' [wps_products add-to-cart="true" tags="advanced" limit="3" order="price"] ' );
	?>
	</div>
</section>
		
		

<?php wp_footer(); ?>
<?php get_footer(); ?>