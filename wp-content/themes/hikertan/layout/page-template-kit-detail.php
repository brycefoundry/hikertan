<?php
/*
 * Template Name: Kit Template
 * Description: Page template without sidebar
 */


get_header(); ?>





<?php



$gallerycount = 0;
 	
?>	

<?php if( have_rows('kit_section') ):?>


	<?php while ( have_rows('kit_section') ) : the_row(); ?>
		
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

							    <?php include('template-parts/kits-media.php') ?>
							    <?php include('template-parts/kits-product.php') ?>
							  </div>
							  
							</div>
							<?php endif; ?>

							<?php if(get_sub_field('product_display')=='right'): ?>
							<div class="container">
							  <div class="row">
							  	<?php include('template-parts/post/content-kits-product.php') ?>
							     <?php include('template-parts/post/content-kits-media.php') ?>
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

			<?php the_content();?>
		
	
	<?php endwhile; ?>

<?php endif; ?>


<?php get_footer(); ?>