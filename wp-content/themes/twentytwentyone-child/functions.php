<?php

add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


function this_is_my_filter( $content ) {
	$string = '<p>' . __( 'This is my filter', 'twentytwentyone-child' ) . '</p>';
	//$string  = apply_filters( 'my-hook-test', '85151' );
	$content = $string . $content;

	return $content;

}

add_filter( 'the_content', 'this_is_my_filter' );

function echo_new_string( $b ) {
	$string = '<p>' . __( 'This is my extendable filter', 'twentytwentyone-child' ) . '</p>';

	return $string;
}

add_filter( 'my-hook-test', 'echo_new_string' );


function filter1( $content ) {

	return $content . '<div>' . __( 'Two', 'twentytwentyone-child' ) . '</div>';
}

add_filter( 'the_content', 'filter1' );


function filter2( $content ) {
	return $content . '<div>' . __( 'One', 'my-custom-filter' ) . '</div>';
}

add_filter( 'the_content', 'filter2', 8 );


function filter3( $content ) {
	return $content . '<div>' . __( 'Three', 'my-custom-filter' ) . '</div>';
}

add_filter( 'the_content', 'filter3', 11 );


function add_nav_menu_setings_button( $items ) {
	if ( is_user_logged_in() ) {
		$items .= '<li class="menu-item menu-item-type-post_type menu-item-object-page">
			   <a href="/wp-admin/profile.php">Profile settings</a>
			   </li>';
	}

	return $items;
}

add_filter( 'wp_nav_menu_items', 'add_nav_menu_setings_button', 10 );

add_action( 'profile_update', 'my_profile_update', 10, 1 );

function my_profile_update( $user_id ) {
	$to      = get_option( 'admin_email' );
	$subject = "user_id: $user_id - update profile";
	$body    = "user_id: $user_id - update profile";
	$headers = array( 'Content-Type: text/html; charset=UTF-8' );
	$test    = wp_mail( $to, $subject, $body, $headers );
}

load_child_theme_textdomain( 'twentytwentyone-child', '/' );


add_action( 'my-content-displayed', 'echo_hi_world' );

function echo_hi_world( $id ) {
	?>
	<div>
		<p>Hello World action from post <?php echo $id; ?></p>
	</div>
	<?php
}


if ( ! function_exists( 'pagination' ) ) :

	function pagination( $paged = '', $max_page = '' ) {
		$big = 999999999; // need an unlikely integer
		if ( ! $paged ) {
			$paged = get_query_var( 'page' );
		}

		if ( ! $max_page ) {
			global $wp_query;
			$max_page = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
		}

		echo paginate_links( array(
			'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format'    => '?page=%#%',
			'current'   => max( 1, $paged ),
			'total'     => $max_page,
			'mid_size'  => 1,
			'prev_text' => __( '«' ),
			'next_text' => __( '»' ),
			'type'      => 'list'
		) );
	}
endif;

function set_posts_per_page_for_towns_cpt( $query ) {
	if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'student' ) ) {
		$query->set( 'posts_per_page', '3' );
	}
}

add_action( 'pre_get_posts', 'set_posts_per_page_for_towns_cpt' );