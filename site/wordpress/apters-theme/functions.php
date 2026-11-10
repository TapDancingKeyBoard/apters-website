<?php
/**
 * APTERS theme setup: content types, editable settings, and assets.
 * Staff add and edit content from the WordPress dashboard:
 *   - Events          (Dashboard > Events)
 *   - Team members    (Dashboard > Team)
 *   - Sponsorships    (Dashboard > Sponsorships, with price in KW)
 *   - Site settings   (Appearance > Customize > APTERS Settings)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'APTERS_VERSION', '1.0.0' );

function apters_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
	add_image_size( 'apters-card', 900, 600, true );
	register_nav_menus( array( 'primary' => __( 'Main menu', 'apters' ) ) );
}
add_action( 'after_setup_theme', 'apters_setup' );

function apters_assets() {
	wp_enqueue_style( 'apters', get_stylesheet_uri(), array(), APTERS_VERSION );
	wp_enqueue_script( 'apters', get_template_directory_uri() . '/assets/js/main.js', array(), APTERS_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'apters_assets' );

/* ---------- Custom content types ---------- */

function apters_register_types() {
	register_post_type( 'apters_event', array(
		'labels'      => array(
			'name'          => 'Events',
			'singular_name' => 'Event',
			'add_new_item'  => 'Add new event',
			'edit_item'     => 'Edit event',
		),
		'public'      => true,
		'has_archive' => true,
		'rewrite'     => array( 'slug' => 'events' ),
		'menu_icon'   => 'dashicons-calendar-alt',
		'supports'    => array( 'title', 'editor', 'thumbnail' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'apters_team', array(
		'labels'      => array(
			'name'          => 'Team',
			'singular_name' => 'Team member',
			'add_new_item'  => 'Add team member',
			'edit_item'     => 'Edit team member',
		),
		'public'      => false,
		'show_ui'     => true,
		'menu_icon'   => 'dashicons-groups',
		'supports'    => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		'show_in_rest' => true,
	) );

	register_post_type( 'apters_sponsor', array(
		'labels'      => array(
			'name'          => 'Sponsorships',
			'singular_name' => 'Sponsorship item',
			'add_new_item'  => 'Add sponsorship item',
			'edit_item'     => 'Edit sponsorship item',
		),
		'public'      => false,
		'show_ui'     => true,
		'menu_icon'   => 'dashicons-heart',
		'supports'    => array( 'title', 'editor', 'page-attributes' ),
		'show_in_rest' => true,
	) );
}
add_action( 'init', 'apters_register_types' );

/* Event date and location fields */
function apters_event_meta_boxes() {
	add_meta_box( 'apters_event_details', 'Event details', 'apters_event_meta_html', 'apters_event', 'side', 'high' );
	add_meta_box( 'apters_sponsor_details', 'Price', 'apters_sponsor_meta_html', 'apters_sponsor', 'side', 'high' );
	add_meta_box( 'apters_team_details', 'Role', 'apters_team_meta_html', 'apters_team', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'apters_event_meta_boxes' );

function apters_event_meta_html( $post ) {
	wp_nonce_field( 'apters_save_meta', 'apters_meta_nonce' );
	$date = get_post_meta( $post->ID, '_apters_event_date', true );
	$place = get_post_meta( $post->ID, '_apters_event_place', true );
	echo '<p><label for="apters_event_date"><strong>Date</strong></label><br>';
	echo '<input type="date" id="apters_event_date" name="apters_event_date" value="' . esc_attr( $date ) . '" style="width:100%"></p>';
	echo '<p><label for="apters_event_place"><strong>Place</strong></label><br>';
	echo '<input type="text" id="apters_event_place" name="apters_event_place" value="' . esc_attr( $place ) . '" style="width:100%"></p>';
}

function apters_sponsor_meta_html( $post ) {
	$price = get_post_meta( $post->ID, '_apters_price', true );
	echo '<p><label for="apters_price"><strong>Price (KW)</strong></label><br>';
	echo '<input type="text" id="apters_price" name="apters_price" value="' . esc_attr( $price ) . '" placeholder="e.g. 850" style="width:100%"></p>';
}

function apters_team_meta_html( $post ) {
	$role = get_post_meta( $post->ID, '_apters_role', true );
	echo '<p><label for="apters_role"><strong>Job title</strong></label><br>';
	echo '<input type="text" id="apters_role" name="apters_role" value="' . esc_attr( $role ) . '" style="width:100%"></p>';
}

function apters_save_meta( $post_id ) {
	if ( ! isset( $_POST['apters_meta_nonce'] ) || ! wp_verify_nonce( $_POST['apters_meta_nonce'], 'apters_save_meta' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$fields = array(
		'apters_event_date'  => '_apters_event_date',
		'apters_event_place' => '_apters_event_place',
		'apters_price'       => '_apters_price',
		'apters_role'        => '_apters_role',
	);
	foreach ( $fields as $input => $key ) {
		if ( isset( $_POST[ $input ] ) ) {
			update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $input ] ) ) );
		}
	}
}
add_action( 'save_post', 'apters_save_meta' );

/* Upcoming events first, sorted by date */
function apters_upcoming_events( $limit = 3 ) {
	return new WP_Query( array(
		'post_type'      => 'apters_event',
		'posts_per_page' => $limit,
		'meta_key'       => '_apters_event_date',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
		'meta_query'     => array(
			array(
				'key'     => '_apters_event_date',
				'value'   => current_time( 'Y-m-d' ),
				'compare' => '>=',
				'type'    => 'DATE',
			),
		),
	) );
}

/* ---------- Site settings (Customizer) ---------- */

function apters_customize( $wp_customize ) {
	$wp_customize->add_section( 'apters_settings', array(
		'title'    => 'APTERS Settings',
		'priority' => 30,
	) );

	$text_fields = array(
		'hero_heading'  => array( 'Home headline', 'Mobility for every child, made from recycled paper.' ),
		'hero_text'     => array( 'Home intro text', 'APTERS creates affordable, custom-made chairs, standing frames and walking frames for children with neurological or physical disabilities.' ),
		'contact_email' => array( 'Email address', 'apterszambia@gmail.com' ),
		'contact_phone' => array( 'Phone number', '+260 21 1251329' ),
		'contact_hours' => array( 'Office hours', 'Monday to Friday, 8 a.m. to 3 p.m.' ),
		'address'       => array( 'Address', 'University Teaching Hospital (UTH), Lusaka' ),
		'map_url'       => array( 'Google Maps link', 'https://www.google.com/maps/place/APTERS+Zambia/@-15.4299174,28.3141652,224m/data=!3m1!1e3!4m6!3m5!1s0x19408deb4c5b8735:0x18ee2fd83a4ac53e!8m2!3d-15.4299063!4d28.3144136!16s%2Fg%2F11p11t4t6_?entry=ttu' ),
		'bank_details'  => array( 'Bank details for donations', '' ),
		'facebook_url'  => array( 'Facebook link', 'https://www.facebook.com/Apterszambia/' ),
		'instagram_url' => array( 'Instagram link', 'https://www.instagram.com/apterszambia/' ),
	);

	foreach ( $text_fields as $id => $field ) {
		$wp_customize->add_setting( 'apters_' . $id, array(
			'default'           => $field[1],
			'sanitize_callback' => $id === 'bank_details' ? 'sanitize_textarea_field' : 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'apters_' . $id, array(
			'label'   => $field[0],
			'section' => 'apters_settings',
			'type'    => $id === 'bank_details' || $id === 'hero_text' ? 'textarea' : 'text',
		) );
	}

	$wp_customize->add_setting( 'apters_hero_image', array( 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'apters_hero_image', array(
		'label'     => 'Home photo (wide landscape works best)',
		'section'   => 'apters_settings',
		'mime_type' => 'image',
	) ) );
}
add_action( 'customize_register', 'apters_customize' );

function apters_setting( $name, $default = '' ) {
	$defaults = array(
		'contact_email' => 'apterszambia@gmail.com',
		'contact_phone' => '+260 21 1251329',
		'contact_hours' => 'Monday to Friday, 8 a.m. to 3 p.m.',
		'address'       => 'University Teaching Hospital (UTH), Lusaka',
		'facebook_url'  => 'https://www.facebook.com/Apterszambia/',
		'instagram_url' => 'https://www.instagram.com/apterszambia/',
		'map_url'       => 'https://www.google.com/maps/place/APTERS+Zambia/@-15.4299174,28.3141652,224m/data=!3m1!1e3!4m6!3m5!1s0x19408deb4c5b8735:0x18ee2fd83a4ac53e!8m2!3d-15.4299063!4d28.3144136!16s%2Fg%2F11p11t4t6_?entry=ttu',
	);
	if ( '' === $default && isset( $defaults[ $name ] ) ) {
		$default = $defaults[ $name ];
	}
	return get_theme_mod( 'apters_' . $name, $default );
}

function apters_hero_image_url() {
	$id = (int) get_theme_mod( 'apters_hero_image' );
	if ( $id ) {
		$url = wp_get_attachment_image_url( $id, 'full' );
		if ( $url ) {
			return $url;
		}
	}
	return get_template_directory_uri() . '/assets/img/hero-child.jpg';
}

/* "Saturday 12 December 2026 · Lusaka" style line for an event */
function apters_event_meta_line( $post_id ) {
	$date  = get_post_meta( $post_id, '_apters_event_date', true );
	$place = get_post_meta( $post_id, '_apters_event_place', true );
	$parts = array();
	if ( $date ) {
		$parts[] = date_i18n( 'j F Y', strtotime( $date ) );
	}
	if ( $place ) {
		$parts[] = $place;
	}
	return implode( ' · ', $parts );
}
