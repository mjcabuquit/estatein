<?php
/** Estatein theme setup. */
defined( 'ABSPATH' ) || exit;

add_action( 'after_setup_theme', function () {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	register_nav_menus( array( 'primary' => 'Primary menu', 'footer' => 'Footer menu' ) );
	add_image_size( 'property-card', 800, 560, true );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'estatein-font', 'https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600&display=swap', array(), null );
	wp_enqueue_style( 'estatein', get_theme_file_uri( 'assets/css/main.css' ), array(), filemtime( get_theme_file_path( 'assets/css/main.css' ) ) );
	wp_enqueue_script( 'estatein', get_theme_file_uri( 'assets/js/main.js' ), array(), filemtime( get_theme_file_path( 'assets/js/main.js' ) ), true );
} );

/** Properties are managed as a custom post type (fields via ACF or plain meta). */
add_action( 'init', function () {
	register_post_type( 'property', array(
		'labels'       => array( 'name' => 'Properties', 'singular_name' => 'Property' ),
		'public'       => true,
		'menu_icon'    => 'dashicons-admin-home',
		'has_archive'  => true,
		'show_in_rest' => true,
		'supports'     => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
	) );
} );

/** Read a field from ACF if active, otherwise from post meta. */
function estatein_field( $key, $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	if ( function_exists( 'get_field' ) ) {
		return get_field( $key, $post_id );
	}
	return get_post_meta( $post_id, $key, true );
}

/** Output a decorative theme icon from assets/images/icons. */
function estatein_icon( $file, $size = 24, $class = '' ) {
	printf(
		'<img class="%1$s" src="%2$s" width="%3$d" height="%3$d" alt="" aria-hidden="true" loading="lazy">',
		esc_attr( $class ),
		esc_url( get_theme_file_uri( 'assets/images/icons/' . $file . '.svg' ) ),
		(int) $size
	);
}

/** Output the site logo linked to the home page. */
function estatein_logo() {
	printf(
		'<a class="logo" href="%1$s"><img src="%2$s" width="160" height="48" alt="%3$s"></a>',
		esc_url( home_url( '/' ) ),
		esc_url( get_theme_file_uri( 'assets/images/logo.svg' ) ),
		esc_attr( get_bloginfo( 'name' ) )
	);
}
