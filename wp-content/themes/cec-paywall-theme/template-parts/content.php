<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CEC_Paywall_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-md overflow-hidden mb-8 prose mx-auto min-w-fit') ?>>
	<header class="entry-header p-6 bg-gray-50 border-b">
		<?php
		if (is_singular()) :
			the_title('<h1 class="entry-title text-3xl font-bold text-gray-800">', '</h1>');
		else :
			the_title('<h2 class="entry-title text-2xl font-bold"><a class="text-blue-700 hover:text-blue-900" href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
		endif;

		if ('post' === get_post_type()) :
		?>
			<div class="entry-meta text-sm text-gray-600 mt-2">
				<?php
				cec_paywall_theme_posted_on();
				cec_paywall_theme_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php
	if (has_post_thumbnail()) :
		echo '<div class="post-thumbnail-container overflow-hidden">';
		cec_paywall_theme_post_thumbnail();
		echo '</div>';
	endif;
	?>

	<div class="entry-content p-6">
		<?php
		// Paywall Gate Logic
		$required_role = get_post_meta(get_the_ID(), '_cec_post_access_role', true);
		$current_user = wp_get_current_user();
		$can_access = false;

		if (empty($required_role)) { // Public content
			$can_access = true;
		} else {
			$user_roles = (array) $current_user->roles;
			if (in_array('administrator', $user_roles)) { // Admins can always access
				$can_access = true;
			} else {
				switch ($required_role) {
					case 'free_reader':
						if (in_array('free_reader', $user_roles) || in_array('paid_reader', $user_roles) || in_array('premium_reader', $user_roles)) {
							$can_access = true;
						}
						break;
					case 'paid_reader':
						if (in_array('paid_reader', $user_roles) || in_array('premium_reader', $user_roles)) {
							$can_access = true;
						}
						break;
					case 'premium_reader':
						if (in_array('premium_reader', $user_roles)) {
							$can_access = true;
						}
						break;
				}
			}
		}

		if ($can_access) {
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'cec-paywall-theme'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
		} else {
			// Display excerpt with styled paywall message
			echo '<div class="prose max-w-none mb-8">';
			the_excerpt();
			echo '</div>';

			echo '<div class="paywall-message bg-gray-100 border border-gray-300 rounded-lg p-6 my-8">';
			echo '<h3 class="text-xl font-bold text-gray-800 mb-3">' . esc_html__('Premium Content', 'cec-paywall-theme') . '</h3>';
			echo '<p class="mb-4">' . esc_html__('This content is restricted. Please subscribe or log in to view the full article.', 'cec-paywall-theme') . '</p>';

			// Add subscription/login buttons
			echo '<div class="flex flex-wrap gap-4">';
			if (!is_user_logged_in()) {
				echo '<a href="' . esc_url(wp_login_url(get_permalink())) . '" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition-colors">' . esc_html__('Log In', 'cec-paywall-theme') . '</a>';
				echo '<a href="' . esc_url(wp_registration_url()) . '" class="inline-block bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded transition-colors">' . esc_html__('Sign Up', 'cec-paywall-theme') . '</a>';
			} else {
				echo '<p class="text-sm text-gray-600">' . sprintf(esc_html__('Your current role: %s', 'cec-paywall-theme'), ucfirst(str_replace('_', ' ', $current_user->roles[0]))) . '</p>';
				echo '<p class="text-sm text-gray-600">' . sprintf(esc_html__('Required role: %s', 'cec-paywall-theme'), ucfirst(str_replace('_', ' ', $required_role))) . '</p>';
				echo '<a href="#" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition-colors">' . esc_html__('Upgrade Account', 'cec-paywall-theme') . '</a>';
			}
			echo '</div>';
			echo '</div>';
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__('Pages:', 'cec-paywall-theme'),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer p-6 bg-gray-50 border-t text-sm">
		<?php cec_paywall_theme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->