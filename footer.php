<footer class="site-footer">
	<div class="wrap footer__top">
		<div>
			<?php estatein_logo(); ?>
			<form class="subscribe" action="#" method="post">
				<label class="screen-reader-text" for="sub-email">Email</label>
				<input id="sub-email" type="email" name="email" placeholder="Enter Your Email" required>
				<button type="submit" aria-label="Subscribe"><?php estatein_icon( 'send_icon', 30 ); ?></button>
			</form>
		</div>
		<?php
		$cols = array(
			'Home'       => array( 'Hero Section', 'Features', 'Properties', 'Testimonials', "FAQ's" ),
			'About Us'   => array( 'Our Story', 'Our Works', 'How It Works', 'Our Team', 'Our Clients' ),
			'Properties' => array( 'Portfolio', 'Categories' ),
			'Services'   => array( 'Valuation Mastery', 'Strategic Marketing', 'Negotiation Wizardry', 'Closing Success', 'Property Management' ),
			'Contact Us' => array( 'Contact Form', 'Our Offices' ),
		);
		foreach ( $cols as $title => $links ) : ?>
			<div class="fcol">
				<h3><?php echo esc_html( $title ); ?></h3>
				<ul><?php foreach ( $links as $l ) : ?><li><a href="#"><?php echo esc_html( $l ); ?></a></li><?php endforeach; ?></ul>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="wrap footer__bottom">
		<p>©<?php echo esc_html( gmdate( 'Y' ) ); ?> Estatein. All Rights Reserved. <a href="#">Terms &amp; Conditions</a></p>
		<ul class="social"><?php foreach ( array( 'Facebook' => 'facebook', 'LinkedIn' => 'linkedin', 'Twitter' => 'twitter', 'YouTube' => 'youtube' ) as $n => $i ) : ?><li><a href="#" aria-label="<?php echo esc_attr( $n ); ?>"><?php estatein_icon( $i, 52 ); ?></a></li><?php endforeach; ?></ul>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
