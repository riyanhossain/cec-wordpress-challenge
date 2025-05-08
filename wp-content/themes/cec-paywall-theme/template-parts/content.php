<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CEC_Paywall_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				cec_paywall_theme_posted_on();
				cec_paywall_theme_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php cec_paywall_theme_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		// Paywall Gate Logic will be implemented here or in single.php
		$required_role = get_post_meta( get_the_ID(), '_cec_post_access_role', true );
		$current_user = wp_get_current_user();
		$can_access = false;

		if ( empty( $required_role ) ) { // Public content
			$can_access = true;
		} else {
			$user_roles = (array) $current_user->roles;
			if ( in_array( 'administrator', $user_roles ) ) { // Admins can always access
                $can_access = true;
            } else {
                switch ( $required_role ) {
                    case 'free_reader':
                        if ( in_array( 'free_reader', $user_roles ) || in_array( 'paid_reader', $user_roles ) || in_array( 'premium_reader', $user_roles ) ) {
                            $can_access = true;
                        }
                        break;
                    case 'paid_reader':
                        if ( in_array( 'paid_reader', $user_roles ) || in_array( 'premium_reader', $user_roles ) ) {
                            $can_access = true;
                        }
                        break;
                    case 'premium_reader':
                        if ( in_array( 'premium_reader', $user_roles ) ) {
                            $can_access = true;
                        }
                        break;
                }
            }
		}

		if ( $can_access ) {
			the_content(
				 sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'cec-paywall-theme' ),
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
			the_excerpt();
			echo '<p class="paywall-message">';
			esc_html_e( 'This content is restricted. Please subscribe or log in to view the full article.', 'cec-paywall-theme' );
			echo '</p>';
		}

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'cec-paywall-theme' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php cec_paywall_theme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
