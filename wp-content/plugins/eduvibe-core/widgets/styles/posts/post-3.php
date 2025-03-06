<?php

echo '<div class="edu-blog eduvibe-blog-post-3 radius-small">';
	echo '<div class="inner">';
		echo '<div class="content">';
			echo '<div class="status-group"> ';
                echo '<span class="eduvibe-status status-05">';
                    echo eduvibe_category_by_id( get_the_ID() );
                echo '</span>';
            echo '</div>';

            the_title( '<h5 class="title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h5>' );

			echo '<div class="blog-card-bottom">';
				echo '<ul class="eduvibe-blog-meta">';
					echo '<li><i class="icon-calendar-2-line"></i>' . esc_html( get_the_date( $date ) ) . '</li>';
					echo '<li><i class="icon-user-line"></i>' . __( 'Posted By', 'eduvibe' ) . ' ' . '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author_meta( 'display_name' ) ) . '</a></li>';
                echo '</ul>';
			echo '</div>';
		echo '</div>';

        if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
            echo '<div class="thumbnail">';
                echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                    echo $this->render_image( get_post_thumbnail_id( get_the_id() ), $settings ); 
                echo '</a>';
            echo '</div>';
        endif;
	echo '</div>';
echo '</div>';