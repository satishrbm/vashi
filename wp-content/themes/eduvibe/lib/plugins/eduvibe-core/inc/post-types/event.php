<?php
/**
 * Event for EduVibe
 *
 * @since 1.0.0
 */

namespace EduVibeCore\Post_Types;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Event {

	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
		add_action( 'init', array( __CLASS__, 'taxonomy' ) );
		add_filter( 'enter_title_here', array( __CLASS__, 'change_title_placeholder' ) );
	}

	public static function definition() {
		
		$labels = array(
			'name'                  => __( 'Events', 'eduvibe-core' ),
			'singular_name'         => __( 'Event', 'eduvibe-core' ),
			'add_new'               => __( 'Add New Event', 'eduvibe-core' ),
			'add_new_item'          => __( 'Add New Event', 'eduvibe-core' ),
			'edit_item'             => __( 'Edit Event', 'eduvibe-core' ),
			'new_item'              => __( 'New Event', 'eduvibe-core' ),
			'all_items'             => __( 'All Events', 'eduvibe-core' ),
			'view_item'             => __( 'View Event', 'eduvibe-core' ),
			'search_items'          => __( 'Search Event', 'eduvibe-core' ),
			'not_found'             => __( 'No Events found', 'eduvibe-core' ),
			'not_found_in_trash'    => __( 'No Events found in Trash', 'eduvibe-core' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Events', 'eduvibe-core' )
		);

		$labels    = apply_filters( 'eduvibe_postype_event_labels' , $labels );

		register_post_type( apply_filters( 'eduvibe_posttype_event' , 'simple_event' ),
			array(
				'labels'            => $labels,
				'supports'          => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
				'public'            => true,
				'has_archive'       => true,
				'rewrite'           => array( 'slug' => apply_filters( 'eduvibe_simple_event_slug', 'simple-event' ) ),
				'show_in_menu'      => true,
				'menu_position'     => 6,
				'categories'        => array()
			)
		);
	}

	public static function taxonomy() {

	  	$labels = array(
			'name'              => __( 'Event Categories', 'eduvibe-core' ),
			'singular_name'     => __( 'Event Category', 'eduvibe-core' ),
			'search_items'      => __( 'Search Event Categories', 'eduvibe-core' ),
			'edit_item'         => __( 'Edit Event Category', 'eduvibe-core' ),
			'update_item'       => __( 'Update Event Category', 'eduvibe-core' ),
			'add_new_item'      => __( 'Add New Event Category', 'eduvibe-core' ),
			'new_item_name'     => __( 'New Event Category', 'eduvibe-core' ),
			'menu_name'         => __( 'Event Categories', 'eduvibe-core' )
		);

		register_taxonomy( 'simple_event_category', apply_filters( 'eduvibe_posttype_event' , 'simple_event' ), array(
			'labels'            => apply_filters( 'eduvibe_simple_event_taxomony_category_labels', $labels ),
			'hierarchical'      => true,
			'query_var'         => 'simple-event-category',
			'rewrite'           => array( 'slug' => apply_filters( 'eduvibe_simple_event_category_slug', 'simple-event-category' ) ),
			'public'            => true,
			'show_admin_column' => true,
			'show_ui'           => true
		) );
	}

	public static function change_title_placeholder( $title ){
	    $screen = get_current_screen();
	    if  ( 'simple_event' == $screen->post_type ) :
          	$title = 'Enter Event Name';
	    endif;	  
	    return $title;
	}
}

Event::init();