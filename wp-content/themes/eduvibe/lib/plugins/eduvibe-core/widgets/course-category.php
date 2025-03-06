<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for course category
 *
 * @since 1.0.0
 */
class Course_Category extends Widget_Base {
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
        return 'eduvibe-course-category';
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
        return __( 'Course Category 1', 'eduvibe-core' );
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
        return [ 'eduvibe-slick' ];
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
        return [ 'eduvibe', 'category', 'static', 'taxonomy', 'lms', 'categories' ];
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
    protected $desktop_default_slider = 4;
    protected $desktop_default_grid   = 3;
    protected $tablet_max_slider      = 4;
    protected $tablet_default_slider  = 3;
    protected $tablet_default_grid    = 2;
    protected $mobile_max_slider      = 2;
    protected $mobile_default_slider  = 1;
    protected $mobile_default_grid    = 2;
    protected $taxomy_name            = 'course_category';
    protected $default_display_type, $default_content_type = 'mixed';

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
        $primary_color = eduvibe_get_config( 'primary_color', '#525FE1' );

        $this->start_controls_section(
            'section_category',
            [
                'label' => __( 'Categories', 'eduvibe-core' )
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'slug', 
            [
                'label'       => __( 'Category Slug', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'custom_title', 
            [
                'label'       => __( 'Category Custom Title', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'custom_description', 
            [
                'label'       => __( 'Category Custom Description', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'description' => __( 'Only visible at Style 1 & Style 2', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
            'custom_url', 
            [
                'label'       => __( 'Category Custom URL', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'custom_count', 
            [
                'label'       => __( 'Category Custom Count', 'eduvibe-core' ),
                'type'        => Controls_Manager::NUMBER
            ]
        );

        $repeater->add_control(
            'each_item_bg_color',
            [
                'label'     => __( 'Background Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .eduvibe-category-4 .inner' => 'background: {{VALUE}};'
                ],
                'description' => __( 'Only applicable for Style 4', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
            'thumb', 
            [
                'label'       => __( 'Image', 'eduvibe-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => Utils::get_placeholder_image_src()
                ],
                'description' => __( 'Only visible at Style 1 & Style 4', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
            'icon', 
            [
                'label'       => __( 'Icon', 'eduvibe-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid'
                ],
                'description' => __( 'Only visible at Style 2 & Style 3', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'categories',
            [
                'type'        => Controls_Manager::REPEATER,
                'title_field' => '{{slug}}',
                'fields'      => $repeater->get_controls()
            ]   
        );

        $this->add_control(
            'settings_separator_before',
            [
                'type' => Controls_Manager::DIVIDER
            ]
        );

        $this->add_control(
            'style',
            [
                'label'      => __( 'Style', 'eduvibe-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => '1',
                'options'    => [
                    '1'   => __( 'Style 1', 'eduvibe-core' ),
                    '2'   => __( 'Style 2', 'eduvibe-core' ),
                    '3'   => __( 'Style 3', 'eduvibe-core' ),
                    '4'   => __( 'Style 4', 'eduvibe-core' )
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
            'enable_category_count',
            [
                'type'          => Controls_Manager::SWITCHER,
                'label'         => __( 'Category Count', 'eduvibe-core' ),
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'       => 'yes',
                'return_value'  => 'yes'
            ]
        );

        $this->add_control(
            'course_label',
            [
                'label'       => __( 'Course Label', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Course' , 'eduvibe-core' ),
                'description' => __( 'Label for singular course( Only for 1 ).', 'eduvibe-core' ),
                'condition'   => [
                    'enable_category_count' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'courses_label',
            [
                'label'       => __( 'Courses Label', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Courses' , 'eduvibe-core' ),
                'description' => __( 'Label for plural courses.', 'eduvibe-core' ),
                'condition'   => [
                    'enable_category_count' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb_size',
                'default'   => 'full',
                'condition' => [
                    'style' => [ '1', '4' ]
                ]
            ]
        );

        $this->end_controls_section();
        
        $this->grid_settings();

        $this->settings();

        $this->arrows();

        $this->dots();
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
        $settings   = $this->get_settings_for_display();
        $direction  = is_rtl() ? 'true' : 'false';
        $categories = $settings['categories'];

        $this->add_render_attribute( 'container', 'class', 'eduvibe-course-cat-container eduvibe-course-cat-wrapper-' . esc_attr( $settings['display_type'] ) );

        if ( 'yes' === $settings['active_white_bg'] ) :
            $this->add_render_attribute( 'container', 'class', 'active-white-bg' );
        endif;

        if ( 'grid' === $settings['display_type'] ) :
            $this->add_render_attribute( 'container', 'class', 'eduvibe-row' );
        else :        
            $this->add_render_attribute( 'container', 'class', 'eduvibe-slider-item' );                
            $this->add_render_attribute( 
                'container', 
                [
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
                $this->add_render_attribute( 'container', 'class', 'arrow-position-' . esc_attr( $settings['arrows_position'] ) );
            endif;
        endif;

        if ( is_array( $categories ) ) :
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                foreach ( $categories as $key => $category ) :
                    $link_key = 'link_' . $key;

                    if ( 'grid' === $settings['display_type'] ) :
                        $grid_desktop_column = 12/$settings['desktop_grid_columns'];
                        $grid_tablet_column  = 12/$settings['tablet_grid_columns'];
                        $grid_mobile_column  = 12/$settings['mobile_grid_columns'];
                        $grid_column         = 'eduvibe-col-lg-' . esc_attr( $grid_desktop_column ) . ' eduvibe-col-md-' . esc_attr( $grid_tablet_column ) . ' eduvibe-col-sm-' . esc_attr( $grid_mobile_column );
                        $this->add_render_attribute( $link_key, 'class', $grid_column );
                    endif;

                    $this->add_render_attribute( $link_key, 'class', 'eduvibe-course-cat-single-' . esc_attr( $settings['display_type'] ) );

                    $this->add_render_attribute( $link_key, 'class', 'elementor-repeater-item-'. esc_attr( $category['_id'] ) );

                    $term = get_term_by( 'slug', $category['slug'], $this->taxomy_name );
                    $link = $category['custom_url'];
                    $count = 0;
                    $title = $category['custom_title'];
                    $description = $category['custom_description'];

                    if ( '1' === $settings['style'] || '4' === $settings['style'] ) :
                        $image         = $category['thumb'];
                        $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb_size', $settings );

                        if ( empty( $image_src_url ) ) :
                            $image_url = $image['url']; 
                        else :
                            $image_url = $image_src_url;
                        endif;
                    endif;

                    if ( $category['custom_count'] ) :
                        $count = $category['custom_count'];
                    endif;

                    if ( $term ) :
                        if ( empty( $link ) ) :
                            $link = get_term_link( $term, $this->taxomy_name );
                        endif;
                        
                        if ( empty( $title ) ) :
                            $title = $term->name;
                        endif;

                        if ( empty( $description ) ) :
                            $description = $term->description;
                        endif;
                        
                        if ( empty( $count ) ) :
                            $count = $term->count;
                        endif;
                    endif;

                    echo '<div ' . $this->get_render_attribute_string( $link_key ) . '>';
                        include EDUVIBE_PLUGIN_DIR . 'widgets/styles/category/category-' . $settings['style'] . '.php';
                    echo '</div>';
                endforeach; 
            echo '</div>';
        endif;
    }
}