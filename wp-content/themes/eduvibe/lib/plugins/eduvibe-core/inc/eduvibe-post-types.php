<?php

// if( ! function_exists( 'eduvibe_post_type_header' ) ) :
//     function eduvibe_post_type_header() {
// 		register_post_type( 'eduvibe_header',
// 			array(
// 			  	'labels' => array(
// 					'name'          => __( 'Header', 'eduvibe-core' ),
// 					'singular_name' => __( 'Header', 'eduvibe-core' )
// 		  		),
// 				'public'        => true,
// 				'has_archive'   => true,
// 				'rewrite'       => array( 'slug' => 'eduvibe-headers' ),
// 				'menu_position' => 8,
// 				'show_in_menu'  => false
// 			)
// 		);
// 	}
// 	add_action( 'init','eduvibe_post_type_header', 2 );
// endif;

// if( ! function_exists( 'eduvibe_post_type_footer' ) ) :
//     function eduvibe_post_type_footer() {
// 		register_post_type( 'eduvibe_footer',
// 			array(
// 			  	'labels' => array(
// 					'name'          => __( 'Footer', 'eduvibe-core' ),
// 					'singular_name' => __( 'Footer', 'eduvibe-core' )
// 		  		),
// 				'public'        => true,
// 				'has_archive'   => true,
// 				'rewrite'       => array( 'slug' => 'eduvibe-footers' ),
// 				'menu_position' => 8,
// 				'show_in_menu'  => false
// 			)
// 		);
// 	}
// 	add_action( 'init','eduvibe_post_type_footer', 2 );
// endif;


// if( ! function_exists( 'eduvibe_post_type_event' ) ) :
//     function eduvibe_post_type_event(){
// 		$labels_event = array(
// 			'name'               => __( 'Event', 'eduvibe-core' ),
// 			'singular_name'      => __( 'Event Item', 'eduvibe-core' ),
// 			'add_new'            => __( 'Add New', 'eduvibe-core' ),
// 			'add_new_item'       => __( 'Add New Event Item', 'eduvibe-core' ),
// 			'edit_item'          => __( 'Edit Event Item', 'eduvibe-core' ),
// 			'new_item'           => __( 'New Event Item', 'eduvibe-core' ),
// 			'view_item'          => __( 'View Event Item', 'eduvibe-core' ),
// 			'search_items'       => __( 'Search Event', 'eduvibe-core' ),
// 			'not_found'          => __( 'Nothing found', 'eduvibe-core' ),
// 			'not_found_in_trash' => __( 'Nothing found in Trash', 'eduvibe-core' ),
// 			'parent_item_colon'  => ''
// 		);

// 		$args_event = array(
// 			'labels'             => $labels_event,
// 			'public'             => true,
// 			'has_archive'        => true,
// 			'publicly_queryable' => true,
// 			'show_ui'            => true,
// 			'query_var'          => true,
// 			'menu_icon'          => 'dashicons-images-alt',
// 			'rewrite'            =>  true,
// 			'capability_type'    => 'post',
// 			'hierarchical'       => true,			
// 			'menu_position'      => 4,
// 			'show_in_menu'       => false,
// 			'supports'           => array( 'title','thumbnail', 'editor', 'author', 'revisions', 'comments' )
// 	  	);

// 		register_post_type( 'simple_event', $args_event );
	
// 		register_taxonomy(
// 			'category_event', 
// 			'simple_event', 
// 		array(
// 			'hierarchical'   => true, 
// 			'label'          => __( 'Categories Event', 'eduvibe-core' ),
// 			'singular_label' => __( 'Category Event', 'eduvibe-core' ), 
// 			'rewrite'        => true
// 		) );
//   	}
//   	add_action( 'init','eduvibe_post_type_event',0 );
// endif;