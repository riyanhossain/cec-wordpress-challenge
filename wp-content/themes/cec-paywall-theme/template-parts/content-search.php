<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CEC_Paywall_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-sm overflow-hidden mb-6 hover:shadow-md transition-shadow'); ?>>
	<div class="flex flex-col sm:flex-row">
		<?php if (has_post_thumbnail()) : ?>
			<div class="post-thumbnail sm:w-1/4">
				<a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
				</a>
			</div>
		<?php endif; ?>
		
		<div class="p-4 <?php echo has_post_thumbnail() ? 'sm:w-3/4' : 'w-full'; ?>">
			<header class="entry-header mb-3">
				<?php the_title( sprintf( '<h2 class="entry-title text-xl font-bold"><a class="text-blue-700 hover:text-blue-900" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<?php if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta text-sm text-gray-600 mt-2">
					<?php
					cec_paywall_theme_posted_on();
					cec_paywall_theme_posted_by();
					?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->

			<div class="entry-summary text-gray-700">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

			<footer class="entry-footer mt-3">
				<a href="<?php the_permalink(); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-800">
					<?php esc_html_e('Read More', 'cec-paywall-theme'); ?>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
					</svg>
				</a>
			</footer><!-- .entry-footer -->
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->