<?php
use \Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo '<div class="eduvibe-category-3">';
	echo '<div class="inner">';
        if ( $category['icon'] ) :
            echo '<div class="icon">';
                Icons_Manager::render_icon( $category['icon'], [ 'aria-hidden' => 'true' ] );
            echo '</div>';
        endif;

		echo '<div class="content">';
            if ( $title ) : 
                echo '<h6 class="title">';
                    echo '<a href="' . esc_url( $link ) . '">' . esc_html( $title ) .'</a>';
                echo '</h6>';
            endif;

            if ( $settings['enable_category_count'] ) :
                echo '<p class="description">';
                    printf( _nx( '%s ' . esc_html( $settings['course_label'] ), '%s ' . esc_html( $settings['courses_label'] ), $count, 'Courses', 'eduvibe-core' ), number_format_i18n( $count ) );
                echo '</p>';
            endif;
		echo '</div>';
	echo '</div>';
echo '</div>';