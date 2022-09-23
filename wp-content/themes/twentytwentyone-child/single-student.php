<?php
get_header();

while ( have_posts() ) {
	the_post();
	$meta_data = get_post_meta( get_the_ID() );
	?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div><?php twenty_twenty_one_post_thumbnail(); ?></div>
			<?php the_title( '<h1 class="entry-title default-max-width">', '</h1>' ); ?>
		</header><!-- .entry-header -->
		<div class="entry-content">
			<?php the_content();
			$options = get_option( 'wporg_options' );
			?>

			<?php echo ( ! empty( $meta_data['_lives_in'][0] ) && $options['live_in_status'] === 'active' ) ? '<div>Lives In (Country, City): ' . esc_html( $meta_data['_lives_in'][0] ) . '</div>' : '' ?>
			<?php echo ( ! empty( $meta_data['_address'][0] ) && $options['address_status'] === 'active' ) ? '<div>Address: ' . esc_html( $meta_data['_address'][0] ) . '</div>' : '' ?>
			<?php echo ( ! empty( $meta_data['_class_grade'][0] ) && $options['class_grade_status'] === 'active' ) ? '<div>Class / Grade: ' . esc_html( $meta_data['_class_grade'][0] ) . '</div>' : '' ?>
			<?php echo ( ! empty( $meta_data['_birth_date'][0] ) && $options['birth_date_status'] === 'active' ) ? '<div>Birth Date: ' . esc_html( $meta_data['_birth_date'][0] ) . '</div>' : '' ?>
		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->

	<?php
}

get_footer();
