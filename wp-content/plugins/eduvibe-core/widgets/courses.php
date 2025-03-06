<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for post.
 *
 * @since 1.0.0
 */
class Courses extends Widget_Base {
    use \EduVibe_Core\Traits\Posts;
    use \EduVibe_Core\Traits\Slider_Arrows;
    use \EduVibe_Core\Traits\Slider_Dots;
    use \EduVibe_Core\Traits\Grid, \EduVibe_Core\Traits\Slider {
        \EduVibe_Core\Traits\Slider::settings insteadof \EduVibe_Core\Traits\Grid;
        \EduVibe_Core\Traits\Grid::settings as grid_settings;
    }

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
        return 'eduvibe-courses';
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
        return __( 'Courses( Grid / Carousel / Filter )', 'eduvibe-core' );
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
        return 'eicon-posts-grid eduvibe-elementor-icon';
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return [ 'eduvibe-slick', 'jquery-isotope' ];
    }

    /**
     * Get style dependencies.
     *
     * Retrieve the list of style dependencies the element requires.
     *
     * @since 1.9.0
     * @access public
     *
     * @return array Element styles dependencies.
     */
    public function get_style_depends() {
        return [ 'eduvibe-slick' ];
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

    protected $desktop_max_slider     = 6;
    protected $desktop_default_slider = 3;
    protected $desktop_default_grid   = 3;
    protected $tablet_max_slider      = 3;
    protected $tablet_default_slider  = 2;
    protected $tablet_default_grid    = 2;
    protected $mobile_max_slider      = 2;
    protected $mobile_default_slider  = 1;
    protected $mobile_default_grid    = 1;
    protected $post_type              = LP_COURSE_CPT;
    protected $category_taxonomy      = 'course_category';
    protected $default_content_type, $default_display_type;

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
            'section_courses',
            [
                'label' => __( 'Courses', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __( 'Style', 'eduvibe-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __( 'One', 'eduvibe-core' ),
                    '2' => __( 'Two', 'eduvibe-core' ),
                    '3' => __( 'Three', 'eduvibe-core' ),
                    '4' => __( 'Four', 'eduvibe-core' ),
                    '5' => __( 'Five', 'eduvibe-core' ),
                    '6' => __( 'Six', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'display_type',
            [
                'label'      => __( 'Display Type', 'eduvibe-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => 'grid',
                'options'    => [
                    'grid'   => __( 'Grid', 'eduvibe-core' ),
                    'slider' => __( 'Slider', 'eduvibe-core' )
                ]
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

        $this->add_control(
            'enable_filter',
            [
                'label'        => __( 'Filter', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'display_type' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'container_alert_text',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __( '<strong>The Filtering might not work on the Elementor Editor Page. But, it\'ll definitely work on the FrontEnd of your site.</strong>', 'eduvibe-core' ),
                'content_classes' => 'eduvibe-elementor-widget-alert elementor-panel-alert elementor-panel-alert-info',
                'condition'         => [
                    'enable_filter' => 'yes',
                    'display_type'  => 'grid'
                ]
            ]
        );

        $all_text_condition = [
            'enable_filter' => 'yes',
            'display_type'    => 'grid'
        ];
        if ( 'eduvibe-lp-courses' === $this->get_name() ) :
            $this->add_control(
                'filter_type',
                [
                    'label'             => __( 'Filter Type', 'eduvibe-core' ),
                    'type'              => Controls_Manager::SELECT,
                    'label_block'       => true,
                    'default'           => 'cat-filter',
                    'options'           => [
                        'cat-filter'    => __( 'Category Filtering', 'eduvibe-core' ),
                        'tab-filter'    => __( 'Filter by New/ Featured/ Popular',   'eduvibe-core' )
                    ],
                    'condition'         => [
                        'enable_filter' => 'yes',
                        'display_type'  => 'grid'
                    ]
                ]
            );
            $all_text_condition = [
                'enable_filter' => 'yes',
                'display_type'    => 'grid',
                'filter_type'     => 'cat-filter'
            ];
        endif;

        $this->add_control(
            'filter_all_text',
            [   
                'label'     => __( 'Text for All Courses', 'eduvibe-core' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'All', 'eduvibe-core' ),
                'condition' => $all_text_condition
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
                        'min'  => 200,
                        'step' => 10,
                        'max'  => 800
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-single-course .course-image, {{WRAPPER}} .eduvibe-single-course.course-style-two .course-image, {{WRAPPER}} .eduvibe-single-course.course-style-three .course-image, {{WRAPPER}} .eduvibe-single-course.course-style-four .course-image, {{WRAPPER}} .eduvibe-single-course.course-style-five .course-image' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label'       => __( 'Number of Words', 'eduvibe-core' ),
                'type'        => Controls_Manager::NUMBER,
                'description' => __( 'Number of excerpt words.', 'eduvibe-core' ),
                'condition'   => [
                    'style' => [ '4', '6' ]
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'control_style',
            [
                'label'     => __( 'Control', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_filter' => 'yes',
                    'display_type'  => 'grid'
                ]
            ]
        );

        $this->add_responsive_control(
            'control_alignment',
            [
                'label'          => __( 'Control Alignment', 'eduvibe-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .eduvibe-filter-course' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'control_margin',
            [
                'label'        => __( 'Margin', 'eduvibe-core' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', 'em', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-filter-course' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );  

        $this->end_controls_section();

        $this->query();

        $this->grid_settings();

        $this->settings();

    }

    /**
     * return course featured image
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image( $image_id, $settings ) {
        $image_size = $settings['thumb_size_size'];
        if ( 'custom' === $image_size ) :
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'thumb_size', $settings );
        else :
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        endif;
        return $image_src;
    }

    /**
     * return number of courses to show for load more button
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function load_more_button_page_number( $settings ) {
        global $wp_query;
        $number_of_posts = $settings['per_page']['size'];
        return $wp_query->$number_of_posts;
    }

    /**
     * return grid columns
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function grid( $settings ) {
        $grid_desktop_column = 12/$settings['desktop_grid_columns'];
        $grid_tablet_column  = 12/$settings['tablet_grid_columns'];
        $grid_mobile_column  = 12/$settings['mobile_grid_columns'];
        $grid_column         = 'eduvibe-col-lg-' . esc_attr( $grid_desktop_column ) . ' eduvibe-col-md-' . esc_attr( $grid_tablet_column ) . ' eduvibe-col-sm-' . esc_attr( $grid_mobile_column );
        return $grid_column;
    }

    /**
     * render slider settings
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function slider( $settings ) {
        $direction  = is_rtl() ? 'true' : 'false';
        $this->add_render_attribute( 
            'container', 
            [
                'class'                   => 'eduvibe-slider-item',
                'data-slidestoshow'       => intval( esc_attr( $settings['desktop_columns']['size'] ) ),
                'data-tablet-items'       => intval( esc_attr( $settings['tablet_columns']['size'] ) ),
                'data-mobile-items'       => intval( esc_attr( $settings['mobile_columns']['size'] ) ), 
                'data-small-mobile-items' => intval( esc_attr( $settings['small_mobile_columns']['size'] ) ),
                'data-slidestoscroll'     => intval( esc_attr( $settings['slides_to_scroll']['size'] ) ),
                'data-speed'              => intval( esc_attr( $settings['transition_duration'] ) ),
                'data-navigation'         => esc_attr( $settings['arrows_and_dots'] ),
                'data-direction'          => esc_attr( $direction )
            ]
        );

        if ( 'yes' === $settings['autoplay'] ) :
            $this->add_render_attribute( 'container', 'data-autoplay', 'true' );
            $this->add_render_attribute( 'container', 'data-autoplayspeed', intval( esc_attr( $settings['autoplay_speed'] ) ) );
            if ( 'yes' === $settings['pause'] ) :
                $this->add_render_attribute( 'container', 'data-pauseonhover', 'true' );
            endif;
        endif;

        if ( 'yes' === $settings['loop'] ) :
            $this->add_render_attribute( 'container', 'data-loop', 'true' );
        endif;

        if ( 'arrows' === $settings['arrows_and_dots'] || 'both' === $settings['arrows_and_dots'] ) :
            $this->add_render_attribute( 'container', 'data-arrow-prev', esc_attr( $settings['arrows_prev_icon']['value'] ) );
            $this->add_render_attribute( 'container', 'data-arrow-next', esc_attr( $settings['arrows_next_icon']['value'] ) );
        endif;
    }

    /**
     * print jquery script for course filter
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_editor_script() { 
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($) {
                if ( $.isFunction( $.fn.isotope ) ) {
                    $( '.eduvibe-filter-type-cat-filter' ).each( function() {
                        let wrapper = $( this ).find( '.eduvibe-course-filter-type-cat-filter' ),
                        courseItem  = '#' + $(this).attr( 'id' );
                        wrapper.isotope( {
                            filter: '*',
                            animationOptions: {
                                queue: true
                            }
                        } );

                        $( courseItem + ' .eduvibe-category-controls-yes span' ).click(function(){
                            $( courseItem + ' .eduvibe-category-controls-yes span.current' ).removeClass( 'current' );
                            $(this).addClass('current');
                     
                            let selector = $(this).attr( 'data-filter' );
                            wrapper.isotope( {
                                filter: selector,
                                animationOptions: {
                                    queue: true
                                }
                            } );
                            return false;
                        } );
                    } );
                }
            } );
        </script>
        <?php
    }
}