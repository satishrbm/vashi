<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    }
}

function modify_edu_meta_content($content) {
    // Replace "Students" with "People"
    $content = str_replace('Students', 'People', $content);

    // Add "Taken by " after the <i> icon using regex
    $content = preg_replace('/(<i class="icon-account-circle-line"><\/i>)/', '$1 Taken by ', $content);

    return $content;
}
add_filter('the_content', 'modify_edu_meta_content');
