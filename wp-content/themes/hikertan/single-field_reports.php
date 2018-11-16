<?php
/**
 * The template for displaying all Field Reports
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage twia
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>


					<?php
							// Start the loop.
							while ( have_posts() ) : the_post();

								// Include the single post content template.
								get_template_part( 'template-parts/post/content', 'report' );
				

								
								// End of the loop.
							endwhile;
							?>

			


<?php get_footer(); ?>
