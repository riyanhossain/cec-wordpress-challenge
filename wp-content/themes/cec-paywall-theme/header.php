<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CEC_Paywall_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site flex flex-col min-h-screen">
		<a class="skip-link screen-reader-text sr-only" href="#primary"><?php esc_html_e('Skip to content', 'cec-paywall-theme'); ?></a>

		<header id="masthead" class="site-header bg-white shadow-md">
			<div class="container mx-auto px-4 py-4">
				<div class="flex flex-col md:flex-row justify-between items-center">
					<div class="site-branding mb-4 md:mb-0">
						<?php
						the_custom_logo();
						if (is_front_page() && is_home()) :
						?>
							<h1 class="site-title text-2xl font-bold"><a href="<?php echo esc_url(home_url('/')); ?>" class="text-gray-800 hover:text-blue-600 transition-colors" rel="home"><?php bloginfo('name'); ?></a></h1>
						<?php
						else :
						?>
							<p class="site-title text-2xl font-bold"><a href="<?php echo esc_url(home_url('/')); ?>" class="text-gray-800 hover:text-blue-600 transition-colors" rel="home"><?php bloginfo('name'); ?></a></p>
						<?php
						endif;
						$cec_paywall_theme_description = get_bloginfo('description', 'display');
						if ($cec_paywall_theme_description || is_customize_preview()) :
						?>
							<p class="site-description text-gray-600 mt-1"><?php echo $cec_paywall_theme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
																			?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle md:hidden bg-blue-500 text-white px-4 py-2 rounded" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Menu', 'cec-paywall-theme'); ?></button>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'hidden md:flex space-x-4',
								'container'      => false,
								'fallback_cb'    => false,
							)
						);
						?>
					</nav><!-- #site-navigation -->
				</div>
			</div>
		</header><!-- #masthead -->

		<div id="content" class="site-content container mx-auto px-4 py-8 flex-1">