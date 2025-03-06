<?php
use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo '<div class="eduvibe-category-2">';
	echo '<div class="inner">';
		echo '<div class="icon">';
            if ( $category['icon'] ) :
                Icons_Manager::render_icon( $category['icon'], [ 'aria-hidden' => 'true' ] );
            endif;

            if ( $settings['enable_category_count'] ) :
                echo '<span class="subtitle">';
                    printf( _nx( '%s ' . esc_html( $settings['course_label'] ), '%s ' . esc_html( $settings['courses_label'] ), $count, 'Courses', 'eduvibe-core' ), number_format_i18n( $count ) );
                echo '</span>';
            endif;
        echo '</div>';
        
		echo '<div class="content">';
            if ( $title ) : 
                echo '<h6 class="title">';
                    echo '<a href="' . esc_url( $link ) . '">' . esc_html( $title ) .'</a>';
                echo '</h6>';
            endif;

            if ( $description ) : 
			    echo '<p class="description">' . wp_kses_post( $description ) . '</p>';
            endif;
		echo '</div>';
	echo '</div>';
echo '</div>';