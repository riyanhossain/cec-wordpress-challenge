<?php

/**
 * The template for displaying all pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CEC_Paywall_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
	<div class="container mx-auto px-4">
		<?php
		while (have_posts()) :
			the_post();
		?>

			<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden mb-8 prose'); ?>>
				<header class="entry-header p-6 bg-gray-50 border-b">
					<?php the_title('<h1 class="entry-title text-3xl font-bold text-gray-800">', '</h1>'); ?>
				</header>

				<!-- .entry-header -->

				<?php if (has_post_thumbnail()) : ?>
					<div class="post-thumbnail-container overflow-hidden">
						<?php the_post_thumbnail('full', ['class' => 'w-full h-auto object-cover']); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content p-6 prose max-w-none">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links mt-4 p-4 bg-gray-100 rounded">' . esc_html__('Pages:', 'cec-paywall-theme'),
							'after'  => '</div>',
						)
					);
					?>
				</div>
				<!-- .entry-content -->

				<?php if (get_edit_post_link()) : ?>
					<footer class="entry-footer p-6 bg-gray-50 border-t text-sm">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__('Edit <span class="sr-only">%s</span>', 'cec-paywall-theme'),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							),
							'<span class="edit-link text-blue-600 hover:text-blue-800">',
							'</span>'
						);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>
			</article><!-- #post-<?php the_ID(); ?> -->

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				echo '<div class="bg-white rounded-lg shadow-md overflow-hidden mb-8 p-6">';
				comments_template();
				echo '</div>';
			endif;

		endwhile; // End of the loop.
		?>
	</div>
</main><!-- #main -->

<?php
get_footer();
