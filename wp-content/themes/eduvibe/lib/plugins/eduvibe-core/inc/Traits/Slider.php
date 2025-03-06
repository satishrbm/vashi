<?php

namespace EduVibe_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \Elementor\Controls_Manager;

trait Slider {

	protected function settings() {
        
        if( 'slider' === $this->default_display_type ) :
            $this->start_controls_section(
                'slider_settings',
                [
                    'label' => __( 'Slider Settings', 'eduvibe-core' )
                ]
            );
        else :
            $this->start_controls_section(
                'slider_settings',
                [
                    'label'     => __( 'Slider Settings', 'eduvibe-core' ),
                    'condition' => [
                        'display_type'    => 'slider'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'desktop_columns',
            [
                'label'        => __( 'Desktop Columns', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => $this->desktop_max_slider,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'size'     => $this->desktop_default_slider
                ],
                'description'  => __( 'Number of columns. A maximum of ' . $this->desktop_max_slider . ' items are allowed.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'tablet_columns',
            [
                'label'        => __( 'Tablet Columns', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => $this->tablet_max_slider,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'size'     => $this->tablet_default_slider
                ],
                'description'  => __( 'Number of columns in tablet( less then 992 px ). A maximum of ' . $this->tablet_max_slider . ' items are allowed.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'mobile_columns',
            [
                'label'        => __( 'Mobile Columns', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => $this->mobile_max_slider,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'size'     => $this->mobile_default_slider
                ],
                'description'  => __( 'Number of columns in mobile( less then 768 px ). A maximum of ' . $this->mobile_max_slider . ' items are allowed.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'small_mobile_columns',
            [
                'label'        => __( 'Small Mobile Columns', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => 2,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'size'     => 1
                ],
                'description'  => __( 'Number of columns in mobile( less then 481 px ). A maximum of 2 items are allowed.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'slides_to_scroll',
            [
                'label'        => __( 'Slides to Scroll', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => $this->desktop_max_slider,
                        'step' => 1
                    ]
                ],
                'default'      => [
                    'size'     => 1
                ],
                'description'  => __( 'Set how many slides are scrolled per swipe. A maximum of ' . $this->desktop_max_slider . ' items are allowed.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'transition_duration',
            [
                'label'     => __( 'Transition Duration', 'eduvibe-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1000
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'        => __( 'Autoplay', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => __( 'Autoplay Speed', 'eduvibe-core' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 3000,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pause',
            [
                'label'        => __( 'Pause on Hover', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'loop',
            [
                'label'        => __( 'Infinite Loop', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'arrows_and_dots',
            [
                'label'      => __( 'Arrows and Dots', 'eduvibe-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => 'none',
                'options'    => [
                    'arrows' => __( 'Arrows', 'eduvibe-core' ),
                    'dots'   => __( 'Dots', 'eduvibe-core' ),
                    'both'   => __( 'Arrows and Dots', 'eduvibe-core' ),
                    'none'   => __( 'None', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'arrows_prev_icon',
            [
                'label'       => __( 'Previous Arrow Icon', 'eduvibe-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'icon-arrow-left-line',
                    'library' => 'eduvibe-custom-icons'
                ],
                'condition'   => [
                    'arrows_and_dots' => [ 'arrows', 'both' ]
                ]
            ]
        );
        
        $this->add_control(
            'arrows_next_icon',
            [
                'label'       => __( 'Next Arrow Icon', 'eduvibe-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'icon-arrow-right-line-right',
                    'library' => 'eduvibe-custom-icons'
                ],
                'condition'   => [
                    'arrows_and_dots' => [ 'arrows', 'both' ]
                ]
            ]
        );

        $this->end_controls_section();
	}
}