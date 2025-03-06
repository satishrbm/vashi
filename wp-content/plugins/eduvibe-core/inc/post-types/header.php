<?php
/**
 * Header manager for EduVibe
 *
 * @since 1.0.0
 */

namespace EduVibeCore\Post_Types;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Header {

  	public static function init() {
    	add_action( 'init', array( __CLASS__, 'register_post_type' ) );
    	add_action( 'init', array( __CLASS__, 'register_header_vc' ) );
    	add_action( 'admin_init', array( __CLASS__, 'add_role_caps' ) );
    	add_filter( 'enter_title_here', array( __CLASS__, 'change_title_placeholder' ) );
  	}

  	public static function register_post_type() {
	    $labels = array(
			'name'                  => __( 'Headers', 'eduvibe-core' ),
			'singular_name'         => __( 'Header', 'eduvibe-core' ),
			'add_new'               => __( 'Add New Header', 'eduvibe-core' ),
			'add_new_item'          => __( 'Add New Header', 'eduvibe-core' ),
			'edit_item'             => __( 'Edit Header', 'eduvibe-core' ),
			'new_item'              => __( 'New Header', 'eduvibe-core' ),
			'all_items'             => __( 'Headers', 'eduvibe-core' ),
			'view_item'             => __( 'View Header', 'eduvibe-core' ),
			'search_items'          => __( 'Search Header', 'eduvibe-core' ),
			'not_found'             => __( 'No Headers found', 'eduvibe-core' ),
			'not_found_in_trash'    => __( 'No Headers found in Trash', 'eduvibe-core' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Headers', 'eduvibe-core' )
	    );

	    $type = 'eduvibe_header';

	    register_post_type( $type,
	      	array(
		        'labels'            => apply_filters( 'eduvibe_postype_header_labels' , $labels ),
		        'supports'          => array( 'title', 'revisions' ),
		        'public'            => true,
		        'has_archive'       => true,
		        'menu_icon' 		=> 'dashicons-welcome-widgets-menus',
		        'show_in_menu'      => true,
		        'menu_position'     => 4,
				'capability_type'   => array($type,'{$type}s'),
				'map_meta_cap'      => true  	
			)
	    );

  	}

  	public static function add_role_caps() {
 
		 // Add the roles you'd like to administer the custom post types
		 $roles = array('administrator');

		 $type  = 'eduvibe_header';
		 
		 // Loop through each role and assign capabilities
		 foreach($roles as $the_role) :
		 
		    $role = get_role($the_role);
		 
			$role->add_cap( 'read' );
			$role->add_cap( 'read_{$type}');
			$role->add_cap( 'read_private_{$type}s' );
			$role->add_cap( 'edit_{$type}' );
			$role->add_cap( 'edit_{$type}s' );
			$role->add_cap( 'edit_others_{$type}s' );
			$role->add_cap( 'edit_published_{$type}s' );
			$role->add_cap( 'publish_{$type}s' );
			$role->add_cap( 'delete_others_{$type}s' );
			$role->add_cap( 'delete_private_{$type}s' ); 
			$role->add_cap( 'delete_published_{$type}s' );
		 
		endforeach;
	}
 

  	public static function register_header_vc() {
	    $options = get_option( 'wpb_js_content_types' );
	    if ( is_array( $options ) && ! in_array( 'eduvibe_header', $options ) ) :
	      	$options[] = 'eduvibe_header';
	      	update_option( 'wpb_js_content_types', $options );
	    endif;
  	}

  	public static function change_title_placeholder( $title ){
	    $screen = get_current_screen();
	    if  ( 'eduvibe_header' == $screen->post_type ) :
          	$title = 'Enter Header Name';
	    endif;	  
	    return $title;
	}  
}

Header::init();