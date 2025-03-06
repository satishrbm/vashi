<?php

echo '<div class="edu-blog eduvibe-blog-post-1 variation-2 radius-small">';
	echo '<div class="inner">';
        if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
            echo '<div class="thumbnail">';
                echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                    echo $this->render_image( get_post_thumbnail_id( get_the_id() ), $settings ); 
                echo '</a>';
            echo '</div>';
        endif;
        
		echo '<div class="content">';
            if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                echo '<div class="blog-date-status">';
                    echo '<span class="day">' . esc_html( get_the_date( 'd' ) ) . '</span> <span class="month">' . esc_html( get_the_date( 'M' ) ) . '</span>';
                echo '</div>';
            endif;

			echo '<div class="status-style-5">';
                echo '<span class="eduvibe-status status-05">';
                    echo '<i class="icon-price-tag-3-line"></i>'; 
                    echo eduvibe_category_by_id( get_the_ID() );
                echo '</span> ';

                echo '<span class="eduvibe-status status-05">';
                    echo '<i class="icon-time-line"></i> ' . eduvibe_post_estimated_reading_time() . ' '. __( 'Read', 'eduvibe' );
                echo '</span>';
            echo '</div>';

            the_title( '<h5 class="title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h5>' );
	    echo '</div>';
	echo '</div>';
echo '</div>';