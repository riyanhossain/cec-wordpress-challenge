<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package CEC_Paywall_Theme
 */

?>

<?php
get_header();
?>

<div class="flex flex-wrap lg:flex-row">
	<main id="primary" class="site-main w-full max-w-2xl mx-auto">

		<?php
		while (have_posts()) :
			the_post();

			get_template_part('template-parts/content', get_post_type());

			// If comments are open or we have at least one comment, load up the comment template
			if (comments_open() || get_comments_number()) :
				echo '<div class="bg-white rounded-lg shadow-md overflow-hidden mb-8 p-6">';
				comments_template();
				echo '</div>';
			endif;

			// Post navigation
			the_post_navigation(
				array(
					'prev_text' => '<div class="text-sm text-gray-600 mb-1">' . esc_html__('Previous Post', 'cec-paywall-theme') . '</div><span class="text-lg font-medium text-blue-700 hover:text-blue-800">%title</span>',
					'next_text' => '<div class="text-sm text-gray-600 mb-1 text-right">' . esc_html__('Next Post', 'cec-paywall-theme') . '</div><span class="text-lg font-medium text-blue-700 hover:text-blue-800">%title</span>',
					'class' => 'post-navigation flex flex-col sm:flex-row justify-between gap-4 bg-white rounded-lg shadow-sm p-6 mb-8',
				)
			);

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
</div>

</div><!-- .page -->

<?php
get_footer();
