<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CEC_Paywall_Theme
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area w-full lg:w-1/4 lg:pl-8 mt-8 lg:mt-0">
	<div class="bg-white rounded-lg shadow-sm p-6">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</div>
	
	<?php if(!is_user_logged_in()): ?>
	<div class="bg-blue-50 border border-blue-100 rounded-lg shadow-sm p-6 mt-8">
		<h3 class="text-xl font-bold text-blue-800 mb-3"><?php esc_html_e('Join Our Community', 'cec-paywall-theme'); ?></h3>
		<p class="mb-4"><?php esc_html_e('Register to access premium content and join our community.', 'cec-paywall-theme'); ?></p>
		<div class="flex flex-wrap gap-2">
			<a href="<?php echo esc_url(wp_login_url()); ?>" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition-colors"><?php esc_html_e('Log In', 'cec-paywall-theme'); ?></a>
			<a href="<?php echo esc_url(wp_registration_url()); ?>" class="inline-block bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded transition-colors"><?php esc_html_e('Sign Up', 'cec-paywall-theme'); ?></a>
		</div>
	</div>
	<?php endif; ?>
	
	<?php if(is_user_logged_in() && !in_array('premium_reader', wp_get_current_user()->roles)): ?>
	<div class="bg-yellow-50 border border-yellow-100 rounded-lg shadow-sm p-6 mt-8">
		<h3 class="text-xl font-bold text-yellow-700 mb-3"><?php esc_html_e('Upgrade Your Account', 'cec-paywall-theme'); ?></h3>
		<p class="mb-4"><?php esc_html_e('Upgrade to premium for unlimited access to all content.', 'cec-paywall-theme'); ?></p>
		<a href="#" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white font-medium py-2 px-4 rounded transition-colors"><?php esc_html_e('Upgrade Now', 'cec-paywall-theme'); ?></a>
	</div>
	<?php endif; ?>
</aside><!-- #secondary -->