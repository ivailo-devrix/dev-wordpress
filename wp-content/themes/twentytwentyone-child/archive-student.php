<?php
get_header();

$paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$my_query = new WP_Query( array(
	'post_type'      => 'student',
	'posts_per_page' => 3,
	'paged'          => $paged,
	'meta_query'     => array(
		array(
			'key'     => '_active_inactive',
			'value'   => 'active',
			'compare' => '=',
		)
	)
) );


if ( $my_query->have_posts() ) : ?>

	<header class="page-header alignwide">
		<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header>

	<?php while ( $my_query->have_posts() ) : ?>
		<?php $my_query->the_post(); ?>
		<div><?php twenty_twenty_one_post_thumbnail(); ?></div>
		<div><?php the_title( '<h1 class="entry-title default-max-width">', '</h1>' ) ?></div>
		<div class="entry-content"><?php the_excerpt(); ?></div>
	<?php

	endwhile;

	echo paginate_links( array(
		'total' => $my_query->max_num_pages
	) );

endif;

wp_reset_postdata();

get_footer();

