<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CEC_Paywall_Theme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start customizing here
	if ( have_comments() ) :
		?>
		<h2 class="comments-title text-2xl font-bold text-gray-800 mb-6">
			<?php
			$cec_paywall_theme_comment_count = get_comments_number();
			if ( '1' === $cec_paywall_theme_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'cec-paywall-theme' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf( 
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $cec_paywall_theme_comment_count, 'comments title', 'cec-paywall-theme' ) ),
					number_format_i18n( $cec_paywall_theme_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comment-list divide-y divide-gray-200">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'callback'   => 'cec_comment_callback',
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments p-4 bg-yellow-50 border border-yellow-100 rounded-lg text-yellow-700 my-6"><?php esc_html_e( 'Comments are closed.', 'cec-paywall-theme' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form(
		array(
			'class_form'         => 'comment-form mt-8 space-y-4',
			'title_reply'        => '<h3 class="text-xl font-bold text-gray-800 mb-4">' . __('Leave a Comment', 'cec-paywall-theme') . '</h3>',
			'title_reply_before' => '',
			'title_reply_after'  => '',
			'class_submit'       => 'bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded transition-colors',
			'comment_field'      => '<div class="comment-form-comment mb-4"><label for="comment" class="block text-sm font-medium text-gray-700 mb-1">' . __('Comment', 'cec-paywall-theme') . '</label><textarea id="comment" name="comment" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" rows="6" required="required"></textarea></div>',
		)
	);
	?>

</div><!-- #comments -->