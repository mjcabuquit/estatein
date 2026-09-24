<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Skip to content</a>
<div class="promo" id="promo">
	<p>✨ Discover Your Dream Property with Estatein <a href="<?php echo esc_url( home_url( '/about' ) ); ?>">Learn More</a></p>
	<button type="button" class="promo__close" aria-label="Dismiss announcement">×</button>
</div>
<header class="site-header">
	<div class="wrap header__in">
		<?php estatein_logo(); ?>
		<button class="nav-toggle" aria-expanded="false" aria-controls="nav" aria-label="Menu"><span></span></button>
		<nav id="nav" class="nav" aria-label="Primary">
			<?php
			wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_class' => 'nav__list', 'fallback_cb' => function () {
				echo '<ul class="nav__list"><li class="current-menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">Home</a></li><li><a href="#">About Us</a></li><li><a href="#properties">Properties</a></li><li><a href="#">Services</a></li></ul>';
			} ) );
			?>
			<a class="btn btn--dark nav__cta" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact Us</a>
		</nav>
	</div>
</header>
