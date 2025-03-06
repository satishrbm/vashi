<?php
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo '<div class="eduvibe-category-1 radius-small">';
	echo '<div class="inner">';
		echo '<div class="thumbnail">';
            echo '<a href="' . esc_url( $link ) . '">';
                echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $category['thumb'] ) . '">';
            echo '</a>';
		echo '</div>';

		echo '<div class="content">';
            if ( $settings['enable_category_count'] ) :
                echo '<span class="course-total">';
                    printf( _nx( '%s ' . esc_html( $settings['course_label'] ), '%s ' . esc_html( $settings['courses_label'] ), $count, 'Courses', 'eduvibe-core' ), number_format_i18n( $count ) );
                echo '</span>';
            endif;
            
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