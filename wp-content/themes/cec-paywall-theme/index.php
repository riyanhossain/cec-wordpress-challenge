<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
		if (have_posts()) :

			if (is_home() && ! is_front_page()) :
		?>
				<header class="mb-6">
					<h1 class="page-title text-3xl font-bold text-gray-800 screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php
			endif;

			/* Start the Loop */
			while (have_posts()) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
			?>
				<div class="entry-header p-6 bg-gray-50 border-b">
					<?php

					the_title('<h2 class="entry-title text-2xl font-bold"><a class="text-blue-700 hover:text-blue-900" href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');

					if ('post' === get_post_type()) :
					?>
						<div class="entry-meta text-sm text-gray-600 mt-2">
							<?php
							cec_paywall_theme_posted_on();
							cec_paywall_theme_posted_by();
							?>
						</div><!-- .entry-meta -->
					<?php endif; ?>
				</div>


		<?php

			// get_template_part('template-parts/content', get_post_type());

			endwhile;

			echo '<nav class="pagination flex justify-center my-8">';
			echo paginate_links(array(
				'prev_text' => '<span class="inline-flex items-center px-4 py-2 mr-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">&laquo; ' . __('Previous', 'cec-paywall-theme') . '</span>',
				'next_text' => '<span class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">' . __('Next', 'cec-paywall-theme') . ' &raquo;</span>',
				'class' => 'inline-flex items-center px-4 py-2 mx-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50',
			));
			echo '</nav>';


		else :

			get_template_part('template-parts/content', 'none');

		endif;
		?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
</div>
</div><!-- #page -->
<?php
get_footer();
