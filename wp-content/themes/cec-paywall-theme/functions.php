<?php
/**
 * CEC Paywall Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CEC_Paywall_Theme
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cec_paywall_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on CEC Paywall Theme, use a find and replace
		* to change 'cec-paywall-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'cec-paywall-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'cec-paywall-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'cec_paywall_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'cec_paywall_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cec_paywall_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cec_paywall_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'cec_paywall_theme_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function cec_paywall_theme_scripts() {
	wp_enqueue_style( 'cec-paywall-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'cec-paywall-theme-style', 'rtl', 'replace' );

	wp_enqueue_script( 'cec-paywall-theme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cec_paywall_theme_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

// Requirements from README.md

// 1. Add User Roles: Free Reader, Paid Reader, and Premium Reader.
function cec_add_custom_roles() {
    add_role(
        'free_reader',
        __( 'Free Reader', 'cec-paywall-theme' ),
        array(
            'read' => true, // True allows this role to read posts
        )
    );
    add_role(
        'paid_reader',
        __( 'Paid Reader', 'cec-paywall-theme' ),
        array(
            'read' => true,
        )
    );
    add_role(
        'premium_reader',
        __( 'Premium Reader', 'cec-paywall-theme' ),
        array(
            'read' => true,
            'read_premium_content' => true, // Custom capability
        )
    );
}
add_action( 'init', 'cec_add_custom_roles' );

// 2. Enable public user registration and set Free Reader as the default role.
update_option( 'users_can_register', 1 );
update_option( 'default_role', 'free_reader' );

// 3. Add Post Metabox (Initial setup, more to be added)
function cec_add_post_metabox() {
    add_meta_box(
        'cec_post_permissions_metabox',
        __( 'Post Access Level', 'cec-paywall-theme' ),
        'cec_post_permissions_metabox_html',
        'post', // Add to posts
        'side', // Context
        'default' // Priority
    );
}
add_action( 'add_meta_boxes', 'cec_add_post_metabox' );

function cec_post_permissions_metabox_html( $post ) {
    wp_nonce_field( 'cec_save_post_permissions', 'cec_post_permissions_nonce' );
    $value = get_post_meta( $post->ID, '_cec_post_access_role', true );
    ?>
    <label for="cec_post_access_role_field"><?php esc_html_e( 'Required Role:', 'cec-paywall-theme' ); ?></label>
    <select name="cec_post_access_role_field" id="cec_post_access_role_field" class="postbox">
        <option value=""><?php esc_html_e( 'Public (Everyone)', 'cec-paywall-theme' ); ?></option>
        <option value="free_reader" <?php selected( $value, 'free_reader' ); ?>><?php esc_html_e( 'Free Reader', 'cec-paywall-theme' ); ?></option>
        <option value="paid_reader" <?php selected( $value, 'paid_reader' ); ?>><?php esc_html_e( 'Paid Reader', 'cec-paywall-theme' ); ?></option>
        <option value="premium_reader" <?php selected( $value, 'premium_reader' ); ?>><?php esc_html_e( 'Premium Reader', 'cec-paywall-theme' ); ?></option>
    </select>
    <?php
}

function cec_save_post_permissions( $post_id ) {
    if ( ! isset( $_POST['cec_post_permissions_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce( $_POST['cec_post_permissions_nonce'], 'cec_save_post_permissions' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }
    if ( ! isset( $_POST['cec_post_access_role_field'] ) ) {
        return;
    }
    $my_data = sanitize_text_field( $_POST['cec_post_access_role_field'] );
    update_post_meta( $post_id, '_cec_post_access_role', $my_data );
}
add_action( 'save_post', 'cec_save_post_permissions' );

// 4. Paywall Gate (Initial setup, more to be added in content templates)
// This will be primarily handled in template files like single.php or content.php

// 5. Premium Content Restriction (Initial setup, more to be added in query modifications)
function cec_restrict_premium_content_query( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ! current_user_can( 'read_premium_content' ) ) {
        $meta_query = $query->get( 'meta_query' );
        if ( ! is_array( $meta_query ) ) {
            $meta_query = array();
        }
        $meta_query[] = array(
            'key'     => '_cec_post_access_role',
            'value'   => 'premium_reader',
            'compare' => '!=',
        );
        $query->set( 'meta_query', $meta_query );
    }
}
add_action( 'pre_get_posts', 'cec_restrict_premium_content_query' );

