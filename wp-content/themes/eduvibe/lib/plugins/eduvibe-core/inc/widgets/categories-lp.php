<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * EduVibe LearnPress Categories Widgets
 */ 
if( ! function_exists( 'eduvibe_lp_register_categories_widget' ) ) :
	function eduvibe_lp_register_categories_widget() {
	    register_widget( 'EduVibeCore_LP_Categories_Widget' );
	}
endif;

add_action( 'widgets_init', 'eduvibe_lp_register_categories_widget' );

if( ! class_exists( 'EduVibeCore_LP_Categories_Widget' ) ) :
	class EduVibeCore_LP_Categories_Widget extends WP_Widget {

		function __construct() {
			parent::__construct(
				'EduVibeCore_LP_Categories_Widget',
				__( 'EduVibe Categories( LearnPress )',  'eduvibe-core' ),
				array( 'description' => __( 'EduVibe LearnPress Course Categories',  'eduvibe-core' ), )
			);
		}

		public function widget( $args, $instance ) {

			extract( $args );
			extract( $instance );

			echo  $before_widget;

			if ( ! empty( $title ) ) {
				echo  $before_title . apply_filters( 'widget_title', $title ). $after_title;
			}

			$include = $include ? explode( ',', $include ) : array();
			$exclude = $exclude ? explode( ',', $exclude ) : array();
			$hide_empty       = 'yes' === esc_attr( $hide_empty_cat ) ? 0 : true;  
            $top_level_cats   = 'yes' === esc_attr( $only_top_level_categories ) ? 0 : '';  

			$args = array(
                'orderby'    => $orderby,
                'order'      => $order,
                'hide_empty' => $hide_empty,
                'number'     => $number,
                'parent'     => $top_level_cats,
                'include'    => $include,
                'exclude'    => $exclude
            );

			$course_categories = get_terms( 'course_category', $args );
            if ( is_array( $course_categories ) ) : 
                echo '<div class="widget-categories eduvibe-course-category-widget">';
                    foreach ( $course_categories as $course_cat ) :
                        $term_link    = get_term_link( $course_cat, 'course_category' );
                        $term_meta    = get_option( 'taxonomy_' . $course_cat->term_id );                        
                        echo '<a class="eduvibe-course-cat-widget-each-item" href="' . esc_url( $term_link ) . '">';
                        	if ( ! empty( $term_meta['cat_icon'] ) ) :
	                            echo '<div class="cate-icon">';
	                                echo '<i class="' . esc_attr( $term_meta['cat_icon'] ) . '"></i>';
	                            echo '</div>';
	                        endif;
                            echo '<div class="cat-content">';
                                echo '<span class="title">' . esc_html( $course_cat->name ) . '</span>';
                            echo '</div>';
                        echo '</a>';
                    endforeach;
                echo '</div>';
            endif;
 
			echo  $after_widget;
		}

		public function form( $instance ) {
			extract( $instance );
			$number                    = isset( $number ) ? $number : 5;
			$orderby                   = isset( $orderby ) ? $orderby : 'date';
			$order                     = isset( $order ) ? $order : 'DESC';
			$include                   = isset( $include ) ? $include : '';
			$exclude                   = isset( $exclude ) ? $exclude : '';
			$only_top_level_categories = isset( $instance['only_top_level_categories'] ) ? $instance['only_top_level_categories'] : 'no';
			$hide_empty_cat            = isset( $instance['hide_empty_cat'] ) ? $instance['hide_empty_cat'] : 'no';
			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'eduvibe-core' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php if( isset( $title ) ) echo esc_attr( $title ); ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'orderby' ) ); ?>"><?php esc_html_e( 'Categories Orderby:', 'eduvibe-core' ); ?></label> 
				<select class="widefat" id="<?php echo  $this->get_field_id( 'orderby' ); ?>" name="<?php echo  $this->get_field_name( 'orderby' ); ?>">
					<option value="name" <?php selected( $orderby, 'name' ) ?>><?php esc_html_e( 'Name', 'eduvibe-core' ); ?></option>
					<option value="ID" <?php selected( $orderby, 'ID' ) ?>><?php esc_html_e( 'ID', 'eduvibe-core' ); ?></option>
					<option value="count" <?php selected( $orderby, 'count' ) ?>><?php esc_html_e( 'Count', 'eduvibe-core' ); ?></option>
					<option value="slug" <?php selected( $orderby, 'slug' ) ?>><?php esc_html_e( 'Slug', 'eduvibe-core' ); ?></option>
					<option value="term_group" <?php selected( $orderby, 'term_group' ) ?>><?php esc_html_e( 'Term Group', 'eduvibe-core' ); ?></option>
					<option value="none" <?php selected( $orderby, 'none' ) ?>><?php esc_html_e( 'none', 'eduvibe-core' ); ?></option>
				</select>
			</p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Categories order:', 'eduvibe-core' ); ?></label> 
				<select class="widefat" id="<?php echo  $this->get_field_id( 'order' ); ?>" name="<?php echo  $this->get_field_name( 'order' ); ?>">
					<option value="DESC" <?php selected( $order, 'DESC' ) ?>><?php esc_html_e( 'Descending', 'eduvibe-core' ); ?></option>
					<option value="ASC" <?php selected( $order, 'ASC' ) ?>><?php esc_html_e( 'Ascending', 'eduvibe-core' ); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of Categories:', 'eduvibe-core' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php if( isset( $number ) ) echo esc_attr( $number ); ?>">
				<span class="eduvibe-widget-description"><?php esc_html_e( 'Number of categories to show. Default: 5', 'eduvibe-core' ); ?></span>
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'include' ) ); ?>"><?php esc_html_e( 'Include Categories:', 'eduvibe-core' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'include' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'include' ) ); ?>" type="text" value="<?php if( isset( $include ) ) echo esc_attr( $include ); ?>">
				<span class="eduvibe-widget-description"><?php esc_html_e( 'Comma separated string of category IDs to include', 'eduvibe-core' ); ?></span>
			</p>			

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>"><?php esc_html_e( 'Exclude Categories:', 'eduvibe-core' ); ?></label> 
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'exclude' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude' ) ); ?>" type="text" value="<?php if( isset( $exclude ) ) echo esc_attr( $exclude ); ?>">
				<span class="eduvibe-widget-description"><?php esc_html_e( 'Comma separated string of category IDs to exclude', 'eduvibe-core' ); ?></span>
			</p>

			<p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'only_top_level_categories' ) ); ?>"><?php _e( 'Only Top Level Category?', 'eduvibe-core' ); ?></label>
	            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'only_top_level_categories' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'only_top_level_categories' ) ); ?>" type="checkbox" value="yes" <?php checked( $only_top_level_categories, 'yes', true ); ?>/>
	        </p>

			<p>
	            <label for="<?php echo esc_attr( $this->get_field_id( 'hide_empty_cat' ) ); ?>"><?php _e( 'Hide Empty Cat?', 'eduvibe-core' ); ?></label>
	            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hide_empty_cat' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_empty_cat' ) ); ?>" type="checkbox" value="yes" <?php checked( $hide_empty_cat, 'yes', true ); ?>/>
	        </p>

			<?php 
		}

		public function update( $new_instance, $old_instance ) {
			$instance                              = array();
			$instance['title']                     = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
			$instance['number']                    = ( ! empty( $new_instance['number'] ) ) ? strip_tags( $new_instance['number'] ) : '';
			$instance['orderby']                   = ( ! empty( $new_instance['orderby'] ) ) ? strip_tags( $new_instance['orderby'] ) : '';
			$instance['order']                     = ( ! empty( $new_instance['order'] ) ) ? strip_tags( $new_instance['order'] ) : '';
			$instance['exclude']                   = ( ! empty( $new_instance['exclude'] ) ) ? strip_tags( $new_instance['exclude'] ) : '';
			$instance['include']                   = ( ! empty( $new_instance['include'] ) ) ? strip_tags( $new_instance['include'] ) : '';
			$instance['only_top_level_categories'] = ( ! empty( $new_instance['only_top_level_categories'] ) ) ? strip_tags( $new_instance['only_top_level_categories'] ) : '';
			$instance['hide_empty_cat'] = ( ! empty( $new_instance['hide_empty_cat'] ) ) ? strip_tags( $new_instance['hide_empty_cat'] ) : '';
			return $instance;
		}

	}
endif;