<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for counterup.
 *
 * @since 1.0.0
 */
class Section_Title extends Widget_Base {

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
		return 'eduvibe-section-title';
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
		return __( 'Section Title', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-heading';
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
		return [ 'eduvibe', 'section', 'title', 'heading' ];
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
            'section_title',
            [
                'label' => __( 'Content', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'pre_title',
            [
                'label'       => __( 'Pre Title', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'PRE TITLE' , 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Add Your Section Title Text' , 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'   => __( 'Subtitle', 'eduvibe-core' ),
                'type'    => Controls_Manager::WYSIWYG
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'eduvibe-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'toggle'         => false,
                'label_block'    => false,
                'default'        => 'text-center',
                'options'        => [
                    'left' => [
                        'title'  => __( 'Left', 'eduvibe-core' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'eduvibe-core' ),
                        'icon'   => 'eicon-h-align-center'
                    ],
                    'right'   => [
                        'title'  => __( 'Right', 'eduvibe-core' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .section-title' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'pre_title_style',
            [
                'label'      => __( 'Pre Title', 'eduvibe-core' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'pre_title!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'selector' => '{{WRAPPER}} .section-title .pre-title'
            ]
        );

        $this->add_control(
          'label_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => $primary_color,
                'selectors' => [
                    '{{WRAPPER}} .section-title .pre-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label'      => __( 'Title', 'eduvibe-core' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'title!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .section-title .title'
            ]
        );

        $this->add_control(
          'title_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title .title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label'       => __( 'Spacing', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,        
                'selectors'   => [
                    '{{WRAPPER}} .section-title .title' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'sub_title_style',
            [
                'label'      => __( 'Sub Title', 'eduvibe-core' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'condition'  => [
                    'sub_title!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .section-title .section-description, {{WRAPPER}} .section-title p'
            ]
        );

        $this->add_control(
          'sub_title_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .section-title .section-description, {{WRAPPER}} .section-title p' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'sub_title_spacing',
            [
                'label'       => __( 'Spacing', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,        
                'selectors'   => [
                    '{{WRAPPER}} .section-title .section-description' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
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
        $this->add_render_attribute( 'wrapper', 'class', 'section-title' );

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
            echo $settings['pre_title'] ? '<span class="pre-title">' . esc_html( $settings['pre_title'] ) . '</span>' : '';
            echo $settings['title'] ? '<h3 class="title">' . wp_kses_post( $settings['title'] ) . '</h3>' : '';
            if ( ! empty( $settings['sub_title'] ) ) {
                echo '<div class="section-description">';
                    echo wp_kses_post($settings['sub_title']);
                echo '</div>';
            }
        echo '</div>';
    }
}