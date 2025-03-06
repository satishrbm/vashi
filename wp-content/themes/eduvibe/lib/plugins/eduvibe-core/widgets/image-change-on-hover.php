<?php
namespace EduVibeCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for Image Change On Hover.
 *
 * @since 1.0.0
 */
class Image_Change_On_Hover extends Widget_Base {

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
		return 'eduvibe-image-change-on-hover';
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
		return __( 'Image Change On Hover', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-icon-box';
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
		return [ 'eduvibe', 'hover', 'image', 'change' ];
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
            'section_icon_box',
            [
                'label' => __( 'Image', 'eduvibe-core' )
            ]
        );

        $this->add_control(
	        'image',
	        [
                'label'     => __( 'Primary Image', 'eduvibe-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
	                'url'   => Utils::get_placeholder_image_src()
	            ]
	        ]
	    );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'      => 'img_size',
				'condition' => [
                    'image[url]!' => ''
				]
            ]
        );

        $this->add_control(
	        'hover_image',
	        [
                'label'     => __( 'Hover Image', 'eduvibe-core' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => [
	                'url'   => Utils::get_placeholder_image_src()
	            ]
	        ]
	    );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
				'name'      => 'hover_img_size',
				'condition' => [
                    'hover_image[url]!' => ''
				]
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => __( 'Link', 'eduvibe-core' ),
                'type'        => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'eduvibe-core' ),
                'separator'   => 'before'
            ]
        );

        $this->add_responsive_control(
            'position',
            [
                'label'          => __( 'Position', 'eduvibe-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'left'       => [
                        'title'  => __( 'Left', 'eduvibe-core' ),
                        'icon'   => 'eicon-h-align-left'
                    ],
                    'top'        => [
                        'title'  => __( 'Top', 'eduvibe-core' ),
                        'icon'   => 'eicon-v-align-top'
                    ],
                    'right'      => [
                        'title'  => __( 'Right', 'eduvibe-core' ),
                        'icon'   => 'eicon-h-align-right'
                    ]
                ],
                'selectors'     => [
                    '{{WRAPPER}} .eduvibe-image-change-on-hover' => 'text-align: {{VALUE}};'
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
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            'container',
            [
                'class' => [
                    'eduvibe-image-change-on-hover'
                ]
            ]
        );

        echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
            echo '<div class="client-logo">';
                if ( ! empty( $settings['link']['url'] ) ) :
                    $this->add_render_attribute( 'url', 'href', esc_url( $settings['link']['url'] ) );
                    if ( $settings['link']['is_external'] ) :
                        $this->add_render_attribute( 'url', 'target', '_blank' );
                    endif;
                    if ( $settings['link']['nofollow'] ) :
                        $this->add_render_attribute( 'url', 'rel', 'nofollow' );
                    endif;
                    echo '<a ' . $this->get_render_attribute_string( 'url' ) . '>';
                endif;

                if ( ! empty( $settings['image']['url'] ) ) :
                    $image = $settings['image'];
                    $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'img_size', $settings );
                    if ( empty( $image_url ) ) :
                        $image_url = $image['url'];
                    else :
                        $image_url = $image_url;
                    endif;
        
                    echo '<img class="image-main" src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $settings['image'] ) . '">';
                endif;

                if ( ! empty( $settings['hover_image']['url'] ) ) :
                    $hover_image = $settings['hover_image'];
                    $hover_image_url = Group_Control_Image_Size::get_attachment_image_src( $hover_image['id'], 'hover_img_size', $settings );
        
                    if ( empty( $hover_image_url ) ) :
                        $hover_image_url = $hover_image['url'];
                    else :
                        $hover_image_url = $hover_image_url;
                    endif;
        
                    echo '<img class="image-hover" src="' . esc_url( $hover_image_url ) . '" alt="' . Control_Media::get_image_alt( $settings['hover_image'] ) . '">';
                endif;

                if ( ! empty( $settings['link']['url'] ) ) :
                    echo '</a>';
                endif;
            echo '</div>';
        echo '</div>';
    }
}