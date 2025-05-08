<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package CEC_Paywall_Theme
 */

get_header();
?>

<div class="flex flex-wrap lg:flex-row">
	<main id="primary" class="site-main w-full lg:w-3/4 lg:pr-8">

		<?php if ( have_posts() ) : ?>

			<header class="page-header bg-white rounded-lg shadow-sm p-6 mb-8">
				<h1 class="page-title text-2xl font-bold text-gray-800">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'cec-paywall-theme' ), '<span class="text-blue-600">' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			echo '<nav class="pagination flex justify-center my-8">';
			echo paginate_links( array(
				'prev_text' => '<span class="inline-flex items-center px-4 py-2 mr-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">&laquo; ' . __('Previous', 'cec-paywall-theme') . '</span>',
				'next_text' => '<span class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">' . __('Next', 'cec-paywall-theme') . ' &raquo;</span>',
				'class' => 'inline-flex items-center px-4 py-2 mx-1 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50',
			) );
			echo '</nav>';

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

	<?php get_sidebar(); ?>
</div>

<?php
get_footer();