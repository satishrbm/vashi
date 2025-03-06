<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Plugin;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for Tabs.
 *
 * @since 1.0.0
 */
class Tabs extends Widget_Base {
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
        return 'eduvibe-tabs';
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
        return __( 'Tabs', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-tabs';
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
        return [ 'eduvibe', 'tabs' ];
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
            'section_tabs',
            [
                'label' => __( 'Tabs', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'style_type',
            [
                'label'   => __( 'Type', 'eduvibe-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => [
                    'style-one' => __( 'Style 1', 'eduvibe-core' ),
                    'style-two' => __( 'Style 2', 'eduvibe-core' )
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title', 
            [
                'label'       => __( 'Title', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Tab Title', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label'   => __( 'Content Type', 'eduvibe-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'content',
                'options' => [
                    'content'        => __( 'Content', 'eduvibe-core' ),
                    'saved-template' => __( 'Saved Template', 'eduvibe-core' ),
                    'shortcode'      => __( 'ShortCode', 'eduvibe-core' )
                ]
            ]
        );

        $repeater->add_control(
            'content', 
            [
                'label'       => __( 'Content', 'eduvibe-core' ),
                'type'        => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'eduvibe-core' ),
                'condition'   => [
                    'content_type' => 'content'
                ]
            ]
        );

        $repeater->add_control(
            'saved_template',
            [
                'label'     => __( 'Select Section', 'eduvibe-core' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => $this->get_saved_template( 'section' ),
                'default'   => '-1',
                'condition' => [
                    'content_type' => 'saved-template'
                ]
            ]
        );

        $repeater->add_control(
            'shortcode',
            [
                'label'       => __( 'Enter your shortcode', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( '[gallery]', 'eduvibe-core' ),
                'condition'   => [
                    'content_type' => 'shortcode'
                ]
            ]
        );

        $this->add_control(
            'items',
            [
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [ 'title' => __( 'Tab #1', 'eduvibe-core' ) ],
                    [ 
                        'title' => __( 'Tab #2', 'eduvibe-core' ) ,
                        'content' => __( 'The placeholder text, beginning with the line “Lorem ipsum dolor sit amet, consectetur adipiscing elit”, looks like Latin because in its youth, centuries ago, it was Latin.', 'eduvibe-core' ) 
                    ]
                ],
                'title_field' => '{{title}}'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'title_style',
            [
                'label'     => __( 'Title', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'style_one_title_alignment',
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
                    '{{WRAPPER}} .eduvibe-tabs-title' => 'text-align: {{VALUE}};'
                ],
                'condition'      => [
                    'style_type' => 'style-one'
                ]
            ]
        );

        $this->add_responsive_control(
            'style_two_title_alignment',
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
                    '{{WRAPPER}} .eduvibe-tabs-wrapper.eduvibe-tabs-style-style-two .eduvibe-tabs-title-wrapper' => 'justify-content: {{VALUE}};'
                ],
                'condition'      => [
                    'style_type' => 'style-two'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'        => __( 'Margin', 'eduvibe-core' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', 'em', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-tabs-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );  

        $this->add_control(
			'title_position',
			[
				'label'   => __( 'Position', 'eduvibe-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => __( 'Default', 'eduvibe-core' ),
					'absolute' => __( 'Absolute', 'eduvibe-core' )
				]
			]
		);

		$start = is_rtl() ? __( 'Right', 'eduvibe-core' ) : __( 'Left', 'eduvibe-core' );
		$end = ! is_rtl() ? __( 'Right', 'eduvibe-core' ) : __( 'Left', 'eduvibe-core' );

		$this->add_control(
			'title_offset_orientation_h',
			[
				'label'       => __( 'Horizontal Orientation', 'eduvibe-core' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => 'start',
				'render_type' => 'ui',
				'options'     => [
					'start'     => [
						'title' => $start,
						'icon'  => 'eicon-h-align-left'
					],
					'end'       => [
						'title' => $end,
						'icon'  => 'eicon-h-align-right'
					]
				],
				'condition'   => [
					'title_position' => 'absolute'
				]
			]
		);

		$this->add_responsive_control(
			'title_offset_x',
			[
				'label' => __( 'Offset', 'eduvibe-core' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1
					],
					'%' => [
						'min' => -200,
						'max' => 200
					],
					'vw' => [
						'min' => -200,
						'max' => 200
					],
					'vh' => [
						'min' => -200,
						'max' => 200
					]
				],
				'default' => [
					'size' => '0'
				],
				'size_units' => [ 'px', '%', 'vw', 'vh' ],
				'selectors' => [
					'body:not(.rtl) {{WRAPPER}} .eduvibe-tabs-title-position-absolute .eduvibe-tabs-title' => 'left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .eduvibe-tabs-title-position-absolute .eduvibe-tabs-title' => 'right: {{SIZE}}{{UNIT}}'
				],
				'condition' => [
					'title_offset_orientation_h!' => 'end',
					'title_position' => 'absolute'
				]
			]
		);

		$this->add_responsive_control(
			'title_offset_x_end',
			[
				'label' => __( 'Offset', 'eduvibe-core' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 0.1
					],
					'%' => [
						'min' => -200,
						'max' => 200
					],
					'vw' => [
						'min' => -200,
						'max' => 200
					],
					'vh' => [
						'min' => -200,
						'max' => 200
					]
				],
				'default' => [
					'size' => '0'
                ],
				'size_units' => [ 'px', '%', 'vw', 'vh' ],
				'selectors'  => [
					'body:not(.rtl) {{WRAPPER}} .eduvibe-tabs-title-position-absolute .eduvibe-tabs-title' => 'right: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .eduvibe-tabs-title-position-absolute .eduvibe-tabs-title' => 'left: {{SIZE}}{{UNIT}}'
				],
				'condition'  => [
					'title_offset_orientation_h' => 'end',
					'title_position' => 'absolute'
				]
			]
		);

		$this->add_control(
			'title_offset_orientation_v',
			[
				'label'   => __( 'Vertical Orientation', 'eduvibe-core' ),
				'type'    => Controls_Manager::CHOOSE,
				'toggle'  => false,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => __( 'Top', 'eduvibe-core' ),
						'icon'  => 'eicon-v-align-top'
					],
					'end' => [
						'title' => __( 'Bottom', 'eduvibe-core' ),
						'icon'  => 'eicon-v-align-bottom'
					],
				],
				'render_type' => 'ui',
				'condition'   => [
					'title_position' => 'absolute'
				]
			]
		);

		$this->add_responsive_control(
			'title_offset_y',
			[
				'label' => __( 'Offset', 'eduvibe-core' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1
					],
					'%' => [
						'min' => -200,
						'max' => 200
					],
					'vh' => [
						'min' => -200,
						'max' => 200
					],
					'vw' => [
						'min' => -200,
						'max' => 200
					],
				],
				'size_units' => [ 'px', '%', 'vh', 'vw' ],
				'default'    => [
					'size' => '0'
				],
				'selectors' => [
					'{{WRAPPER}} .eduvibe-tabs-title-position-absolute .eduvibe-tabs-title' => 'top: {{SIZE}}{{UNIT}}'
				],
				'condition' => [
					'title_offset_orientation_v!' => 'end',
					'title_position' => 'absolute'
				]
			]
		);

		$this->add_responsive_control(
			'title_offset_y_end',
			[
				'label' => __( 'Offset', 'eduvibe-core' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => -1000,
						'max'  => 1000,
						'step' => 1
					],
					'%' => [
						'min' => -200,
						'max' => 200
                    ],
					'vh' => [
						'min' => -200,
						'max' => 200
					],
					'vw' => [
						'min' => -200,
						'max' => 200
					],
				],
				'size_units' => [ 'px', '%', 'vh', 'vw' ],
				'default' => [
					'size' => '0'
				],
				'selectors' => [
					'{{WRAPPER}} .eduvibe-tabs-title-position-absolute .eduvibe-tabs-title' => 'bottom: {{SIZE}}{{UNIT}}'
				],
				'condition' => [
					'title_offset_orientation_v' => 'end',
					'title_position' => 'absolute'
				]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'content_style',
            [
                'label'     => __( 'Content', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'        => __( 'Margin', 'eduvibe-core' ),
                'type'         => Controls_Manager::DIMENSIONS,
                'size_units'   => [ 'px', 'em', '%' ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-tabs-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );  

        $this->end_controls_section();
    }

    /**
     *  Get Saved Widgets
     *
     *  @param string $type Type.
     *  @since 1.0.0
     *  @return string
     */
    public function get_saved_template( $type = 'page' ) {
        $saved_widgets = $this->get_post_template( $type );
        $options[-1]   = __( 'Select', 'eduvibe-core' );
        if ( count( $saved_widgets ) ) :
            foreach ( $saved_widgets as $saved_row ) :
                $options[ $saved_row['id'] ] = $saved_row['name'];
            endforeach;
        else :
            $options['no_template'] = __( 'No section template is added.', 'eduvibe-core' );
        endif;
        return $options;
    }

    /**
     *  Get Templates based on category
     *
     *  @param string $type Type.
     *  @since 1.0.0
     *  @return string
     */
    public function get_post_template( $type = 'page' ) {
        $templates = [];
        $posts = get_posts(
            array(
                'post_type'        => 'elementor_library',
                'orderby'          => 'title',
                'order'            => 'ASC',
                'posts_per_page'   => '-1',
                'tax_query'        => array(
                    array(
                        'taxonomy' => 'elementor_library_type',
                        'field'    => 'slug',
                        'terms'    => $type
                    )
                )
            )
        );

        foreach ( $posts as $post ) :
            $templates[] = array(
                'id'   => $post->ID,
                'name' => $post->post_title
            );
        endforeach;

        return $templates;
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
        $settings  = $this->get_settings_for_display();
        $items     = $settings['items'];
        $this->add_render_attribute( 'container', 'class', 'eduvibe-tabs-wrapper' );
        $this->add_render_attribute( 'container', 'class', 'eduvibe-tabs-style-' . esc_attr( $settings['style_type'] ) );
        $this->add_render_attribute( 'container', 'class', 'eduvibe-tabs-title-position-' . esc_attr( $settings['title_position'] ) );

        if ( is_array( $items ) ) :
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                echo '<div class="eduvibe-tabs-title">';
                    echo '<ul class="eduvibe-tabs-title-wrapper">';
                        foreach ( $items as $key => $item ) :
                            echo '<li class="eduvibe-tab-title">';
                                echo '<a class="eduvibe-tab-title-heading">' . wp_kses_post( $item['title'] ) . '</a>';
                            echo '</li>';
                        endforeach;
                    echo '</ul>';
                echo '</div>';

                echo '<div class="eduvibe-tabs-content-wrapper">';
                    foreach ( $items as $key => $item ) :
                        echo '<div class="eduvibe-tab-content eduvibe-fade">';
                            if ( 'saved-template' === $item['content_type'] ) :
                                echo Plugin::$instance->frontend->get_builder_content_for_display( wp_kses_post( $item['saved_template'] ) );
                            elseif ( 'shortcode' === $item['content_type'] ) :
                                echo do_shortcode( $item['shortcode'] );;
                            else :
                                echo wp_kses_post( $item['content'] );
                            endif;
                        echo '</div>';
                    endforeach;
                echo '</div>';
            echo '</div>';
        endif;
    }
}