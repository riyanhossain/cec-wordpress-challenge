<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CEC_Paywall_Theme
 */

?>

	<footer id="colophon" class="site-footer bg-gray-800 text-white py-8 mt-12">
		<div class="site-info container mx-auto px-4 flex flex-col md:flex-row justify-between items-center">
			<div class="mb-4 md:mb-0">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'cec-paywall-theme' ) ); ?>" class="text-blue-300 hover:text-blue-100 transition-colors">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'cec-paywall-theme' ), 'WordPress' );
					?>
				</a>
			</div>
			
			<div>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'cec-paywall-theme' ), 'CEC Paywall Theme', '<a href="Your Website" class="text-blue-300 hover:text-blue-100 transition-colors">Your Name</a>' );
				?>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
