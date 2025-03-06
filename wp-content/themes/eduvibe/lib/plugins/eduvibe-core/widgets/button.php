<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for counterup.
 *
 * @since 1.0.0
 */
class Button extends Widget_Base {

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
		return 'eduvibe-button';
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
		return __( 'Button / Dual Button', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-button';
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
		return [ 'eduvibe', 'button', 'dual', 'link', 'url', 'btn', 'cta' ];
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

  		$this->start_controls_section(
            'section_buttons',
            [
                'label' => __( 'Buttons', 'eduvibe-core' )
            ]
        );

        $this->start_controls_tabs( 'button_content_tabs' );
            $icon_position = is_rtl() ? 'before' : 'after';

            $this->start_controls_tab( 'primary_button_tab', [ 'label' => __( 'Primary', 'eduvibe-core' ) ] );

            $this->add_control(
                'primary_button',
                [
                    'label'       => __( 'Text', 'eduvibe-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => __( 'Get Started', 'eduvibe-core' ),
                    'placeholder' => __( 'Enter button text.', 'eduvibe-core' )
                ]
            );

            $this->add_control(
                'primary_button_url',
                [
                    'label'         => __( 'Link', 'eduvibe-core' ),
                    'type'          => Controls_Manager::URL,
                    'label_block'   => true,
                    'show_external' => true,
                    'placeholder'   => __( 'https://your-link.com', 'eduvibe-core' ),
                    'dynamic'        => [
                        'active'     => true
                    ],
                    'default'         => [
                        'url'         => '#',
                        'is_external' => ''
                    ]
                ]
            );

            $this->add_control(
                'primary_button_icon',
                [
                    'label'   => __( 'Icon', 'eduvibe-core' ),
                    'type'    => Controls_Manager::ICONS,
                    'default'     => [
                        'value'   => 'icon-arrow-right-line-right',
                        'library' => 'eduvibe-custom-icons'
                    ]
                ]
            );

            $this->add_control(
                'primary_button_icon_position',
                [
                    'label'   => __( 'Icon Position', 'eduvibe-core' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => $icon_position,
                    'options' => [
                        'before' => __( 'Before',   'eduvibe-core' ),
                        'after'  => __( 'After',    'eduvibe-core' )
                    ],
                    'condition'   => [
                        'primary_button_icon[value]!' => ''
                    ]
                ]
            );

            $this->add_responsive_control(
                'primary_button_icon_indent',
                [
                    'label'       => __( 'Icon Spacing', 'eduvibe-core' ),
                    'type'        => Controls_Manager::SLIDER,
                    'size_units'  => [ 'px' ],
                    'range'       => [
                        'px'      => [
                            'max' => 50
                        ]
                    ],
                    'default'     => [
                        'size'    => 10
                    ],
                    'selectors'   => [
                        '{{WRAPPER}} .eduvibe-primary-button-icon-position-before i, {{WRAPPER}} .eduvibe-primary-button-icon-position-before svg' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .eduvibe-primary-button-icon-position-after i, {{WRAPPER}} .eduvibe-primary-button-icon-position-after svg'  => 'margin-left: {{SIZE}}{{UNIT}};'
                    ],
                    'condition'   => [
                        'primary_button_icon[value]!' => ''
                    ]
                ]
            );

            $this->add_responsive_control(
                'primary_button_icon_top_spacing',
                [
                    'label'       => __( 'Icon Top Spacing', 'eduvibe-core' ),
                    'type'        => Controls_Manager::SLIDER,
                    'size_units'  => [ 'px' ],
                    'range'       => [
                        'px'      => [
                            'max' => 50
                        ]
                    ],
                    'selectors'   => [
                        '{{WRAPPER}} .eduvibe-primary-button-icon-position-before i, {{WRAPPER}} .eduvibe-primary-button-icon-position-before svg, {{WRAPPER}} .eduvibe-primary-button-icon-position-after i, {{WRAPPER}} .eduvibe-primary-button-icon-position-after svg'  => 'top: {{SIZE}}{{UNIT}};'
                    ],
                    'condition'   => [
                        'primary_button_icon[value]!' => ''
                    ]
                ]
            );

            $this->add_control(
                'primary_button_type',
                [
                    'label'   => __( 'Style', 'eduvibe-core' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'fill',
                    'options' => [
                        'fill'     => __( 'Fill',   'eduvibe-core' ),
                        'bordered' => __( 'Bordered',    'eduvibe-core' )
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'secondary_button_tab', [ 'label' => __( 'Secondary', 'eduvibe-core' ) ] );

            $this->add_control(
                'secondary_button',
                [
                    'label'       => __( 'Text', 'eduvibe-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'placeholder' => __( 'Enter button text.', 'eduvibe-core' )
                ]
            );

            $this->add_control(
                'secondary_button_url',
                [
                    'label'         => __( 'Link', 'eduvibe-core' ),
                    'type'          => Controls_Manager::URL,
                    'label_block'   => true,
                    'show_external' => true,
                    'placeholder'   => __( 'https://your-link.com', 'eduvibe-core' ),
                    'dynamic'        => [
                        'active'     => true
                    ],
                    'default'       => [
                        'url'         => '#',
                        'is_external' => ''
                    ]
                ]
            );

            $this->add_control(
                'secondary_button_icon',
                [
                    'label'   => __( 'Icon', 'eduvibe-core' ),
                    'type'    => Controls_Manager::ICONS
                ]
            );

            $this->add_control(
                'secondary_button_icon_position',
                [
                    'label'   => __( 'Icon Position', 'eduvibe-core' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => $icon_position,
                    'options' => [
                        'before' => __( 'Before',   'eduvibe-core' ),
                        'after'  => __( 'After',    'eduvibe-core' )
                    ],
                    'condition'   => [
                        'secondary_button_icon[value]!' => ''
                    ]
                ]
            );

            $this->add_responsive_control(
                'secondary_button_icon_indent',
                [
                    'label'       => __( 'Icon Spacing', 'eduvibe-core' ),
                    'type'        => Controls_Manager::SLIDER,
                    'size_units'  => [ 'px' ],
                    'range'       => [
                        'px'      => [
                            'max' => 50
                        ]
                    ],
                    'default'     => [
                        'size'    => 10
                    ],
                    'selectors'   => [
                        '{{WRAPPER}} .eduvibe-secondary-button-icon-position-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .eduvibe-secondary-button-icon-position-after i'  => 'margin-left: {{SIZE}}{{UNIT}};'
                    ],
                    'condition'   => [
                        'secondary_button_icon[value]!' => ''
                    ]
                ]
            );

            $this->add_responsive_control(
                'secondary_button_icon_top_spacing',
                [
                    'label'       => __( 'Icon Top Spacing', 'eduvibe-core' ),
                    'type'        => Controls_Manager::SLIDER,
                    'size_units'  => [ 'px' ],
                    'range'       => [
                        'px'      => [
                            'max' => 50
                        ]
                    ],
                    'selectors'   => [
                        '{{WRAPPER}} .eduvibe-secondary-button-icon-position-before i, {{WRAPPER}} .eduvibe-secondary-button-icon-position-after i'  => 'top: {{SIZE}}{{UNIT}};'
                    ],
                    'condition'   => [
                        'secondary_button_icon[value]!' => ''
                    ]
                ]
            );

            $this->add_control(
                'secondary_button_type',
                [
                    'label'   => __( 'Style', 'eduvibe-core' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'bordered',
                    'options' => [
                        'fill'     => __( 'Fill',   'eduvibe-core' ),
                        'bordered' => __( 'Bordered',    'eduvibe-core' )
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'container_style',
            [
                'label' => __( 'Container', 'eduvibe-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'eduvibe-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'flex-start' => [
                        'title'  => __( 'Left', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'flex-end'   => [
                        'title'  => __( 'Right', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .eduvibe-button-widget-wrapper' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $spacing = is_rtl() ? 'left' : 'right';
        $this->add_responsive_control(
            'inner_spacing',
            [
                'label'        => __( 'Inner Spacing', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'range'        => [
                    'px'       => [
                        'min'  => 0,
                        'step' => 1,
                        'max'  => 100
                    ]
                ],
                'default'      => [
                    'size'     => 20
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-primary-button' => 'margin-' . $spacing . ': {{SIZE}}{{UNIT}};'
                ],
                'condition'    => [
                    'secondary_button!' => ''
                ]
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'default'    => [
                    'top'      => '14.5',
                    'right'    => '31',
                    'bottom'   => '14.5',
                    'left'     => '31',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-button-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'primary_button_style',
            [
                'label'     => __( 'Primary', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'primary_button!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'primary_button_text_typography',
                'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button'
            ]
        );

        $this->add_responsive_control(
            'primary_button_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'primary_button_style_tabs' );

            $this->start_controls_tab( 'primary_button_normal', [ 'label' => __( 'Normal', 'eduvibe-core' ) ] );

            $this->add_control(
                'primary_button_color',
                [
                    'label'     => __( 'Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-fill, {{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-bordered' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'primary_button_bg_color',
                [
                    'label'     => __( 'Background Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-fill, {{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-bordered' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'primary_button_border',
                    'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-fill, {{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-bordered'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'primary_button_box_shadow',
                    'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-fill, {{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-bordered'
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'primary_button_hover', [ 'label' => __( 'Hover', 'eduvibe-core' ) ] );

            $this->add_control(
                'primary_button_hover_color',
                [
                    'label'     => __( 'Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-fill:hover, {{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-bordered:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'primary_button_hover_bg_color',
                [
                    'label'     => __( 'Background Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-fill:hover, {{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-bordered:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'primary_button_hover_border',
                    'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-fill:hover, {{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-bordered:hover'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'primary_button_hover_box_shadow',
                    'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-fill:hover, {{WRAPPER}} a.eduvibe-button-item.eduvibe-primary-button.eduvibe-button-type-bordered:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'secondary_button_style',
            [
                'label'     => __( 'Secondary', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'secondary_button!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'secondary_button_text_typography',
                'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button'
            ]
        );

        $this->add_responsive_control(
            'secondary_button_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'secondary_button_style_tabs' );

            $this->start_controls_tab( 'secondary_button_normal', [ 'label' => __( 'Normal', 'eduvibe-core' ) ] );

            $this->add_control(
                'secondary_button_color',
                [
                    'label'     => __( 'Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-fill, {{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-bordered' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'secondary_button_bg_color',
                [
                    'label'     => __( 'Background Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-fill, {{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-bordered' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'secondary_button_border',
                    'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-fill, {{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-bordered'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'secondary_button_box_shadow',
                    'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-fill, {{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-bordered'
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'secondary_button_hover', [ 'label' => __( 'Hover', 'eduvibe-core' ) ] );

            $this->add_control(
                'secondary_button_hover_color',
                [
                    'label'     => __( 'Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-fill:hover, {{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-bordered:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'secondary_button_hover_bg_color',
                [
                    'label'     => __( 'Background Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-bordered:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'secondary_button_hover_border',
                    'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-fill:hover, {{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-bordered:hover'
                ]
            );

            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'secondary_button_hover_box_shadow',
                    'selector' => '{{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-fill:hover, {{WRAPPER}} a.eduvibe-button-item.eduvibe-secondary-button.eduvibe-button-type-bordered:hover'
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

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

        $this->add_render_attribute(
            'primary',
            [
                'class' => [
                    'eduvibe-button-item eduvibe-primary-button',
                    'eduvibe-button-type-' . esc_attr( $settings['primary_button_type'] ),
                    'eduvibe-primary-button-icon-position-' . esc_attr( $settings['primary_button_icon_position'] )
                ]
            ]
        );

        $this->add_render_attribute(
            'secondary',
            [
                'class' => [
                    'eduvibe-button-item eduvibe-secondary-button',
                    'eduvibe-button-type-' . esc_attr( $settings['secondary_button_type'] ),
                    'eduvibe-secondary-button-icon-position-' . esc_attr( $settings['secondary_button_icon_position'] )
                ]
            ]
        );

        if ( $settings['primary_button_url']['url'] ) :
            $this->add_render_attribute( 'primary', 'href', esc_url( $settings['primary_button_url']['url'] ) );
            if ( $settings['primary_button_url']['is_external'] ) :
                $this->add_render_attribute( 'primary', 'target', '_blank' );
            endif;
            if ( $settings['primary_button_url']['nofollow'] ) :
                $this->add_render_attribute( 'primary', 'rel', 'nofollow' );
            endif;
        endif;

        if ( $settings['secondary_button_url']['url'] ) :
            $this->add_render_attribute( 'secondary', 'href', esc_url( $settings['secondary_button_url']['url'] ) );
            if ( $settings['secondary_button_url']['is_external'] ) :
                $this->add_render_attribute( 'secondary', 'target', '_blank' );
            endif;
            if ( $settings['secondary_button_url']['nofollow'] ) :
                $this->add_render_attribute( 'secondary', 'rel', 'nofollow' );
            endif;
        endif;

        echo '<div class="eduvibe-button-widget-wrapper">';
            if ( '' !== $settings['primary_button'] ) :
                echo '<a ' . $this->get_render_attribute_string( 'primary' ) . '>';
                    if ( 'before' === $settings['primary_button_icon_position'] && ! empty( $settings['primary_button_icon']['value'] ) ) :
                        Icons_Manager::render_icon( $settings['primary_button_icon'] );
                    endif;
                    echo esc_html( $settings['primary_button'] );
                    if ( 'after' === $settings['primary_button_icon_position'] && ! empty( $settings['primary_button_icon']['value'] ) ) :
                        Icons_Manager::render_icon( $settings['primary_button_icon'] );
                    endif;
                echo '</a>';
            endif;
            if ( '' !== $settings['secondary_button'] ) :
            echo '<a ' . $this->get_render_attribute_string( 'secondary' ) . '>';
                if ( 'before' === $settings['secondary_button_icon_position'] && ! empty( $settings['secondary_button_icon']['value'] ) ) :
                    Icons_Manager::render_icon( $settings['secondary_button_icon'] );
                endif;
                echo esc_html( $settings['secondary_button'] );
                if ( 'after' === $settings['secondary_button_icon_position'] && ! empty( $settings['secondary_button_icon']['value'] ) ) :
                    Icons_Manager::render_icon( $settings['secondary_button_icon'] );
                endif;
            echo '</a>';
            endif;
        echo '</div>';
    }
}