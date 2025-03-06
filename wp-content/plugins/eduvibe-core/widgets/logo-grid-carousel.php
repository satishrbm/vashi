<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for image carousel.
 *
 * @since 1.0.0
 */
class Image_Carousel extends Widget_Base {
    use \EduVibe_Core\Traits\Slider_Arrows;
    use \EduVibe_Core\Traits\Slider_Dots;
    use \EduVibe_Core\Traits\Slider;

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
        return 'eduvibe-image-grid-carousel';
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
        return __( 'Image/Logo Grid/Carousel', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-testimonial-carousel';
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
        return [ 'eduvibe', 'logo', 'carousel', 'branding', 'brands', 'image', 'thumbnail', 'company', 'image carousel', 'logo carousel', 'slider' ];
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
    protected $tablet_max_slider      = 4;
    protected $tablet_default_slider  = 3;
    protected $mobile_max_slider      = 3;
    protected $mobile_default_slider  = 1;
    private $default_display_type     = 'slider';
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
            'section_image_carousel',
            [
                'label' => __( 'Image ', 'eduvibe-core' )
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label'   => __( 'Image', 'eduvibe-core' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src()
                ]
            ]
        );

        $repeater->add_control(
            'specific_image_size',
            [
                'label'        => __( 'Specific Image Size', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'return_value' => 'yes',
                'condition' => [
                    'image[url]!' => ''
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'each_image_size',
                'default'   => 'medium_large',
                'condition' => [
                    'image[url]!'         => '',
                    'specific_image_size' => 'yes'
                ]
            ]
        );
        
        $this->add_control(
            'images',
            [
                'label'   => esc_html__( 'Image Carousel', 'eduvibe-core' ),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [ 'image' => Utils::get_placeholder_image_src() ],
                    [ 'image' => Utils::get_placeholder_image_src() ],
                    [ 'image' => Utils::get_placeholder_image_src() ],
                    [ 'image' => Utils::get_placeholder_image_src() ],
                    [ 'image' => Utils::get_placeholder_image_src() ]
                ]   
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image_size',
                'separator' => 'before',
                'default'   => 'medium_large'
            ]
        );

        $this->end_controls_section();

        $this->settings();

        $this->start_controls_section(
            'container_style',
            [
                'label' => __( 'Container', 'eduvibe-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'container_spacing',
            [
                'label'         => __( 'Spacing', 'eduvibe-core' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 100
                    ]
                ],              
                'selectors'     => [
                    '{{WRAPPER}} .eduvibe-image-carousel-wrapper'                                     => 'margin: 0 calc(-{{SIZE}}{{UNIT}}/2);',
                    '{{WRAPPER}} .eduvibe-image-carousel-wrapper .eduvibe-image-carousel-single-item' => 'padding: 0 calc({{SIZE}}{{UNIT}}/2);'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label' => __( 'Image', 'eduvibe-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'primary_button_border',
                'selector' => '{{WRAPPER}} .eduvibe-image-carousel-single-item img'
            ]
        );
        
        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __( 'Border radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-image-carousel-single-item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .eduvibe-image-carousel-single-item img'
            ]
        );

        $this->end_controls_section();

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
        $settings     = $this->get_settings_for_display();
        $direction = is_rtl() ? 'true' : 'false';

        $this->add_render_attribute( 
            'container', 
            [ 
                'class'                   => 'eduvibe-image-carousel-wrapper eduvibe-slider-item',
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

        if ( 'yes' === $settings['centermode'] ) :
            $centerModePadding = $settings['centerpadding']['size'];
            $centerModePadding .= $settings['centerpadding']['unit'];
            $this->add_render_attribute( 'container', 'data-centermode', 'true' );
            $this->add_render_attribute( 'container', 'data-centerpadding', $centerModePadding );
        endif;

        if ( 'yes' === $settings['loop'] ) :
            $this->add_render_attribute( 'container', 'data-loop', 'true' );
        endif;

        if ( 'arrows' === $settings['arrows_and_dots'] || 'both' === $settings['arrows_and_dots'] ) :
            $this->add_render_attribute( 'container', 'data-arrow-prev', esc_attr( $settings['arrows_prev_icon']['value'] ) );
            $this->add_render_attribute( 'container', 'data-arrow-next', esc_attr( $settings['arrows_next_icon']['value'] ) );
        endif;

        if ( is_array( $settings['images'] ) ) :
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                foreach ( $settings['images'] as $item ) :
                    $image = $item['image'];
                    if ( 'yes' === $item['specific_image_size'] ) :
                        $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'each_image_size', $item );
                    else :
                        $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'image_size', $settings );
                    endif;
                    if ( empty( $image_src_url ) ) :
                        $image_url = $image['url'];
                    else :
                        $image_url = $image_src_url;
                    endif;

                    echo '<div class="eduvibe-image-carousel-single-item">';
                        echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $item['image'] ) . '">';
                    echo '</div>';                      
                endforeach;
            echo '</div>';
        endif;
    }
}