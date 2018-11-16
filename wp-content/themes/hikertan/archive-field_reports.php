<?php get_header(); ?>



			<section>
				
			
							<div class="container">
								<div class="row">
								  <div class="col-12 col-md-8"><h1>We tested our products so you don't have to.</h1></div>
								  <div class="col-6 col-md-4"></div>
								</div>
							</div>

							<div class="reportFor -listing-container">

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

							
						</section>





<?php get_footer(); ?>
