    <div class="col-sm">
      <?php if(get_sub_field('product_gallery_select')=='gallery'): ?>
      	<!-- Gallery Image -->
            
           
            
      	<div id="carouselExampleIndicators-<?php echo $gallerycount; ?>" class="carousel slide" data-ride="carousel">
      	  <ol class="carousel-indicators">
      	  	

            <!-- Dots and Indicators -->
      	<?php

      	$tabcount = 0;
      	 	
      	?>
      	 	<?php if( have_rows('product_gallery') ):?>
      	  		<?php while ( have_rows('product_gallery') ) : the_row(); ?>
      	  		
	      	    	<li data-target="#carouselExampleIndicators-<?php echo $gallerycount; ?>" data-slide-to="<?php echo $tabcount; ?>" class="active"></li>
	      	    
     	   		 <?php $tabcount++;?>
      	    	<?php endwhile; ?>

      	    <?php endif; ?>`
      	  </ol>
      	  <!-- End Dots -->

      	  


              <!-- Slides -->

      	  <?php
      	  	//Reset count
      	  	$tabcount = 0;
      	  	
      	  ?>

      	  <div class="carousel-inner">
      	  	<?php if( have_rows('product_gallery') ):?>
      	  	<?php while ( have_rows('product_gallery') ) : the_row(); ?>

      	  		 <?php if($tabcount==0): ?>
      	  				<div class="carousel-item active">
      	  				  <img class="d-block w-100" src="<?php the_sub_field( 'gallery_image');?>">
      	  				</div>
      	  		 <?php endif; ?>

      	  		  <?php if($tabcount>0): ?>
		      	    <div class="carousel-item">
		      	      <img class="d-block w-100" src="<?php the_sub_field( 'gallery_image');?>">
		      	    </div>
	      	   	 <?php endif; ?>
	      	    <?php $tabcount++;?>

	      	    
      	    <?php endwhile; ?>

      	    <?php endif; ?>
      	   
      	  </div>

      	  <!-- End Slides -->








      	  <!-- Controls -->

      	  <a class="carousel-control-prev" href="#carouselExampleIndicators-<?php echo $gallerycount; ?>" role="button" data-slide="prev">
      	    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      	    <span class="sr-only">Previous</span>
      	  </a>
      	  <a class="carousel-control-next" href="#carouselExampleIndicators-<?php echo $gallerycount; ?>" role="button" data-slide="next">
      	    <span class="carousel-control-next-icon" aria-hidden="true"></span>
      	    <span class="sr-only">Next</span>
      	  </a>
      	  <!-- End Controls -->
      	</div>
      	<!-- End Gallery Image -->
      <?php endif; ?>
      

      
      <?php if(get_sub_field('product_gallery_select')=='single'): ?>
      	

            <div id="carouselExample-<?php echo $gallerycount; ?>" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="<?php the_sub_field( 'single_image');?>" alt="First slide">
                </div>
                
              </div>
            </div>
      	<!-- Start Single Image -->
      <?php endif; ?>

    </div>

     <?php $gallerycount++; ?>