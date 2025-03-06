<?php
namespace EduVibeCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for contact info.
 *
 * @since 1.0.0
 */
class Contact_Info extends Widget_Base {
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
		return 'eduvibe-contact-info';
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
		return __( 'Contact Info', 'eduvibe-core' );
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
		return 'eduvibe-elementor-icon eicon-flash';
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
		return [ 'eduvibe', 'contact', 'info', 'information', 'location' ];
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

    protected $desktop_default_grid = 4;
    protected $tablet_default_grid  = 2;
    protected $mobile_default_grid  = 1;
    protected $default_display_type = 'grid';

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
            'accordion_content',
            [
                'label' => __( 'Contents', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'style_type',
            [
                'label'     => __( 'Style Type', 'eduvibe-core' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'style-1',
                'options'   => [
                    'style-1' => __( 'Style 1', 'eduvibe-core' ),
                    'style-2' => __( 'Style 2', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'thumb', 
            [
                'label'       => __( 'Image', 'eduvibe-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url'     => Utils::get_placeholder_image_src()
                ],
                'condition'   => [
                    'style_type' => 'style-2'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb_size',
                'default'   => 'full',
                'condition' => [
                    'style_type' => 'style-2'
                ]
            ]
        );

        $this->add_control(
            'icon', 
            [
                'label'       => __( 'Icon', 'eduvibe-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-trophy',
                    'library' => 'fa-solid'
                ],
                'condition'   => [
                    'style_type' => 'style-1'
                ]
            ]
        );

        $this->add_control(
            'title', 
            [
                'label'       => __( 'Title', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Our Location', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'details', 
            [
                'label'       => __( 'Details', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => __( '486 Normana Avenue Morningtide, 4223', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'item_icon_color',
            [
                'label'     => __( 'Icon Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-contact-info-card-style-1 .inner .icon i' => 'color: {{VALUE}};'
                ],
                'condition'   => [
                    'style_type' => 'style-1'
                ]
            ]
        );

        $this->add_control(
            'item_icon_bg_color',
            [
                'label'     => __( 'Icon Background Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-contact-info-card-style-1 .inner .icon' => 'background: {{VALUE}};'
                ],
                'condition'   => [
                    'style_type' => 'style-1'
                ]
            ]
        );

        $this->add_control(
            'item_bg_hover_color',
            [
                'label'     => __( 'Item Hover Background Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-contact-info-card-style-1:hover' => 'background: {{VALUE}};'
                ],
                'condition'   => [
                    'style_type' => 'style-1'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings            = $this->get_settings_for_display();
        echo '<div class="contact-info-card eduvibe-contact-info-card-' . esc_attr( $settings['style_type'] ). '">';
            echo '<div class="inner">';
                echo '<div class="icon">';
                    if ( 'style-2' === $settings['style_type'] ) :
                        $image = $settings['thumb'];
                        $image_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb_size', $settings );
                        if ( empty( $image_url ) ) :
                            $image_url = $image['url'];
                        else :
                            $image_url = $image_url;
                        endif;
                        echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $settings['thumb'] ) . '">';
                    elseif ( 'style-1' === $settings['style_type'] && ! empty( $settings['icon']['value'] ) ) :
                        Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                    endif;
                echo '</div>';

                echo '<div class="content">';
                    echo '<h6 class="title">';
                        echo esc_html( $settings['title'] );
                    echo '</h6>';
                    echo wp_kses_post( $settings['details'] );
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}