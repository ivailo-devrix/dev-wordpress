<?php
/**
 * Template Name: Example Template
 */

get_header();
?>

<div id="primary" class="content-area">\
	<?php _e( 'test temp', 'twentytwentyone-child' ); ?>
	<main id="main" class="site-main">
		<?php
		while ( have_posts() ) {
			the_post();
			?>
			<div>
				<p>Title: <?php echo esc_html( get_the_title() ); ?></p>
			</div>
			<div>
				<p>Featured Image: <?php echo get_the_post_thumbnail(); ?></p>
			</div>
			<div>
				<p>Content: <?php the_content(); ?></p>
			</div>
			<div>
				<p>Author: <?php echo esc_html( get_the_author() ); ?></p>
			</div>
		<?php }
		$post_id = get_the_ID();

		do_action( 'my-content-displayed', $post_id );
		?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>
