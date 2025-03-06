<?php

echo '<div class="edu-blog eduvibe-blog-post-1 radius-small">';
	echo '<div class="inner">';
        if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
            echo '<div class="thumbnail">';
                echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                    echo $this->render_image( get_post_thumbnail_id( get_the_id() ), $settings ); 
                echo '</a>';
            echo '</div>';
        endif;

		echo '<div class="content">';
			echo '<div class="status-group">';
                echo '<span class="eduvibe-status status-05">';
                    echo '<i class="icon-price-tag-3-line"></i>';
                    echo eduvibe_category_by_id( get_the_ID() );
                echo '</span>';
            echo '</div>';

            the_title( '<h5 class="title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h5>' );

			echo '<div class="blog-card-bottom">';
                echo '<ul class="eduvibe-blog-meta">';
                    echo '<li><i class="icon-calendar-2-line"></i>' . esc_html( get_the_date( $date ) ) . '</li>';
                echo '</ul>';

                if ( $settings['button_text'] ) :
                    echo '<div class="read-more-btn">';
                        echo '<a class="btn-transparent" href="' . esc_url( get_the_permalink() ) . '">';
                            echo esc_html( $settings['button_text'] ) . '<i class="icon-arrow-right-line-right"></i>';
                        echo '</a>';
                    echo '</div>';
                endif;
			echo '</div>';
		echo '</div>';
	echo '</div>';
echo '</div>';