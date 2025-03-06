<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Admin Menu Page
 * 
 * @since 1.0.0
 */
add_action( 'admin_menu', 'eduvibe_add_admin_menu' );

if ( ! function_exists( 'eduvibe_add_admin_menu' ) ) :
    function eduvibe_add_admin_menu() {
        $enable_team_post_type = apply_filters( 'eduvibe_team_post_type_enable', false );
        
        add_menu_page( 'EduVibe',  __( 'EduVibe', 'eduvibe-core' ), 'manage_options', 'eduvibe_settings', 'eduvibe_admin_welcome_text', plugins_url( 'eduvibe-core/assets/images/dashboard-icon.png' ), 5 );

        add_submenu_page( 'eduvibe_settings', __( 'Welcome', 'eduvibe-core' ), __( 'Welcome', 'eduvibe-core' ), 'manage_options', 'eduvibe_settings' );

        add_submenu_page( 'eduvibe_settings', __( 'Headers', 'eduvibe-core' ), __( 'Headers', 'eduvibe-core' ), 'manage_options', 'edit.php?post_type=eduvibe_header' );

        add_submenu_page( 'eduvibe_settings', __( 'Footers', 'eduvibe-core' ), __( 'Footers', 'eduvibe-core' ), 'manage_options', 'edit.php?post_type=eduvibe_footer' );

        add_submenu_page( 'eduvibe_settings', __( 'Events', 'eduvibe-core' ), __( 'Events', 'eduvibe-core' ), 'manage_options', 'edit.php?post_type=simple_event' );

        if ( ( true === $enable_team_post_type ) || class_exists( 'SFWD_LMS' ) ) :
            add_submenu_page( 'eduvibe_settings', __( 'Teams', 'eduvibe-core' ), __( 'Teams', 'eduvibe-core' ), 'manage_options', 'edit.php?post_type=simple_team' );
        endif;

        if ( class_exists( 'OCDI_Plugin' ) ) :
            add_submenu_page( 'eduvibe_settings', __( 'Import Demo Data', 'eduvibe-core' ), __( 'Import Demo Data', 'eduvibe-core' ), 'manage_options', 'themes.php?page=one-click-demo-import' );
        endif;
        
        if ( class_exists( 'Redux_Framework_Plugin' ) ) :
            add_submenu_page( 'eduvibe_settings', __( 'Theme Options', 'eduvibe-core' ), __( 'Theme Options', 'eduvibe-core' ), 'manage_options', 'admin.php?page=eduvibe_options' );
        endif;
    }
endif;

if ( ! function_exists( 'eduvibe_admin_welcome_text' ) ) :
    function eduvibe_admin_welcome_text(){
        echo '<h2>'. __( 'Welcome to EduVibe', 'eduvibe-core' ) . '</h2>';
        echo '<p>' . __( 'EduVibe is a complete WordPress LMS( Learning Management System ) theme developed by DevsVibe. DevsVibe is a very young team of developers and designers. Our goal is ensuring product quality and customer satisfaction, so we\'ve gathered people who are driven by the passion to create an excellent product and be a helpful hand to their customers. Please let us know if you\'ve any query. Our support Engineer will reply to you within 10 minutes to 8 hours( maximum ). If you need any development related task then please feel free to let us know. We\'re ready to get hired and would love to help you out. If you are interested in Premium WordPress Theme, React and HTML Template then one of our products may please you. We love what we do and your review would be a great inspiration for our product development and enriching feature for you. Thanks...', 'eduvibe-core' ) . '</p>';
    }
endif;


/**
 * Author additional fields
 */
if ( ! function_exists( 'eduvibe_additional_user_fields' ) ) :
    function eduvibe_additional_user_fields( $contactmethods ) {
        $contactmethods['eduvibe_job']   = __( 'Instructor Job', 'eduvibe' );
        $contactmethods['eduvibe_facebook']  = __( 'Facebook', 'eduvibe' );
        $contactmethods['eduvibe_twitter']   = __( 'Twitter', 'eduvibe' );
        $contactmethods['eduvibe_pinterest']  = __( 'Pinterest', 'eduvibe' );
        $contactmethods['eduvibe_linkedin']   = __( 'LinkedIn', 'eduvibe' );
    
        return $contactmethods;
    }
endif;
add_filter( 'user_contactmethods', 'eduvibe_additional_user_fields', 10, 1 );