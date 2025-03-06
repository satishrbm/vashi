<?php

namespace EduVibeCore\Widgets;

use \EduVibeCore\Helper;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for event 2.
 *
 * @since 1.0.0
 */
class Events_Two extends Widget_Base {
    use \EduVibe_Core\Traits\Posts;

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'eduvibe-events-two';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Events 2( List )', 'eduvibe-core' );
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eduvibe-elementor-icon eicon-sitemap';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return [ 'eduvibe', 'events', 'meetup', 'online', 'conversation' ];
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'eduvibe_elementor_widgets' ];
    }

    protected $post_type            = 'simple_event';
    protected $category_taxonomy    = 'simple_event_category';
    protected $default_content_type;

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_posts',
            [
                'label' => __( 'Event', 'eduvibe-core' )
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb_size',
                'default'   => 'eduvibe-post-thumb'
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'        => __( 'Image Height', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 100,
                        'step' => 10,
                        'max'  => 600
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-event-two-item-single .event-image img' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'button_text',
            [
                'type'         => Controls_Manager::TEXT,
                'label'        => __( 'Button Text', 'eduvibe-core' ),
                'default'      => __( 'Book A Seat', 'eduvibe-core' ),
            ]
        );

        $this->add_control(
			'active_white_bg', [
				'label'        => __( 'Active White Background', 'eduvibe-core' ),
				'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

        $this->end_controls_section();

        $this->query();
    }

    /**
     * return post featured image
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image( $image_id, $settings ) {
        $image_size = $settings['thumb_size_size'];
        if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
            if ( 'custom' === $image_size ) :
                $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'thumb_size', $settings );
            else :
                $image_src = wp_get_attachment_image_src( $image_id, $image_size );
                $image_src = $image_src[0];
            endif;
        else :
            $image_src = '';
        endif;
        return $image_src;
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
        $settings      = $this->get_settings_for_display();
        $direction     = is_rtl() ? 'true' : 'false';

        $this->add_render_attribute( 'container-wrapper', 'class', 'eduvibe-event-wrapper eduvibe-event-list-wrapper' );
        if ( 'yes' === $settings['active_white_bg'] ) :
            $this->add_render_attribute( 'container-wrapper', 'class', 'active-white-bg' );
        endif;

        $wp_query = new \WP_Query( Helper::query_args( $settings, $this->post_type, $this->category_taxonomy ) );
        
        if ( $wp_query->have_posts() ) :
            echo '<div ' . $this->get_render_attribute_string( 'container-wrapper' ) . '>';
                while ( $wp_query->have_posts() ) : $wp_query->the_post();
                    global $post;
                    $the_id    = get_the_ID();
                    $date      = get_post_meta( $the_id, 'eduvibe_simple_event_start_date', true );
                    $end_date      = get_post_meta( $the_id, 'eduvibe_simple_event_end_date', true );
                    $time      = get_post_meta( $the_id, 'eduvibe_simple_event_start_time', true );
                    $end_time      = get_post_meta( $the_id, 'eduvibe_simple_event_end_time', true );
                    $latitude  = get_post_meta( $the_id, 'eduvibe_simple_event_latitude', true );
                    $longitude = get_post_meta( $the_id, 'eduvibe_simple_event_longitude', true );
                    $perticipant = get_post_meta( $the_id, 'eduvibe_simple_event_perticipant', true );
                    $price = get_post_meta( $the_id, 'eduvibe_simple_event_price', true );
                    $purchase_link = get_post_meta( $the_id, 'eduvibe_simple_event_purchase_link', true );
                    $location = get_post_meta( $the_id, 'eduvibe_simple_event_location', true );

                    echo '<div class="edu-event event-type-list event-list edu-event-list-item radius-small">';
                        echo '<div class="inner">';
                            echo '<div class="thumbnail">';
                                if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                                    echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                                        echo '<img src="' . esc_url( $this->render_image( get_post_thumbnail_id( get_the_id() ), $settings ) ) . '" alt="' . __( 'Event Image', 'eduvibe-core' ) . '">';
                                    echo '</a>';
                                endif;
                            echo '</div>';

                            echo '<div class="content">';
                                echo '<div class="content-left">';
                                    the_title( '<h5 class="title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h5>' );

                                    if ( $date || $time || $location ) :
                                        echo '<ul class="event-meta">';
                                            echo $date ? '<li><i class="icon-calendar-2-line"></i>' . esc_html( $date ) . '</li>' : '';

                                            echo $time ? '<li><i class="icon-time-line"></i>' . esc_html( $time ) . '</li>' : '';

                                            echo $location ? '<li><i class="icon-map-pin-line"></i>' . esc_html( $location ) . '</li>' : '';
                                        echo '</ul>';
                                    endif;
                                echo '</div>';
                                
                                echo '<div class="read-more-btn">';
                                    echo '<a class="edu-btn btn-dark" href="' . esc_url( get_the_permalink() ) . '">' . esc_html( $settings['button_text'] ) . '<i class="icon-arrow-right-line-right"></i></a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                endwhile;
            echo '</div>';   
        endif;
        wp_reset_postdata();
    }
}