<?php get_header(); ?>

	<main role="main">
	<!-- section -->
	<section>
		

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		
			<div class="container">
			<!-- post thumbnail -->
			
			<!-- /post thumbnail -->

			<!-- post title -->
			<h1>
				<?php the_title(); ?>
			</h1>
			<!-- /post title -->

			<!-- post details -->
			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			
			
			<!-- /post details -->

			<?php the_content(); // Dynamic Content ?>

	

			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

			
		</div>

		
		<!-- /article -->

	<?php endwhile; ?>

	<?php else: ?>

		<!-- article -->
		
		<div class="container">
			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
		</div>
		
		<!-- /article -->

	<?php endif; ?>

	</section>
	<!-- /section -->
	</main>


<?php get_footer(); ?>
