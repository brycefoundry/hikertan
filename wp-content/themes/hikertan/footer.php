	</main>




			<!-- footer -->
			<footer class="footer" role="contentinfo">
				<div class="container">
				  <div class="row">

				    
				    <div class="col-sm resources">
				    	<h6>Latest News</h6>
				    	<ul>
				    	<?php
				    	    $args = array(
				    	        'post_type' => 'post'
				    	    );

				    	    $post_query = new WP_Query($args);
				    	if($post_query->have_posts() ) {
				    	  while($post_query->have_posts() ) {
				    	    $post_query->the_post();
				    	    ?>
				    	   
				    	    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
				    	    <?php
				    	  }
				    	}
				    	?>

				      </ul>
				      
				      
				    </div>
				    
				     <div class="col-sm">
				      <h6>Resources</h6>
				      <ul>
				      	<li><a href="/">Frequently Asked Questions</a></li>
				      	<li><a href="/">Delivery Information</a></li>
				      	<li><a href="/">Terms of Service</a></li>
				      	<li><a href="/">Privacy</a></li>
				      </ul>
				      
				      
				      
				      
				    </div>
				    <div class="col-sm latest">
				    	<h6>Call</h6>
				    	<p>512.298.4060</p>
				    	<hr>
				    	<h6>Mailing</h6>
				    	<p>2028 E Ben White Blvd<br />Suite 240-3350<br />Austin, Texas 78741</p>
				    	<hr>
				    	<h6>Find Us</h6>

				      <span class="social-icons">
				      	<a href="http://instagram.com/hikertan"><i class="fab fa-instagram"></i></a>
				      	<a href=""><i class="fab fa-facebook-f"></i></a>
				      	<a href="http://twitter.com/hikertan"><i class="fab fa-twitter"></i></a>
	
				      </span>
				      <br/>
				      <a class="btn btn-dark" href="#" role="button">Email</a>
				    </div>
				  </div>
				</div>
				

			</footer>
			
			<!-- /footer -->

		</div>
		<!-- /wrapper -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128668221-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-128668221-1');
		</script>

		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</body>
</html>
