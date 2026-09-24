<?php get_header(); ?>
<main id="main" class="wrap sec">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article <?php post_class( 'card' ); ?>><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php the_excerpt(); ?></article>
<?php endwhile; the_posts_pagination(); else : ?><p>Nothing found.</p><?php endif; ?>
</main>
<?php get_footer(); ?>
