<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for countdown.
 *
 * @since 1.0.0
 */
class CountDown extends Widget_Base {

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
        return 'eduvibe-countdown';
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
        return __( 'Countdown', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-countdown';
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
        return [ 'eduvibe', 'count down', 'count', 'down', 'coming', 'up', 'soon', 'fast', 'times', 'days', 'hours', 'minutes', 'seconds' ];
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
        return [ 'jquery-countdown' ];
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
            'section_countdown',
            [
                'label' => __( 'CountDown', 'eduvibe-core' )
            ]
        );
        
        $this->add_control(
            'time',
            [
                'label'       => __( 'Countdown Date', 'eduvibe-core' ),
                'type'        => Controls_Manager::DATE_TIME,
                'default'     => date( 'Y/m/d', strtotime( '+ 1 week' ) ),
                'description' => __( 'Set the date and time here', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'expired_text',
            [
                'label'       => __( 'Countdown Expired Title', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Congratulations! The Wait Is Over.', 'eduvibe-core' ),
                'description' => __( 'This text will be shown when the CountDown will end.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'enable_divider',
            [
                'label'        => __( 'Divider', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'return_value' => 'yes',
                'default'      => 'yes'
            ]
        );

        $this->add_control(
            'switch_position',
            [
                'label'        => __( 'Switch Content Position', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'return_value' => 'yes',
                'default'      => 'no',
                'description'  => __( 'By enabling this option, the content position will be switched. The CountDown Digits will be placed at the bottom instead of top.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'day_text',
            [
                'label'       => __( 'Day\'s Text', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Days', 'eduvibe-core' ),
                'description' => __( 'Text for dates.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'hour_text',
            [
                'label'       => __( 'Hour\'s Text', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Hours', 'eduvibe-core' ),
                'description' => __( 'Text for hours.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'minute_text',
            [
                'label'       => __( 'Minute\'s Text', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Minutes', 'eduvibe-core' ),
                'description' => __( 'Text for minutes.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'second_text',
            [
                'label'       => __( 'Second\'s Text', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Seconds', 'eduvibe-core' ),
                'description' => __( 'Text for seconds.', 'eduvibe-core' )
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'item_style',
            [
                'label' => __( 'Item', 'eduvibe-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $direction = is_rtl() ? 'left' : 'right';

        $this->add_responsive_control(
            'item_min_width',
            [
                'label'        => __( 'Min Width', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', 'em', '%' ],
                'range'         => [
                    'px'        => [
                        'max'   => 300
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-countdown-single-item' => 'min-width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label'         => __( 'Spacing', 'eduvibe-core' ),
                'type'          => Controls_Manager::SLIDER,
                'range'         => [
                    'px'        => [
                        'max'   => 150
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .eduvibe-countdown-single-item' => 'margin-' . $direction . ': {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eduvibe-countdown-wrapper' => 'margin-bottom: -{{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'item_bg_color',
            [
                'label'     => __( 'Background', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-countdown-single-item' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'item_hover_bg_color',
            [
                'label'     => __( 'Hover Background', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-countdown-single-item:hover' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-countdown-single-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'selector' => '{{WRAPPER}} .eduvibe-countdown-single-item'
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-countdown-single-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .eduvibe-countdown-single-item'
            ]
        );

        $this->add_responsive_control(
            'container_horizontal_align',
            [
                'label'   => __( 'Horizontal Align', 'eduvibe-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    ''              => __( 'Default', 'eduvibe-core' ),
                    'flex-start'    => __( 'Start', 'eduvibe-core' ),
                    'center'        => __( 'Center', 'eduvibe-core' ),
                    'flex-end'      => __( 'End', 'eduvibe-core' ),
                    'space-between' => __( 'Space Between', 'eduvibe-core' ),
                    'space-around'  => __( 'Space Around', 'eduvibe-core' ),
                    'space-evenly'  => __( 'Space Evenly', 'eduvibe-core' )
                ],
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-countdown-wrapper' => 'justify-content: {{VALUE}}'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'divider_style',
            [
                'label'     => __( 'Divider', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'enable_divider' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'divider_color',
            [
                'label'     => __( 'Divider Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-countdown-divider-enable .eduvibe-countdown-single-item:not(:last-child):after' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'divider_size',
            [
                'label'        => __( 'Size', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-countdown-divider-enable .eduvibe-countdown-single-item:not(:last-child):after' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'divider_position_right',
            [
                'label'        => __( 'Offset X', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%' ],
                'range'        => [
                    'px'       => [
                        'min'  => -250,
                        'max'  => 250,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => -100,
                        'max'  => 100
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-countdown-divider-enable .eduvibe-countdown-single-item:not(:last-child):after' => $direction . ': {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'divider_position_left',
            [
                'label'        => __( 'Offset Y', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%' ],
                'range'        => [
                    'px'       => [
                        'min'  => -250,
                        'max'  => 250,
                        'step' => 1
                    ],
                    '%'        => [
                        'min'  => -100,
                        'max'  => 100
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-countdown-divider-enable .eduvibe-countdown-single-item:not(:last-child):after' => 'top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'countdown_style',
            [
                'label' => __( 'CountDown', 'eduvibe-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'countdown_typography',
                'selector' => '{{WRAPPER}} .eduvibe-countdown-digit'
            ]
        );

        $this->add_control(
            'countdown_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-countdown-digit' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'item_hover_countdown_color',
            [
                'label'     => __( 'Hover Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-countdown-single-item:hover .eduvibe-countdown-digit' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'countdown_margin',
            [
                'label'      => __( 'Margin', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-countdown-digit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        $this->end_controls_section();
        
        $this->start_controls_section(
            'title_style',
            [
                'label' => __( 'Title', 'eduvibe-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .eduvibe-countdown-content'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-countdown-content' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'item_hover_title_color',
            [
                'label'     => __( 'Hover Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-countdown-single-item:hover .eduvibe-countdown-content' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_bg_color',
            [
                'label'     => __( 'Background Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-countdown-content' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'title_box_shadow',
                'selector' => '{{WRAPPER}} .eduvibe-countdown-content'
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-countdown-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => __( 'Margin', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],                
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-countdown-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-countdown-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'title_enable_fixed_width',
            [
                'label'        => __( 'Fixed Width', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'return_value' => 'yes',
                'default'      => 'no'
            ]
        );

        $this->add_responsive_control(
            'title_max_width',
            [
                'label'        => __( 'Fixed Width Size', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%' ],
                'range'        => [
                    'px'       => [
                        'min'  => 25,
                        'max'  => 250,
                        'step' => 1
                    ],
                    '%'        => [
                        'max'  => 100
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-countdown-wrapper.eduvibe-countdown-title-width-enable .eduvibe-countdown-content' => 'width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto; text-align: center;'
                ],
                'condition'    => [
                    'title_enable_fixed_width' => 'yes'
                ]
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'expired_title_style',
            [
                'label'     => __( 'Expired Title', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'expired_text!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'expired_title_typography',
                'selector' => '{{WRAPPER}} p.eduvibe-countdown-over-message'
            ]
        );

        $this->add_control(
            'expired_title_color',
            [
                'label'     => __( 'Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} p.eduvibe-countdown-over-message' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $divider  = 'yes' === $settings['enable_divider'] ? 'enable' : 'disable';
        $position = 'yes' === $settings['switch_position'] ? 'enable' : 'disable';

        $this->add_render_attribute(
            'countdown',
            [
                'class'             =>
                [
                    'eduvibe-countdown-wrapper',
                    'eduvibe-countdown-divider-' . esc_attr( $divider ),
                    'eduvibe-countdown-reverse-position-' . esc_attr( $position )
                ],
                'data-day'          => esc_attr( $settings['day_text'] ),
                'data-hours'        => esc_attr( $settings['hour_text'] ),
                'data-minutes'      => esc_attr( $settings['minute_text'] ),
                'data-seconds'      => esc_attr( $settings['second_text'] ),
                'data-countdown'    => esc_attr( $settings['time'] ),
                'data-expired-text' => esc_attr( $settings['expired_text'] )
            ]
        );
        
        if ( 'yes' === $settings['enable_divider'] ) :
            $this->add_render_attribute( 'countdown', 'class', 'eduvibe-countdown-divider-enable' );
        endif;
        
        if ( 'yes' === $settings['title_enable_fixed_width'] ) :
            $this->add_render_attribute( 'countdown', 'class', 'eduvibe-countdown-title-width-enable' );
        endif;


        echo '<div ' . $this->get_render_attribute_string( 'countdown' ) . '></div>';
    }

    /**
     * Render countDown widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
            var divider, position;

            if ( 'yes' === settings.enable_divider ) {
                divider = 'enable';
            } else {
                divider = 'disable';
            }

            if ( 'yes' === settings.switch_position ) {
                position = 'enable';
            } else {
                position = 'disable';
            }

            view.addRenderAttribute( 'countdown', {
                'class': [ 
                    'eduvibe-countdown-wrapper', 
                    'eduvibe-countdown-divider-' + divider,
                    'eduvibe-countdown-reverse-position-' + position
                ]
            } );

            if ( 'yes' === settings.enable_divider ) {
                view.addRenderAttribute( 'countdown', 'class', 'eduvibe-countdown-divider-enable' );
            }

            if ( 'yes' === settings.title_enable_fixed_width ) {
                view.addRenderAttribute( 'countdown', 'class', 'eduvibe-countdown-title-width-enable' );
            }

            view.addRenderAttribute( 'countdown', {
                'data-day': settings.day_text,
                'data-minutes': settings.minute_text,
                'data-hours': settings.hour_text,
                'data-seconds': settings.second_text,
                'data-countdown': settings.time,
                'data-expired-text': settings.expired_text
            } );
        #>

        <div class="eduvibe-countdown-wrapper">
            <div {{{ view.getRenderAttributeString( 'countdown' ) }}}></div>
        </div>

        <?php
    }

}