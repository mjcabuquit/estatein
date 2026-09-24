<?php
/**
 * Template Name: About Us
 * Used automatically by a page with the slug "about".
 */
get_header();

$values = array(
	array( 'Trust', 'Trust is the cornerstone of every successful real estate transaction.', 'trust' ),
	array( 'Excellence', 'We set the bar high for ourselves. From the properties we list to the services we provide.', 'excellence' ),
	array( 'Client-Centric', 'Your dreams and needs are at the center of our universe. We listen, understand.', 'client_center' ),
	array( 'Our Commitment', 'We are dedicated to providing you with the highest level of service, professionalism, and support.', 'commitment' ),
);
$wins = array(
	array( '3+ Years of Excellence', 'With over 3 years in the industry, we\'ve amassed a wealth of knowledge and experience, becoming a go-to resource for all things real estate.' ),
	array( 'Happy Clients', 'Our greatest achievement is the satisfaction of our clients. Their success stories fuel our passion for what we do.' ),
	array( 'Industry Recognition', 'We\'ve earned the respect of our peers and industry leaders, with accolades and awards that reflect our commitment to excellence.' ),
);
$steps = array(
	array( 'Discover a World of Possibilities', 'Your journey begins with exploring our carefully curated property listings. Use our intuitive search tools to filter properties based on your preferences, including location, type, size, and budget.' ),
	array( 'Narrowing Down Your Choices', 'Once you\'ve found properties that catch your eye, save them to your account or make a shortlist. This allows you to compare and revisit your favorites as you make your decision.' ),
	array( 'Personalized Guidance', 'Have questions about a property or need more information? Our dedicated team of real estate experts is just a call or message away.' ),
	array( 'See It for Yourself', 'Arrange viewings of the properties you\'re interested in. We\'ll coordinate with the property owners and accompany you to ensure you get a firsthand look at your potential new home.' ),
	array( 'Making Informed Decisions', 'Before making an offer, our team will assist you with due diligence, including property inspections, legal checks, and market analysis. We want you to be fully informed and confident in your choice.' ),
	array( 'Getting the Best Deal', 'We\'ll help you negotiate the best terms and prepare your offer. Our goal is to secure the property at the right price and on favorable terms.' ),
);
$team = array(
	array( 'Max Mitchell', 'Founder', 'max-mitchell.webp' ),
	array( 'Sarah Johnson', 'Chief Real Estate Officer', 'sarah-johnson.webp' ),
	array( 'David Brown', 'Head of Property Management', 'david-brown.webp' ),
	array( 'Michael Turner', 'Legal Counsel', 'michael-turner.webp' ),
);
$clients = array(
	array( '2019', 'ABC Corporation', 'Commercial Real Estate', 'Luxury Home Development', 'Estatein\'s expertise in finding the perfect office space for our expanding operations was invaluable. They truly understand our business needs.' ),
	array( '2018', 'GreenTech Enterprises', 'Commercial Real Estate', 'Retail Space', 'Estatein\'s ability to identify prime retail locations helped us expand our brand presence. They are a trusted partner in our growth.' ),
);
$story = 'Our story is one of continuous growth and evolution. We started as a small team with big dreams, determined to create a real estate platform that transcended the ordinary.';
?>
<main id="main">
<section class="sec wrap about-intro">
	<div>
		<h1>Our Journey</h1>
		<p><?php echo esc_html( $story ); ?> Over the years, we've expanded our reach, forged valuable partnerships, and gained the trust of countless clients.</p>
		<ul class="stats"><li><b>200+</b>Happy Customers</li><li><b>10k+</b>Properties For Clients</li><li><b>16+</b>Years of Experience</li></ul>
	</div>
	<div class="about-img"><?php estatein_photo( 'about-journey.webp', 1120, 809, 'A hand holding a miniature house' ); ?></div>
</section>

<section class="sec wrap values">
	<div><h2>Our Values</h2><p><?php echo esc_html( $story ); ?></p></div>
	<ul class="values__box"><?php foreach ( $values as $v ) : ?>
		<li><?php estatein_icon( $v[2], 48 ); ?><h3><?php echo esc_html( $v[0] ); ?></h3><p><?php echo esc_html( $v[1] ); ?></p></li>
	<?php endforeach; ?></ul>
</section>

<section class="sec wrap">
	<?php estatein_section_head( 'Our Achievements', $story ); ?>
	<div class="grid grid--3"><?php foreach ( $wins as $w ) : ?>
		<article class="card"><h3><?php echo esc_html( $w[0] ); ?></h3><p><?php echo esc_html( $w[1] ); ?></p></article>
	<?php endforeach; ?></div>
</section>

<section class="sec wrap">
	<?php estatein_section_head( 'Navigating the Estatein Experience', 'At Estatein, we\'ve designed a straightforward process to help you find and purchase your dream property with ease. Here\'s a step-by-step guide to how it all works.' ); ?>
	<div class="grid grid--3"><?php foreach ( $steps as $i => $st ) : ?>
		<article class="step"><p class="step__n">Step <?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></p><div class="step__body"><h3><?php echo esc_html( $st[0] ); ?></h3><p><?php echo esc_html( $st[1] ); ?></p></div></article>
	<?php endforeach; ?></div>
</section>

<section class="sec wrap">
	<?php estatein_section_head( 'Meet the Estatein Team', 'At Estatein, our success is driven by the dedication and expertise of our team. Get to know the people behind our mission to make your real estate dreams a reality.' ); ?>
	<div class="grid grid--4"><?php foreach ( $team as $m ) : ?>
		<article class="card member">
			<div class="member__photo"><?php estatein_photo( $m[2], 634, 506, $m[0] ); ?><a class="member__tw" href="#" aria-label="<?php echo esc_attr( $m[0] ); ?> on Twitter"><img src="<?php echo esc_url( get_theme_file_uri( 'assets/images/icons/twitter_blue.svg' ) ); ?>" width="76" height="52" alt="" aria-hidden="true" loading="lazy"></a></div>
			<h3><?php echo esc_html( $m[0] ); ?></h3><p><?php echo esc_html( $m[1] ); ?></p>
			<a class="hello" href="#">Say Hello<span><?php estatein_icon( 'send_icon', 18 ); ?></span></a>
		</article>
	<?php endforeach; ?></div>
</section>

<section class="sec wrap">
	<?php estatein_section_head( 'Our Valued Clients', 'At Estatein, we have had the privilege of working with a diverse range of clients across various industries. Here are some of the clients we\'ve had the pleasure of serving.' ); ?>
	<div class="slider slider--2"><?php foreach ( $clients as $c ) : ?>
		<article class="card client">
			<div class="client__top"><div><small>Since <?php echo esc_html( $c[0] ); ?></small><h3><?php echo esc_html( $c[1] ); ?></h3></div><a class="btn btn--dark" href="#">Visit Website</a></div>
			<dl class="client__meta"><div><dt>Domain</dt><dd><?php echo esc_html( $c[2] ); ?></dd></div><div><dt>Category</dt><dd><?php echo esc_html( $c[3] ); ?></dd></div></dl>
			<blockquote><small>What They Said</small><p><?php echo esc_html( $c[4] ); ?></p></blockquote>
		</article>
	<?php endforeach; ?></div>
	<?php estatein_pager( 10 ); ?>
</section>

<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php get_footer(); ?>
