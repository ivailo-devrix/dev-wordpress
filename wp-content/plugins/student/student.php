<?php
/*
Plugin Name: Students
Plugin URI: https://yanachkov.com/plugin?id=1
description: My first plugin
Version: 1.0
Author: Sir Yanachkov
Author URI: https://yanachkov.com
License: GPL2
*/


// Create CPT
function recipes_post_type() {
	register_post_type( 'student', array(
		'labels'        => array(
			'name'          => __( 'Students' ),
			'singular_name' => __( 'Student' )
		),
		'public'        => true,
		'show_in_rest'  => true,
		'supports'      => array( 'thumbnail', 'excerpt', 'category', 'editor', 'title' ),
		'has_archive'   => true,
		'rewrite'       => array( 'slug' => 'students' ),
		'menu_position' => 5,
		'menu_icon'     => 'dashicons-admin-users',
		'taxonomies'    => array( 'category' )
	) );

}

add_action( 'init', 'recipes_post_type' );


//lives in - meta box
function my_custom_box() {
	add_meta_box( 'student_box_id',        // Unique ID
		'Lives In (Country, City)',      // Box title
		'lives_in_custom_box_html',   // Content callback, must be of type callable
		'student'                      // Post type
	);
}

function lives_in_custom_box_html( $post ) {

	$value = get_post_meta( $post->ID, '_lives_in', true );

	echo '<input class="components-text-control__input" type="text"  id="lives_in" name="lives_in" autocomplete="off" spellcheck="false" value="' . esc_html( $value ) . '">';
}

add_action( 'add_meta_boxes', 'my_custom_box' );


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function save_lives_in_meta_box_data( $post_id ) {

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['lives_in'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_lives_in', $my_data );
}

add_action( 'save_post', 'save_lives_in_meta_box_data' );


//address in - meta box
function address_custom_box() {
	add_meta_box( 'address_box_id', 'Address', 'address_custom_box_html', 'student' );
}

function address_custom_box_html( $post ) {

	$value = get_post_meta( $post->ID, '_address', true );

	echo '<input class="components-text-control__input" type="text"  id="address" name="address" autocomplete="off" spellcheck="false" value="' . esc_html( $value ) . '">';
}

add_action( 'add_meta_boxes', 'address_custom_box' );


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function save_address_meta_box_data( $post_id ) {

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['address'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_address', $my_data );
}

add_action( 'save_post', 'save_address_meta_box_data' );


// Birth Date - meta box
function birth_date_custom_box() {
	add_meta_box( 'birth_date_box_id', 'Birth Date', 'birth_date_custom_box_html', 'student' );
}

function birth_date_custom_box_html( $post ) {

	$value = get_post_meta( $post->ID, '_birth_date', true );

	echo '<input class="components-text-control__input" type="date"  id="birth_date" name="birth_date" autocomplete="off" spellcheck="false" value="' . esc_html( $value ) . '">';
}

add_action( 'add_meta_boxes', 'birth_date_custom_box' );


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function save_birth_date_meta_box_data( $post_id ) {

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['birth_date'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_birth_date', $my_data );
}

add_action( 'save_post', 'save_birth_date_meta_box_data' );


// Class / Grade - meta box
function class_grade_custom_box() {
	add_meta_box( 'class_grade_date_box_id', 'Class / Grade', 'class_grade_custom_box_html', 'student' );
}

function class_grade_custom_box_html( $post ) {

	$value = get_post_meta( $post->ID, '_class_grade', true );

	echo '<input class="components-text-control__input" type="text"  id="class_grade" name="class_grade" autocomplete="off" spellcheck="false" value="' . esc_html( $value ) . '">';
}

add_action( 'add_meta_boxes', 'class_grade_custom_box' );


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function save_class_grade_meta_box_data( $post_id ) {

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['class_grade'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_class_grade', $my_data );
}

add_action( 'save_post', 'save_class_grade_meta_box_data' );


// Active/Inactive - meta box
function active_inactive_custom_box() {
	add_meta_box( 'active_inactive_date_box_id', 'Active/Inactive', 'active_inactive_custom_box_html', 'student' );
}

function active_inactive_custom_box_html( $post ) {

	$value = get_post_meta( $post->ID, '_active_inactive', true );

	echo ' <div>
    <input type="checkbox" id="active_inactive" name="active_inactive" value="active"' . checked( $value, 'active', false ) . '>
    <label for="active_inactive">Active</label>
  </div>';

}

add_action( 'add_meta_boxes', 'active_inactive_custom_box' );


/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function save_active_inactive_meta_box_data( $post_id ) {

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['active_inactive'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_active_inactive', $my_data );
}

add_action( 'save_post', 'save_active_inactive_meta_box_data' );


//AJAX
function wpdocs_register_my_custom_submenu_page() {

	//top level students menu
	add_menu_page( 'Students Settings', 'Students Settings', 'manage_options', 'students-admin-settings', 'students_menu_callback', 'dashicons-admin-customizer' );

	//ajax sub menu
	add_submenu_page( 'students-admin-settings', 'AJAX Settings', 'AJAX Settings', 'manage_options', 'ajax-settings', 'ajax_settings_page_callback',

	);
}

add_action( 'admin_menu', 'wpdocs_register_my_custom_submenu_page' );

function students_menu_callback() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// add error/update messages

	// check if the user have submitted the settings
	// WordPress will add the "settings-updated" $_GET parameter to the url
	if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated"
		add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
	}

	// show error/update messages

	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
			<?php
			// output security fields for the registered setting "wporg"
			settings_fields( 'wporg' );
			// output setting sections and their fields
			// (sections are registered for "wporg", each field is registered to a specific section)
			do_settings_sections( 'wporg' );
			// output save settings button
			submit_button( 'Save Settings' );
			?>
		</form>
	</div>
	<?php
}


add_action( 'admin_enqueue_scripts', 'my_plugin_assets' );

function my_plugin_assets() {
	wp_enqueue_script( 'dx_scripts', plugins_url( '/js/scripts.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );

	$students_settings_nonce = wp_create_nonce( 'students_settings' );

	wp_localize_script( 'dx_scripts', 'my_ajax_obj', array(
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'nonce'    => $students_settings_nonce,
	) );
}

add_action( 'wp_ajax_my_tag_count', 'my_ajax_handler' );


function my_ajax_handler() {
	check_ajax_referer( 'students_settings', 'nonce' );

	$status = $_POST['active'];
	$option = $_POST['options-name'];

	$options = get_option( 'wporg_options' );


	$value = 'inactive';
	if ( $status === 'true' ) {
		$value = 'active';
	}

	$options[ $option ] = $value;


	update_option( 'wporg_options', $options );


	wp_send_json_success();
}


// AJAX Page
function ajax_settings_page_callback() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated"
		add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
	}
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post" id="myOptionsForm">
			<?php
			// output security fields for the registered setting "wporg"
			settings_fields( 'wporg' );
			// output setting sections and their fields
			// (sections are registered for "wporg", each field is registered to a specific section)
			do_settings_sections( 'wporg' );
			?>
		</form>
		<div id="saveResult"></div>
	</div>
	<?php
}


/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */

/**
 * custom option and settings
 */
function wporg_settings_init() {

	// Register a new setting for "wporg" page.
	register_setting( 'wporg', 'wporg_options' );

	// Register a new section in the "wporg" page.
	add_settings_section( 'wporg_section_developers', __( 'The Matrix has you.', 'wporg' ), 'wporg_section_developers_callback', 'wporg' );

	// Register a new field in the "wporg_section_developers" section, inside the "wporg" page.
	add_settings_field( 'live_in_status', // As of WP 4.6 this value is used only internally.
		// Use $args' label_for to populate the id inside the callback.
		__( 'Live in', 'wporg' ), 'wporg_field_pill_cb', 'wporg', 'wporg_section_developers', array(
			'label_for'         => 'live_in_status',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		) );
	add_settings_field( 'address_status', // As of WP 4.6 this value is used only internally.
		// Use $args' label_for to populate the id inside the callback.
		__( 'Address:', 'wporg' ), 'wporg_field_pill_cb', 'wporg', 'wporg_section_developers', array(
			'label_for'         => 'address_status',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		) );
	add_settings_field( 'class_grade_status', // As of WP 4.6 this value is used only internally.
		// Use $args' label_for to populate the id inside the callback.
		__( 'Class / Grade', 'wporg' ), 'wporg_field_pill_cb', 'wporg', 'wporg_section_developers', array(
			'label_for'         => 'class_grade_status',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		) );
	add_settings_field( 'birth_date_status', // As of WP 4.6 this value is used only internally.
		// Use $args' label_for to populate the id inside the callback.
		__( 'Birth Date', 'wporg' ), 'wporg_field_pill_cb', 'wporg', 'wporg_section_developers', array(
			'label_for'         => 'birth_date_status',
			'class'             => 'wporg_row',
			'wporg_custom_data' => 'custom',
		) );
}

/**
 * Register our wporg_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'wporg_settings_init' );


/**
 * Custom option and settings:
 *  - callback functions
 */


/**
 * Developers section callback function.
 *
 * @param array $args The settings array, defining title, id, callback.
 */
function wporg_section_developers_callback( $args ) {
	?>
	<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'wporg' ); ?></p>
	<?php
}

/**
 * Pill field callbakc function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - the "label_for" key value is used for the "for" attribute of the <label>.
 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key value pairs to be used inside your callbacks.
 *
 * @param array $args
 */
function wporg_field_pill_cb( $args ) {
	// Get the value of the setting we've registered with register_setting()
	$options = get_option( 'wporg_options' );

	?>
	<select
		id="<?php echo esc_attr( $args['label_for'] ); ?>"
		data-custom="<?php echo esc_attr( $args['label_for'] ); ?>"
		name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]">
		<option
			value="active" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'active', false ) ) : ( '' ); ?>>
			<?php esc_html_e( 'Active', 'wporg' ); ?>
		</option>

		<option
			value="inactive" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'inactive', false ) ) : ( '' ); ?>>
			<?php esc_html_e( 'Inactive', 'wporg' ); ?>

		</option>
	</select>
	<p class="description">
		<?php esc_html_e( 'If you select "Inactive" in the settings menu, the metadata in the student single view will be hidden.', 'wporg' ); ?>
	</p>

	<?php
}


//Display custom column Active
function display_posts_active_check( $column, $post_id ) {

	$value = get_post_meta( $post_id, '_active_inactive', true );

	if ( $column === 'status' ) {
		echo '<input class="active-js-input" type="checkbox" data-post-id="' . $post_id . '"', ( checked( $value, 'active', false ) ), '/>';
	}
}

add_action( 'manage_posts_custom_column', 'display_posts_active_check', 10, 2 );


// Add custom column to post list
function add_active_column( $columns ) {
	return array_merge( $columns, array( 'status' => __( 'Active', 'devrix_student' ) ) );
}

add_filter( 'manage_student_posts_columns', 'add_active_column' );


//AJAX save status
add_action( 'wp_ajax_save_ajax_status', 'save_active_meta_box_status_ajax' );

function save_active_meta_box_status_ajax() {

	check_ajax_referer( 'students_settings', 'nonce' );

	$post_id = sanitize_text_field( $_POST['post-id'] );
	$active  = sanitize_text_field( $_POST['active'] );

	$status = '';

	if ( $active === 'true' ) {
		$status = 'active';
	}

	// Update the meta field in the database.
	update_post_meta( $post_id, '_active_inactive', $status );

	wp_send_json_success();
}
