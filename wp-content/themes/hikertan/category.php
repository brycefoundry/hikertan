<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>
			<div class="container">
			<h1><?php _e( 'Categories for ', 'html5blank' ); single_cat_title(); ?></h1>

			<?php get_template_part('loop'); ?>

			<?php get_template_part('pagination'); ?>
		</div>
		</section>
		<!-- /section -->
	</main>



<?php get_footer(); ?>
