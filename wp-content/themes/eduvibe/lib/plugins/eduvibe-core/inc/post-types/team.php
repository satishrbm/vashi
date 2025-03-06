<?php
/**
 * Team for EduVibe
 *
 * @since 1.0.0
 */

namespace EduVibeCore\Post_Types;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Team {

	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
		add_action( 'init', array( __CLASS__, 'taxonomy' ) );
		add_filter( 'enter_title_here', array( __CLASS__, 'change_title_placeholder' ) );
	}

	public static function definition() {
		
		$labels = array(
			'name'                  => __( 'Teams', 'eduvibe-core' ),
			'singular_name'         => __( 'Team', 'eduvibe-core' ),
			'add_new'               => __( 'Add New Team', 'eduvibe-core' ),
			'add_new_item'          => __( 'Add New Team', 'eduvibe-core' ),
			'edit_item'             => __( 'Edit Team', 'eduvibe-core' ),
			'new_item'              => __( 'New Team', 'eduvibe-core' ),
			'all_items'             => __( 'All Teams', 'eduvibe-core' ),
			'view_item'             => __( 'View Team', 'eduvibe-core' ),
			'search_items'          => __( 'Search Team', 'eduvibe-core' ),
			'not_found'             => __( 'No Teams found', 'eduvibe-core' ),
			'not_found_in_trash'    => __( 'No Teams found in Trash', 'eduvibe-core' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Teams', 'eduvibe-core' )
		);

		$labels    = apply_filters( 'eduvibe_postype_team_labels' , $labels );

		register_post_type( apply_filters( 'eduvibe_posttype_team' , 'simple_team' ),
			array(
				'labels'            => $labels,
				'supports'          => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author' ),
				'public'            => true,
				'has_archive'       => true,
				'rewrite'           => array( 'slug' => apply_filters( 'eduvibe_simple_team_slug', 'simple-team' ) ),
				'show_in_menu'      => true,
				'menu_position'     => 6,
				'categories'        => array()
			)
		);
	}

	public static function taxonomy() {

	  	$labels = array(
			'name'              => __( 'Team Categories', 'eduvibe-core' ),
			'singular_name'     => __( 'Team Category', 'eduvibe-core' ),
			'search_items'      => __( 'Search Team Categories', 'eduvibe-core' ),
			'edit_item'         => __( 'Edit Team Category', 'eduvibe-core' ),
			'update_item'       => __( 'Update Team Category', 'eduvibe-core' ),
			'add_new_item'      => __( 'Add New Team Category', 'eduvibe-core' ),
			'new_item_name'     => __( 'New Team Category', 'eduvibe-core' ),
			'menu_name'         => __( 'Team Categories', 'eduvibe-core' )
		);

		register_taxonomy( 'simple_team_category', apply_filters( 'eduvibe_posttype_team' , 'simple_team' ), array(
			'labels'            => apply_filters( 'eduvibe_simple_team_taxomony_category_labels', $labels ),
			'hierarchical'      => true,
			'query_var'         => 'simple-team-category',
			'rewrite'           => array( 'slug' => apply_filters( 'eduvibe_simple_team_category_slug', 'simple-team-category' ) ),
			'public'            => true,
			'show_ui'           => true
		) );
	}

	public static function change_title_placeholder( $title ){
	    $screen = get_current_screen();
	    if  ( 'simple_team' == $screen->post_type ) :
          	$title = 'Enter Name';
	    endif;	  
	    return $title;
	}
}

Team::init();