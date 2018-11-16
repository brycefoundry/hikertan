<?php
/**
 * Template part for displaying posts with excerpts
 *
 * Used in Search Results and for Recent Posts in Front Page panels.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Hiker Tan
 * @since 1.0
 * @version 1.2
 */

?>

<?php

$gallerycount = 0;

?>	


<?php if( have_rows('report_section') ):?>


	<?php while ( have_rows('report_section') ) : the_row(); ?>
		
			<section class="<?php the_sub_field('section_type')?> <?php the_sub_field('product_display')?> <?php the_sub_field('product_gallery_select')?>" style="background-color:<?php the_sub_field( 'background_color');?>; background-image:url('<?php the_sub_field( 'cover_image');?>');">
						
					<?php if(get_sub_field('section_type')=='wysiwyg'): ?>
						<!-- Wysiwyg -->

						<div class="container">
						  
								<?php the_sub_field('wysiwyg')?>			    
						  
						</div>

						<!-- End Wysiwyg -->


					<?php endif; ?>
					<?php if(get_sub_field('section_type')=='masthead'): ?>
						<!-- Masthead -->

						<div class="container">
						  <div class="row">
						    <div class="col-sm">
						      <h1><?php the_sub_field('headline')?></h1>
						      <p><?php the_sub_field('description')?></p>

						      	<?php 
						      	$link = get_sub_field('masthead_call_to_action');
						      	if($link):?>
								<button class="btn btn-primary" data-toggle="modal" data-target="#guarantee" href="<?php echo $link['url']; ?>" role="button"><?php echo $link['title']; ?></button>
						      	<?php endif;?>
   					     
						    </div>
						    <div class="col-sm">
						     	<!--Empty-->
						    </div>
						  </div>
						</div>

						<!-- End Masthead -->


						<div class="video">
							<video autoplay muted loop>
							  <source src="<?php the_sub_field('cover_video_mp4'); ?>" type="video/mp4">
							  <source src="<?php the_sub_field('cover_video_ogg'); ?>" type="video/ogg">
							  <source src="<?php the_sub_field('cover_video_webm'); ?>" type="video/webm">
							Your browser does not support the video tag.
							</video>
							
						</div>
					<?php endif; ?>


					
					<?php if(get_sub_field('section_type')=='product'): ?>
						<!-- Products -->

							<?php if(get_sub_field('product_display')=='left'): ?>
							<div class="container">
							  <div class="row">
							    <?php include('content-kits-media.php') ?>
							    <?php include('content-kits-product.php') ?>
							  </div>
							  
							</div>
							<?php endif; ?>

							<?php if(get_sub_field('product_display')=='right'): ?>
							<div class="container">
							  <div class="row">
							  	<?php include('content-kits-product.php') ?>
							     <?php include('content-kits-media.php') ?>
							  </div>
							  
							</div>
							<?php endif; ?>

						<!-- End Products -->

					<?php endif; ?>



					

					<?php if(get_sub_field('section_type')=='collection'): ?>
						<!-- Collections -->
						<div class="container">
							<?php if(get_sub_field('collection_sub_select')=='on'): ?>
						 		<h3><?php the_sub_field('collection_subheader')?></h3>
						 	<?php endif;?>


						  	

						  	<div class="collecton-list">

						  	<?php if( have_rows('collection_list') ):?>
						  		 
						  		<?php while ( have_rows('collection_list') ) : the_row(); ?>
						  			<a href="<?php the_sub_field( 'in_page_anchor');?>" class="product-collection-item">
						  				<h6 style="background-image:url('<?php the_sub_field( 'product_thumbnail');?>');"><?php the_sub_field('product_name')?></h6>

						  			</a>	
						
						  		<?php endwhile; ?>
	  		

							<?php endif; ?>
						   	</div> 
						  
						</div>

						<div class="container all-price">
							<div class="row">
							  <div class="col-sm-8"><h2><?php the_sub_field('headline')?></h2></div>
							  <div class="col-sm-4">
							  	<div class="container">
							  	  <div class="row">
							  	    
							  	    <div class="col">
							  	      <a class="btn btn-primary" href="/" role="button">Add All to Cart</a>
							  	    </div>
							  	    <div class="col">
							  	      <span class="price"><?php the_sub_field('collection_price')?></span>
							  	      <span class="shipping">+Free Shipping</span>
							  	    </div>
							  	  </div>
							  	</div>
							  </div>
							</div>
						</div>

						<!-- End Collections -->

					<?php endif; ?>




					

					<?php if(get_sub_field('section_type')=='callout'): ?>
						<!-- Callouts -->
						<div class="container">
						  <div class="row">
						    <div class="col-sm">
						     	<h1><?php the_sub_field( 'headline');?></h1>
						     	<p><?php the_sub_field( 'description');?></p>
						    </div>
						    <div class="col-sm">
						     
						    </div>
						  </div>
						 
						</div>
						

					<?php endif; ?>

					<?php if(get_sub_field('section_type')=='fieldtesting_items'): ?>
						<?php
							$sectionHeadline = get_sub_field( 'headline' );
						?>
						<div class="container fieldtesting">
						  <div class="row">
						   	<div class="heading">
						    	<h3><?php echo $sectionHeadline; ?></h3>
						   	</div>
						  </div>
						  <div class="row">
						  	<!-- Field Testing Menu Repeater -->
						  	<?php if ( have_rows('fieldtesting_items') ): ?>
						  		<div class="row d-inline-flex fieldtesting_menu">
						  		<?php 
						  			# Counter for the loop to find first item
						  			$row = 0;

						  			while ( have_rows('fieldtesting_items') ): the_row();
						  			$expanded = 'false';
						  			$button_text  = get_sub_field('fieldtesting_button_text');
						  			$button_ident = get_sub_field('fieldtesting_ident');

						  			if ( $row == 0 ): 
						  				$expanded = 'true';
						  			endif;
						  		?>
						 			<div class="col-sm menu_container">
						    			<a class="fieldtesting_link" data-toggle="collapse" href="#<?php echo $button_ident; ?>" role="button" aria-expanded="<?php echo $expanded; ?>" aria-controls="<?php echo $button_ident; ?>"><?php echo $button_text; ?></a>
						    		</div>
						    	<?php $row++; endwhile; ?>
						    	</div>
						    <?php endif; ?>
						  </div>
						  <div id="fieldtesting-content" class="row card-area">
						  	<?php if ( have_rows('fieldtesting_items') ): ?>
						  		<?php 
						  			# Counter for the loop to find first item
						  			$row = 0;

						  			while ( have_rows('fieldtesting_items') ): the_row();
						  			$shown = '';
						  			$inner_heading = get_sub_field('fieldtesting_item_heading');
						  			$inner_text    = get_sub_field('fieldtesting_item_text');
						  			// $inner_img     = get_sub_field('fieldtesting_item_image');
						  			$inner_img_alt = get_sub_field('fieldtesting_item_image_alt');
						  			$button_ident  = get_sub_field('fieldtesting_ident');

						  			if ( $row == 0 ): 
						  				$shown = 'show';
						  			endif;

						  			# Process Images
						  			# Process images into temporary array
						  			 
					  				$imageArr = [];
					  				while ( have_rows('fieldtesting_item_image') ): the_row();
					  					$images = get_sub_field('fieldtesting_item_repeater_image');
					  					if(!empty($images)){
					  						$imageArr[] = $images;
					  					}
					  				endwhile;
					  				

								?>
								<!-- <div class="col-sm-12"> -->
								  	<div class="container collapse multi-collapse <?php echo $shown; ?>" id="<?php echo $button_ident; ?>">
								    	<div class="card card-body">
								    		<div class="row">
								      			<div class="col-sm">
								      				<div class="textarea">
								      					<h2><?php echo $inner_heading; ?></h2>
								      					<p><?php echo $inner_text; ?></p>
								      				</div>
								      			</div>
								      			<div class="col-sm">
								      				<!-- Image Slider? Not sure how to do that yet so single image for now -->
								      				
								      				<?php if ( count($imageArr) == 1 ):
								      					$inner_img = $imageArr[0]; ?>
								      					<img src="<?php echo $inner_img; ?>" alt="<?php echo $inner_alt_alt; ?>" class="img-fluid">
								      				<?php else: ?>

								      					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
								      					  	<ol class="carousel-indicators">
								      					  	<?php $count=0; while ( have_rows('fieldtesting_item_image') ): the_row(); ?>
								      					  	  <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $count; ?>" <?php if($count == 0): echo 'class="active"'; endif; ?>></li>
								      					  	<?php $count++; endwhile; ?>
								      					  	</ol>
								      					  	<div class="carousel-inner">
									      					<?php $count=0; while ( have_rows('fieldtesting_item_image') ): the_row(); ?>
									      					    <div class="carousel-item <?php if($count == 0): echo 'active'; endif; ?>">
									      					      <img class="d-block w-100" src="<?php echo get_sub_field('fieldtesting_item_repeater_image'); ?>" alt="<?php echo $inner_img_alt; ?>">
									      					    </div>	  
										      				<?php $count++; endwhile; ?>
										      				</div>
										      				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
										      					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
										      					<span class="sr-only">Previous</span>
										      				</a>
										      				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
										      					<span class="carousel-control-next-icon" aria-hidden="true"></span>
										      					<span class="sr-only">Next</span>
										      				</a>
										      			</div>
								      				<?php endif; ?>
								      			</div>
								      		</div>
								    	</div>
								  	</div>
								<!-- </div> -->
								<?php $row++; endwhile; ?>
							<?php endif; ?>
						  </div>
						</div>
						

					<?php endif; ?>

					<?php if(get_sub_field('section_type')=='whyyoullloveit'): ?>
						<?php
							$sectionHeadline = get_sub_field( 'headline' );
						?>
						<!-- Why You'll Love It -->
						<?php if( have_rows('whyyoullloveit') ): ?>

							<div class="container">
							  <div class="row">
							   	<div class="heading">
							    	<h3><?php echo $sectionHeadline; ?></h3>
							   	</div>
							  </div>
							  <div class="row">
								<?php while( have_rows('whyyoullloveit') ): the_row(); 

								// vars
								$blurb = get_sub_field('blurb');
								$name  = get_sub_field('name');
								$p_img = get_sub_field('person_image');
								$p_alt = get_sub_field('person_alt');

								?>

								<div class="col-sm whytheyloveit">
									<div class="row whyyoullboxshadow">
							    		<div class="col-sm-3">
							    			<img src="<?php echo $p_img; ?>" alt="<?php echo $p_alt; ?>" class="rounded-circle persona">
							    		</div>
							    		<div class="col-sm">
											<div class="row">
												<div class="col-sm quote">
													<?php echo $blurb; ?>
												</div>
											</div>
											<div class="row">
												<div class="col-sm name">
													<?php echo $name; ?>
												</div>
											</div>
							    		</div>
							    	</div>
						    	</div>
			
								<?php endwhile; ?>

								
							  </div>
							 
							</div>

						<?php endif; ?>

					<?php endif; ?>					
			
			</section>
		
			<!-- Modal -->
			<div class="modal fade" id="guarantee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Our Guarantee</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			       <?php 

			       $post_id = 59;

			       echo get_post_field('post_content', $post_id); ?>
			      </div>
			    
			    </div>
			  </div>
			</div>
		
	
	<?php endwhile; ?>

<?php endif; ?>


								
			
							
					

		
		
		
	


	


