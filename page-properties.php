<?php
/**
 * Template Name: Properties
 * Used automatically by a page with the slug "properties".
 */
get_header();

$filters = estatein_filters();
$icons   = array( 'location' => 'location', 'property_type' => 'property_type', 'price' => 'pricing_range', 'size' => 'property_size', 'build_year' => 'calendar' );
$q       = isset( $_GET['q'] ) ? sanitize_text_field( wp_unslash( $_GET['q'] ) ) : '';
$meta    = array();
$chosen  = array();
foreach ( $filters as $key => $f ) {
	$v = isset( $_GET[ $key ] ) ? sanitize_text_field( wp_unslash( $_GET[ $key ] ) ) : '';
	$chosen[ $key ] = $v;
	if ( '' === $v ) { continue; }
	if ( preg_match( '/^(\d+)-(\d+)$/', $v, $m ) ) {
		$meta[] = array( 'key' => $key, 'value' => array( (int) $m[1], (int) $m[2] ), 'type' => 'NUMERIC', 'compare' => 'BETWEEN' );
	} else {
		$meta[] = array( 'key' => $key, 'value' => $v );
	}
}
$props = new WP_Query( array( 'post_type' => 'property', 'posts_per_page' => 12, 's' => $q, 'meta_query' => $meta, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) ) );
?>
<main id="main">
<section class="wrap find">
	<h1>Find Your Dream Property</h1>
	<p>Welcome to Estatein, where your dream property awaits in every corner of our beautiful world. Explore our curated selection of properties, each offering a unique story and a chance to redefine your life. With categories to suit every dreamer, your journey.</p>
	<form class="finder" method="get" action="<?php echo esc_url( get_permalink() ); ?>#results">
		<div class="finder__search"><label class="screen-reader-text" for="q">Search for a property</label><input id="q" type="search" name="q" value="<?php echo esc_attr( $q ); ?>" placeholder="Search For A Property"><button class="btn btn--primary find-btn" type="submit" aria-label="Find Property"><?php estatein_icon( 'find', 20 ); ?><span>Find Property</span></button></div>
		<div class="finder__filters"><?php foreach ( $filters as $key => $f ) : ?>
			<div class="sel<?php echo isset( $icons[ $key ] ) ? ' sel--ico' : ''; ?>">
				<label class="screen-reader-text" for="f-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $f[0] ); ?></label>
				<?php if ( isset( $icons[ $key ] ) ) { estatein_icon( $icons[ $key ], 24, 'sel__ico' ); } ?>
				<select id="f-<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $key ); ?>" onchange="this.form.submit()"><?php estatein_options( $f[1], $chosen[ $key ], $f[0] ); ?></select>
			</div>
		<?php endforeach; ?></div>
	</form>
</section>

<section class="sec wrap" id="results">
	<?php estatein_section_head( 'Discover a World of Possibilities', 'Our portfolio of properties is as diverse as our dreams. Explore the following categories to find the perfect property that resonates with your vision of home' ); ?>
	<div class="slider">
		<?php if ( $props->have_posts() ) : while ( $props->have_posts() ) : $props->the_post(); $tag = estatein_field( 'tagline' ); ?>
			<article class="card">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'property-card', array( 'loading' => 'lazy' ) ); } ?>
				<?php if ( $tag ) : ?><p class="pill"><?php echo esc_html( $tag ); ?></p><?php endif; ?>
				<h3><?php the_title(); ?></h3>
				<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16, '…' ) ); ?> <a href="<?php the_permalink(); ?>"><u>Read More</u></a></p>
				<div class="card__foot"><span><small>Price</small>$<?php echo esc_html( number_format_i18n( (float) estatein_field( 'price' ) ) ); ?></span><a class="btn btn--primary" href="<?php the_permalink(); ?>">View Property Details</a></div>
			</article>
		<?php endwhile; wp_reset_postdata(); else : ?>
			<p class="empty">No properties match your search. Try clearing a filter.</p>
		<?php endif; ?>
	</div>
	<?php estatein_pager( max( 1, (int) $props->found_posts ) ); ?>
</section>

<section class="sec wrap" id="inquiry">
	<?php estatein_section_head( 'Let\'s Make it Happen', 'Ready to take the first step toward your dream property? Fill out the form below, and our real estate wizards will work their magic to find your perfect match. Don\'t wait; let\'s embark on this exciting journey together.' ); ?>
	<?php if ( isset( $_GET['sent'] ) ) : ?><p class="notice" role="status">Thanks! Your message was sent. We'll be in touch soon.</p><?php elseif ( isset( $_GET['error'] ) ) : ?><p class="notice notice--err" role="alert">Please fill in your name, a valid email, and accept the terms, then try again.</p><?php endif; ?>
	<form class="inquiry" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="estatein_inquiry"><?php wp_nonce_field( 'estatein_inquiry' ); ?>
		<p class="hp" aria-hidden="true"><label>Website <input type="text" name="website" tabindex="-1" autocomplete="off"></label></p>
		<label>First Name<input type="text" name="first_name" placeholder="Enter First Name" required></label>
		<label>Last Name<input type="text" name="last_name" placeholder="Enter Last Name" required></label>
		<label>Email<input type="email" name="email" placeholder="Enter your Email" required></label>
		<label>Phone<input type="tel" name="phone" placeholder="Enter Phone Number"></label>
		<label>Preferred Location<select name="location"><?php estatein_options( $filters['location'][1], '', 'Select Location' ); ?></select></label>
		<label>Property Type<select name="property_type"><?php estatein_options( $filters['property_type'][1], '', 'Select Property Type' ); ?></select></label>
		<label>No. of Bathrooms<select name="bathrooms"><?php estatein_options( array( '1', '2', '3', '4', '5+' ), '', 'Select no. of Bathrooms' ); ?></select></label>
		<label>No. of Bedrooms<select name="bedrooms"><?php estatein_options( array( '1', '2', '3', '4', '5', '6+' ), '', 'Select no. of Bedrooms' ); ?></select></label>
		<label class="span2">Budget<select name="budget"><?php estatein_options( $filters['price'][1], '', 'Select Budget' ); ?></select></label>
		<fieldset class="span2 method"><legend>Preferred Contact Method</legend>
			<label><?php estatein_icon( 'phone' ); ?>Phone<input type="radio" name="contact_method" value="phone" checked></label>
			<label><?php estatein_icon( 'envelope' ); ?>Email<input type="radio" name="contact_method" value="email"></label>
		</fieldset>
		<label class="span4">Message<textarea name="message" rows="4" placeholder="Enter your Message here.."></textarea></label>
		<div class="span4 inquiry__foot"><label class="agree"><input type="checkbox" name="agree" value="1" required> I agree with Terms of Use and Privacy Policy</label><button class="btn btn--primary" type="submit">Send Your Message</button></div>
	</form>
</section>

<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer(); ?>
