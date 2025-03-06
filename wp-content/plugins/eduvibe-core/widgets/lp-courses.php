<?php

namespace EduVibeCore\LP\Widgets;

use \EduVibeCore\Helper;

if ( ! defined( 'ABSPATH' ) ) exit;

class Courses extends \EduVibeCore\Widgets\Courses {

    public function get_name() {
        return 'eduvibe-lp-courses';
    }

    public function get_keywords() {
        return [ 'eduvibe', 'query', 'courses', 'lms', 'lp', 'learnpress', 'archive', 'loop', 'grid', 'slider', 'carousel', 'filter' ];
    }

    /**
     * render the post query
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_query( $query, $settings, $single_wrapper, $uniqueid = '', $exclude_unique_ids = array() ) {
        while ( $query->have_posts() ) : $query->the_post();
            global $post;
            $course    = \LP_Global::course();
            $thumb_url = '';
            if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                $thumb_url = $this->render_image( get_post_thumbnail_id( $post->ID ), $settings );
            else :
                $thumb_url = \LP()->image( 'no-image.png' );
            endif;
            $block_data = array(
                'thumb_url' => $thumb_url,
                'style'     => $settings['style'],
            );

            if ( $settings['excerpt_length'] ) :
                $block_data['excerpt_length'] = $settings['excerpt_length'];
            endif;
            if ( ! empty( $uniqueid ) ) :
                $single_wrapper[] = $uniqueid;
            endif;
            if ( is_array( $exclude_unique_ids ) && ! empty( $exclude_unique_ids ) ) :
                $single_wrapper = array_diff( $single_wrapper, $exclude_unique_ids );
            endif;
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( $single_wrapper ); ?>>
            <?php
                learn_press_get_template( 'custom/course-block/blocks.php', compact( 'block_data' ) );
            echo '</div>';  
        endwhile;
        wp_reset_postdata();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings         = $this->get_settings_for_display();
        $category_slug    = $this->category_taxonomy;
        $style            = $settings['style'];
        $count            = 0;
        $filter_type      = '';
        $uniqueid         = time().rand( 1, 99 );
        $single_wrapper   = [];
        $single_wrapper[] = 'eduvibe-course-one-' . esc_attr( $settings['display_type'] );

        $this->add_render_attribute( 'widget_wrapper', 'class', 'eduvibe-course-widget-wrapper' );

        if ( 'grid' === $settings['display_type'] ) :
            if ( 'yes' === $settings['enable_filter'] ) :
                $filter_type = $settings['filter_type'];
                $this->add_render_attribute( 'widget_wrapper', 'class', 'eduvibe-filter-type-' . esc_attr( $filter_type ) );
                $this->add_render_attribute( 'widget_wrapper', 'id', 'eduvibe-filterable-course-id-' . $this->get_id() );

                $this->add_render_attribute(
                    'container',
                    [
                        'class' => 'eduvibe-course-filter-type-' . esc_attr( $filter_type ),
                        'id'    =>  'filters-' . esc_attr( $this->get_id() )
                    ]
                );
            endif;
        endif;

        $this->add_render_attribute( 'container', 'class', 'eduvibe-archive-lp-courses eduvibe-lms-courses-' . esc_attr( $settings['display_type'] ) );

        if ( 'yes' === $settings['active_white_bg'] ) :
            $this->add_render_attribute( 'container', 'class', 'active-white-bg' );
        endif;

        if ( 'grid' === $settings['display_type'] ) :
            $single_wrapper[] = $this->grid( $settings );
            $this->add_render_attribute( 'container', 'class', 'eduvibe-row' );

        else :
            $single_wrapper[] = 'eduvibe-post-one-single-slider';
            $this->slider( $settings );
        endif;

        if ( class_exists( 'LearnPress' ) ) :
            echo '<div ' . $this->get_render_attribute_string( 'widget_wrapper' ) . '>';
                if ( 'grid' === $settings['display_type'] ) :
                    if ( 'yes' === $settings['enable_filter'] ) :
                        echo '<div class="eduvibe-course-filter-wrapper">';
                            echo '<div class="eduvibe-filter-course eduvibe-category-controls-' . esc_attr( $settings['enable_filter'] ) . '">';

                                $all_filter_text = __( 'All', 'eduvibe-core' );
                                if ( ! empty( $settings['filter_all_text'] ) ) :
                                    $all_filter_text = $settings['filter_all_text'];
                                endif;
                                if ( 'cat-filter' === $filter_type ) :
                                    $cat_args = array(
                                        'include'    => $settings['include_categories']
                                    );

                                    $course_cats = get_terms( $category_slug, $cat_args );
                                    if ( ! empty( $course_cats ) && ! is_wp_error( $course_cats ) ) :
                                        echo '<span data-filter="*" class="filter-item current">' . esc_html( $all_filter_text ) . '</span>';
                                        foreach ( $course_cats as $course_cat ) :
                                            echo '<span class="filter-item" data-filter=".' . $category_slug . '-' . esc_attr( $course_cat->slug ) . '">' . esc_html( $course_cat->name ) . '</span>';
                                        endforeach;
                                    endif;
                                else :
                                    $nav_items = array(
                                        'recent'   => __( 'New Courses', 'eduvibe-core' ),
                                        'featured' => __( 'Featured Courses', 'eduvibe-core' ),
                                        'popular'  => __( 'Popular Courses', 'eduvibe-core' )
                                    );
                                    foreach ( $nav_items as $key => $value ) :
                                        echo '<span class="filter-item">' . esc_html( $value ) . '</span>';
                                    endforeach;
                                endif;
                            echo '</div>';
                        echo '</div>';
                    endif;
                endif;
                if ( 'tab-filter' !== $filter_type ) :
                    echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                        $wp_query = new \WP_Query( Helper::query_args( $settings, $this->post_type, $this->category_taxonomy, $this->get_name() ) );
                        $this->render_query( $wp_query, $settings, $single_wrapper );
                    echo '</div>';
                elseif ( 'tab-filter' === $filter_type && 'grid' === $settings['display_type'] && 'yes' === $settings['enable_filter'] ) :
                    $this->add_render_attribute( 'container', 'class', 'eduvibe-course-tab-content eduvibe-fade' );

                    $recent_args = array(
                        'post_type'      => $this->post_type,
                        'post_status'    => 'publish',
                        'posts_per_page' => $settings['per_page']['size']
                    );
                    $query_recent = new \WP_Query( $recent_args );

                    $featured_args = array(
                        'post_type'      => $this->post_type,
                        'posts_per_page' => $settings['per_page']['size'],
                        'meta_key'       => '_lp_featured',
                        'meta_value'     => 'yes',
                        'post_status'    => 'publish',
                        'orderby'        => 'title',
                        'order'          => 'ASC'
                    );
                    $query_featured = new \WP_Query( $featured_args );

                    $popular_args = array(
                        'post_type'      => $this->post_type,
                        'posts_per_page' => $settings['per_page']['size'],
                        'meta_key'       => '_lp_students',
                        'post_status'    => 'publish',
                        'orderby'        => 'meta_value_num',
                        'order'          => 'DESC'
                    );
                    $query_popular = new \WP_Query( $popular_args );

                    echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                        $this->render_query( $query_recent, $settings, $single_wrapper, $uniqueid . 'recent' );
                    echo '</div>';

                    echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                        $this->render_query( $query_featured, $settings, $single_wrapper, $uniqueid . 'featured', array( $uniqueid . 'recent' ) );
                        echo '</div>';

                    echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                        $this->render_query( $query_popular, $settings, $single_wrapper, $uniqueid . 'popular', array( $uniqueid . 'recent', $uniqueid . 'featured' ) );
                    echo '</div>';
                endif;
            echo '</div>';
        endif;

        // if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) :
        //     $this->render_editor_script();
        // endif;
    }
}