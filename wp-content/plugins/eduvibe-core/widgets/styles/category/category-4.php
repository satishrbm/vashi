<?php
use \Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo '<div class="eduvibe-category-4 shape-bg-1">';
	echo '<div class="inner">';
		echo '<div class="icon">';
            echo '<a href="' . esc_url( $link ) . '">';
                echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $category['thumb'] ) . '">';
            echo '</a>';
        echo '</div>';

		echo '<div class="content">';
            if ( $title ) : 
                echo '<h6 class="title">';
                    echo '<a href="' . esc_url( $link ) . '">' . esc_html( $title ) .'</a>';
                echo '</h6>';
            endif;

            echo '<span>';
                printf( _nx( '%s ' . esc_html( $settings['course_label'] ), '%s ' . esc_html( $settings['courses_label'] ), $count, 'Courses', 'eduvibe-core' ), number_format_i18n( $count ) );
            echo '</span>';
        echo '</div>';

		echo '<div class="hover-action">';
            echo '<a class="read-more-btn" href="' . esc_url( $link ) . '">';
                echo '<i class="icon-arrow-right-line-right"></i>';
            echo '</a>';
        echo '</div>';
	echo '</div>';
echo '</div>';