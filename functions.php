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

/** Section heading with optional button, shared by all templates. */
function estatein_section_head( $title, $text, $btn = '', $url = '#' ) { ?>
	<div class="sec-head">
		<div><h2><?php echo esc_html( $title ); ?></h2><p><?php echo esc_html( $text ); ?></p></div>
		<?php if ( $btn ) : ?><a class="btn btn--dark" href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $btn ); ?></a><?php endif; ?>
	</div>
<?php }

/** Slider pager ("01 of N" plus arrows). */
function estatein_pager( $total ) { ?>
	<div class="pager"><span><b>01</b> of <?php echo (int) $total; ?></span>
		<div><button type="button" class="pager__prev" data-dir="-1" aria-label="Previous" disabled><?php estatein_icon( 'arrow_disable', 30, 'off' ); estatein_icon( 'arrow_right', 30, 'on' ); ?></button><button type="button" data-dir="1" aria-label="Next"><?php estatein_icon( 'arrow_right', 30 ); ?></button></div>
	</div>
<?php }

/** Photo from assets/images, or a neutral placeholder until the file is added. */
function estatein_photo( $file, $w, $h, $alt = '' ) {
	if ( file_exists( get_theme_file_path( 'assets/images/' . $file ) ) ) {
		printf( '<img src="%s" width="%d" height="%d" alt="%s" loading="lazy">', esc_url( get_theme_file_uri( 'assets/images/' . $file ) ), (int) $w, (int) $h, esc_attr( $alt ) );
	} else {
		printf( '<span class="ph" style="aspect-ratio:%d/%d" role="img" aria-label="%s"></span>', (int) $w, (int) $h, esc_attr( $alt ) );
	}
}

/** Filter definitions for the Properties page: meta key => label + options (value => label, or plain list). */
function estatein_filters() {
	return array(
		'location'      => array( 'Location', array( 'Coastal', 'City Center', 'Countryside' ) ),
		'property_type' => array( 'Property Type', array( 'Villa', 'Apartment', 'Townhouse', 'Cottage' ) ),
		'price'         => array( 'Pricing Range', array( '0-300000' => 'Under $300,000', '300000-700000' => '$300,000 – $700,000', '700000-1500000' => '$700,000 – $1,500,000', '1500000-99999999' => 'Over $1,500,000' ) ),
		'size'          => array( 'Property Size', array( '0-1000' => 'Under 1,000 sq ft', '1000-2500' => '1,000 – 2,500 sq ft', '2500-99999' => 'Over 2,500 sq ft' ) ),
		'build_year'    => array( 'Build Year', array( '2020-2100' => '2020 or later', '2010-2019' => '2010 – 2019', '1900-2009' => 'Before 2010' ) ),
	);
}

/** Render <option> tags from a plain list or a value => label map. */
function estatein_options( $opts, $selected = '', $placeholder = '' ) {
	if ( $placeholder ) {
		echo '<option value="">' . esc_html( $placeholder ) . '</option>';
	}
	foreach ( $opts as $k => $label ) {
		$val = is_int( $k ) ? $label : $k;
		printf( '<option value="%s"%s>%s</option>', esc_attr( $val ), selected( $selected, $val, false ), esc_html( $label ) );
	}
}

/** Inquiries are stored in the dashboard (Inquiries) and also emailed to the site admin. */
add_action( 'init', function () {
	register_post_type( 'inquiry', array(
		'labels'    => array( 'name' => 'Inquiries', 'singular_name' => 'Inquiry' ),
		'public'    => false,
		'show_ui'   => true,
		'menu_icon' => 'dashicons-email',
		'supports'  => array( 'title', 'editor' ),
	) );
} );

add_action( 'admin_post_nopriv_estatein_inquiry', 'estatein_handle_inquiry' );
add_action( 'admin_post_estatein_inquiry', 'estatein_handle_inquiry' );
function estatein_handle_inquiry() {
	$back  = wp_get_referer() ? remove_query_arg( array( 'sent', 'error' ), wp_get_referer() ) : home_url( '/properties/' );
	$nonce = isset( $_POST['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_POST['_wpnonce'] ) ) : '';
	$get   = function ( $k ) { return isset( $_POST[ $k ] ) ? sanitize_text_field( wp_unslash( $_POST[ $k ] ) ) : ''; };
	$email = sanitize_email( $get( 'email' ) );
	if ( ! wp_verify_nonce( $nonce, 'estatein_inquiry' ) || $get( 'website' ) || ! $get( 'agree' ) || ! $get( 'first_name' ) || ! $get( 'last_name' ) || ! is_email( $email ) ) {
		wp_safe_redirect( add_query_arg( 'error', '1', $back ) . '#inquiry' );
		exit;
	}
	$name  = $get( 'first_name' ) . ' ' . $get( 'last_name' );
	$lines = array( "Name: $name", "Email: $email", 'Phone: ' . $get( 'phone' ) );
	foreach ( array( 'location', 'property_type', 'bathrooms', 'bedrooms', 'budget', 'contact_method' ) as $k ) {
		$lines[] = ucwords( str_replace( '_', ' ', $k ) ) . ': ' . $get( $k );
	}
	$lines[] = 'Message: ' . ( isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '' );
	$body    = implode( "\n", $lines );
	wp_insert_post( array( 'post_type' => 'inquiry', 'post_status' => 'private', 'post_title' => $name, 'post_content' => $body ) );
	wp_mail( get_option( 'admin_email' ), 'New property inquiry: ' . $name, $body, array( 'Reply-To: ' . $email ) );
	wp_safe_redirect( add_query_arg( 'sent', '1', $back ) . '#inquiry' );
	exit;
}
