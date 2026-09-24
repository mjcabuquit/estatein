<?php
/** Home page template. */
get_header();

$features = array(
	'find_dream_home'                => 'Find Your Dream Home',
	'unlock_property_value'          => 'Unlock Property Value',
	'effortless_property_management' => 'Effortless Property Management',
	'smart_investments'              => 'Smart Investments, Informed Decisions',
);
$reviews  = array(
	array( 'Exceptional Service!', 'Our experience with Estatein was outstanding. Their team\'s dedication and professionalism made finding our dream home a breeze. Highly recommended!', 'Wade Warren', 'USA, California', 'wade-warren' ),
	array( 'Efficient and Reliable', 'Estatein provided us with top-notch service. They helped us sell our property quickly and at a great price. We couldn\'t be happier with the results.', 'Emelie Thomson', 'USA, Florida', 'emelie-thomson' ),
	array( 'Trusted Advisors', 'The Estatein team guided us through the entire buying process. Their knowledge and commitment to our needs were impressive. Thank you for your support!', 'John Mans', 'USA, Nevada', 'john-mans' ),
);
$faqs = array(
	array( 'How do I search for properties on Estatein?', 'Learn how to use our user-friendly search tools to find properties that match your criteria.' ),
	array( 'What documents do I need to sell my property through Estatein?', 'Find out about the necessary documentation for listing your property with us.' ),
	array( 'How can I contact an Estatein agent?', 'Discover the different ways you can get in touch with our experienced agents.' ),
);

?>

<main id="main">
<section class="hero">
	<div class="wrap hero__in">
		<div class="hero__copy">
			<h1>Discover Your Dream Property with Estatein</h1>
			<p>Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.</p>
			<div class="btns"><a class="btn btn--dark" href="#">Learn More</a><a class="btn btn--primary" href="#properties">Browse Properties</a></div>
			<ul class="stats">
				<li><b>200+</b>Happy Customers</li><li><b>10k+</b>Properties For Clients</li><li><b>16+</b>Years of Experience</li>
			</ul>
		</div>
		<div class="hero__img" role="img" aria-label="Modern blue glass towers"></div>
		<a class="badge" href="#properties" aria-label="Discover your dream property: browse properties"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/discover-badge.png' ) ); ?>" width="132" height="132" alt=""></a>
	</div>
	<ul class="wrap features"><?php foreach ( $features as $icon => $label ) : ?><li><a href="#"><?php estatein_icon( 'arrow_diagonal', 24, 'features__arrow' ); estatein_icon( $icon, 82 ); ?><?php echo esc_html( $label ); ?></a></li><?php endforeach; ?></ul>
</section>

<section class="sec wrap" id="properties">
	<?php estatein_section_head( 'Featured Properties', 'Explore our handpicked selection of featured properties. Each listing offers a glimpse into exceptional homes and investments available through Estatein. Click "View Details" for more information.', 'View All Properties', get_post_type_archive_link( 'property' ) ); ?>
	<?php $q = new WP_Query( array( 'post_type' => 'property', 'posts_per_page' => 6, 'orderby' => array( 'menu_order' => 'ASC', 'date' => 'DESC' ) ) ); ?>
	<div class="slider">
		<?php if ( $q->have_posts() ) : while ( $q->have_posts() ) : $q->the_post(); ?>
			<article class="card">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'property-card', array( 'loading' => 'lazy' ) ); } ?>
				<h3><?php the_title(); ?></h3>
				<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16, '…' ) ); ?> <a href="<?php the_permalink(); ?>"><u>Read More</u></a></p>
				<ul class="tags">
					<li><?php estatein_icon( 'bedroom' ); echo esc_html( estatein_field( 'bedrooms' ) ); ?>-Bedroom</li>
					<li><?php estatein_icon( 'bathroom' ); echo esc_html( estatein_field( 'bathrooms' ) ); ?>-Bathroom</li>
					<li><?php estatein_icon( 'villa' ); echo esc_html( estatein_field( 'property_type' ) ); ?></li>
				</ul>
				<div class="card__foot"><span><small>Price</small>$<?php echo esc_html( number_format_i18n( (float) estatein_field( 'price' ) ) ); ?></span><a class="btn btn--primary" href="<?php the_permalink(); ?>">View Property Details</a></div>
			</article>
		<?php endwhile; wp_reset_postdata(); else : ?>
			<p class="empty">No properties yet. Add some under Properties in the dashboard.</p>
		<?php endif; ?>
	</div>
	<?php estatein_pager( max( 1, (int) $q->found_posts ) ); ?>
</section>

<section class="sec wrap">
	<?php estatein_section_head( 'What Our Clients Say', 'Read the success stories and heartfelt testimonials from our valued clients. Discover why they chose Estatein for their real estate needs.', 'View All Testimonials' ); ?>
	<div class="slider">
		<?php foreach ( $reviews as $r ) : ?>
			<article class="card">
				<p class="stars" role="img" aria-label="5 out of 5 stars"><?php for ( $i = 0; $i < 5; $i++ ) { estatein_icon( 'star', 44 ); } ?></p>
				<h3><?php echo esc_html( $r[0] ); ?></h3><p><?php echo esc_html( $r[1] ); ?></p>
				<p class="who"><img class="avatar" src="<?php echo esc_url( get_theme_file_uri( 'assets/images/testimonials/' . $r[4] . '.png' ) ); ?>" width="48" height="48" alt="" loading="lazy"><span><?php echo esc_html( $r[2] ); ?><small><?php echo esc_html( $r[3] ); ?></small></span></p>
			</article>
		<?php endforeach; ?>
	</div>
	<?php estatein_pager( 10 ); ?>
</section>

<section class="sec wrap">
	<?php estatein_section_head( 'Frequently Asked Questions', 'Find answers to common questions about Estatein\'s services, property listings, and helpful information. We\'re here to provide clarity and assist you every step of the way.', "View All FAQ's" ); ?>
	<div class="slider">
		<?php foreach ( $faqs as $f ) : ?>
			<article class="card"><h3><?php echo esc_html( $f[0] ); ?></h3><p><?php echo esc_html( $f[1] ); ?></p><a class="btn btn--dark" href="#">Read More</a></article>
		<?php endforeach; ?>
	</div>
	<?php estatein_pager( 10 ); ?>
</section>

<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer(); ?>
