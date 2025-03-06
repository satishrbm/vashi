<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for animated image.
 *
 * @since 1.0.0
 */
class Animated_Image extends Widget_Base {

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
		return 'eduvibe-animated-image';
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
		return __( 'Animated Image', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-image-rollover';
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
		return [ 'eduvibe', 'image', 'animation' ];
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
        $start = is_rtl() ? __( 'Right', 'eduvibe-core' ) : __( 'Left', 'eduvibe-core' );
		$end = ! is_rtl() ? __( 'Right', 'eduvibe-core' ) : __( 'Left', 'eduvibe-core' );

  		$this->start_controls_section(
            'section_animated_image',
            [
                'label' => __( 'Animated Image', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'image',
            [
                'label'     => __( 'Image', 'eduvibe-core' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url'   => Utils::get_placeholder_image_src()
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'         => 'thumbnail',
                'default'      => 'full'
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label'          => __( 'Alignment', 'eduvibe-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'left' => [
                        'title'  => __( 'Left', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'right'   => [
                        'title'  => __( 'Right', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .eduvibe-animated-image-widget' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'animation_type',
            [
                'label'       => __( 'Animation Type', 'eduvibe-core' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'     => 'one',
                'options'     => [
                    'one' => __( 'Animation 1', 'eduvibe-core' ),
                ]
            ]
        );

        $this->add_control(
            'animation_one_type',
            [
                'label'     => __( 'Content Type', 'eduvibe-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'circle-one',
                'options'   => [
                    'circle-one' => __( 'With 1 Circle', 'eduvibe-core' ),
                    'circle-two' => __( 'With 2 Circle', 'eduvibe-core' ),
                    'circle-three' => __( 'With 3 Circle', 'eduvibe-core' )
                ],
                'condition' => [
                    'animation_type' => 'one'
                ]
            ]
        );

        $this->add_control(
            'enable_custom_duration',
            [
                'label'        => __( 'Custom Animation Duration', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'condition'    => [
                    'animation_type' => 'one'
                ]
            ]
        );
        
        $this->add_responsive_control(
            'custom_duration',
            [
                'label'        => __( 'Set Animation Duration', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => 35,
                        'step' => 1
                    ]
                ],
                'description'  => __( 'Set custom animation duration in second( unit ).', 'eduvibe-core' ),
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animated-image-type-one .circle-image span' => '-webkit-animation-duration: {{SIZE}}s; -moz-animation-duration: {{SIZE}}s; -ms-animation-duration: {{SIZE}}s; -o-animation-duration: {{SIZE}}s; animation-duration: {{SIZE}}s;'
                ],
                'condition'    => [
                    'animation_type'         => 'one',
                    'enable_custom_duration' => 'yes'
                ]  
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'image_style',
            [
                'label'        => __( 'Image', 'eduvibe-core' ),
                'tab'          => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'image_height',
            [
                'label'        => __( 'Height', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px' ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animated-image-widget img' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label'        => __( 'Width', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', '%', 'em' ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animated-image-widget img' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'image_border',
                'selector' => '{{WRAPPER}} .eduvibe-animated-image-widget img'
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ '%', 'em', 'px' ],
				'default'    => [
					'top'    => '100',
					'right'  => '100',
					'bottom' => '100',
					'left'   => '100',
                    'unit'   => '%'
				],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animated-image-widget img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'image_box_shadow',
                'selector' => '{{WRAPPER}} .eduvibe-animated-image-widget img'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'animation_one_style',
			[
				'label'  	=> __( 'Circle', 'eduvibe-core' ),
				'tab'	    => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'animation_type' => 'one'
                ]
                
			]
		);

        $this->add_control(
            'animation_one_circle_color',
              [
                  'label'     => __( 'Color', 'eduvibe-core' ),
                  'type'      => Controls_Manager::COLOR,
                  'selectors' => [
                      '{{WRAPPER}} .eduvibe-animated-image-type-one .circle-image span' => 'border-color: {{VALUE}};'
                  ]
              ]
        );

        $this->add_responsive_control(
            'animation_one_circle_size',
            [
                'label'        => __( 'Size', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px'],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-animated-image-type-one .circle-image span' => 'border-width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'animation_one_circle_width',
            [
                'label'      => __( 'Circle Width', 'eduvibe-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%'],
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => 1000,
                        'step' => 2
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animated-image-type-one .circle-image' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'animation_one_circle_height',
            [
                'label'      => __( 'Circle Height', 'eduvibe-core' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%'],
                'range'        => [
                    'px'       => [
                        'min'  => 1,
                        'max'  => 1000,
                        'step' => 2
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-animated-image-type-one .circle-image' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
			'animated_one_circle_offset_orientation_h',
			[
				'label' => __( 'Horizontal Orientation', 'eduvibe-core' ),
				'type' => Controls_Manager::CHOOSE,
				'toggle' => false,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => $start,
						'icon' => 'eicon-h-align-left',
					],
					'end' => [
						'title' => $end,
						'icon' => 'eicon-h-align-right',
					],
				],
				'render_type' => 'ui'
			]
		);

		$this->add_responsive_control(
			'animated_one_circle_offset_x',
			[
				'label' => __( 'Offset', 'eduvibe-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => '0',
				],
				'size_units' => [ 'px', '%', 'vw', 'vh' ],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .eduvibe-animated-image-type-one .circle-image span' => 'left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .eduvibe-animated-image-type-one .circle-image span' => 'right: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'animated_one_circle_offset_orientation_h!' => 'end'
				],
			]
		);

		$this->add_responsive_control(
			'animated_one_circle_offset_x_end',
			[
				'label' => __( 'Offset', 'eduvibe-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 0.1,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'default' => [
					'size' => '0',
				],
				'size_units' => [ 'px', '%', 'vw', 'vh' ],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .eduvibe-animated-image-type-one .circle-image span' => 'right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .eduvibe-animated-image-type-one .circle-image span' => 'left: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'animated_one_circle_offset_orientation_h' => 'end'
				],
			]
		);

		$this->add_control(
			'animated_one_circle_offset_orientation_v',
			[
				'label' => __( 'Vertical Orientation', 'eduvibe-core' ),
				'type' => Controls_Manager::CHOOSE,
				'toggle' => false,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => __( 'Top', 'eduvibe-core' ),
						'icon' => 'eicon-v-align-top',
					],
					'end' => [
						'title' => __( 'Bottom', 'eduvibe-core' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'render_type' => 'ui'
			]
		);

		$this->add_responsive_control(
			'animated_one_circle_offset_y',
			[
				'label' => __( 'Offset', 'eduvibe-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'vh', 'vw' ],
				'default' => [
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .eduvibe-animated-image-type-one .circle-image span' => 'top: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'animated_one_circle_offset_orientation_v!' => 'end'
				],
			]
		);

		$this->add_responsive_control(
			'animated_one_circle_offset_y_end',
			[
				'label' => __( 'Offset', 'eduvibe-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'vh', 'vw' ],
				'default' => [
					'size' => '0',
				],
				'selectors' => [
					'{{WRAPPER}} .eduvibe-animated-image-type-one .circle-image span' => 'bottom: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'animated_one_circle_offset_orientation_v' => 'end'
				],
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
        $settings       = $this->get_settings_for_display();
        $animation_type = $settings['animation_type'];

        $this->add_render_attribute( 'container', 'class', 'eduvibe-animated-image-type-' . esc_attr( $animation_type ) );

        if ( $animation_type === 'one' ) :
            $this->add_render_attribute( 'container', 'class', $settings['animation_one_type'] );
        endif;

        echo '<div class="eduvibe-animated-image-widget">';
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                echo '<img src="' . esc_url( $this->render_image( $settings ) ) . '" alt="' . Control_Media::get_image_alt( $settings['image'] ) . '">';
                if ( $animation_type === 'one' ) :
                    echo '<div class="circle-image">';
                        echo '<span></span>';
                        switch ( $settings['animation_one_type'] ) :
                            case "circle-two":
                                echo '<span></span>';
                                break;
                            case "circle-three":
                                echo '<span></span>';
                                echo '<span></span>';
                                break;
                        endswitch;
                    echo '</div>';
                endif;
            echo '</div>';
        echo '</div>';
    }

    /**
     * return image URL for static course categories
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image( $settings ) {
        $image     = $settings['image'];
        $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumbnail', $settings );
        if ( empty( $image_url ) ) :
            $image_url = $image['url'];
        else :
            $image_url = $image_url;
        endif;
        return $image_url;
    }
}