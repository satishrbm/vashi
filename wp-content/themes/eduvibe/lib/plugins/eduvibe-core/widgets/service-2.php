<?php
namespace EduVibeCore\Widgets;
use \Elementor\Control_Media;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Icons_Manager;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for service two.
 *
 * @since 1.0.0
 */
class Service_Two extends Widget_Base {
    use \EduVibe_Core\Traits\Grid;

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
		return 'eduvibe-service-two';
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
		return __( 'Service 2', 'eduvibe-core' );
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
		return [ 'eduvibe', 'services', 'features', 'marketing' ];
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

  		$repeater = new Repeater();

        $repeater->start_controls_tabs( 'service_item_tabs' );

        $repeater->start_controls_tab( 'service_item_content_tab', ['label' => __( 'Content', 'eduvibe-core' )]);

            $repeater->add_control(
                'image_or_icon',
                [
                    'label'     => __( 'Image/Icon', 'eduvibe-core' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'image',
                    'options'   => [
                        'image' => __( 'Image', 'eduvibe-core' ),
                        'icon'  => __( 'Icon', 'eduvibe-core' )
                    ]
                ]
            );

            $repeater->add_control(
                'thumb', 
                [
                    'label'       => __( 'Image', 'eduvibe-core' ),
                    'type'        => Controls_Manager::MEDIA,
                    'default'     => [
                        'url'     => Utils::get_placeholder_image_src()
                    ],
                    'condition'   => [
                        'image_or_icon' => 'image'
                    ]
                ]
            );

            $repeater->add_control(
                'icon', 
                [
                    'label'       => __( 'Icon', 'eduvibe-core' ),
                    'type'        => Controls_Manager::ICONS,
                    'default'     => [
                        'value'   => 'fas fa-trophy',
                        'library' => 'fa-solid'
                    ],
                    'condition'   => [
                        'image_or_icon' => 'icon'
                    ]
                ]
            );

            $repeater->add_control(
                'title', 
                [
                    'label'       => __( 'Title', 'eduvibe-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default'     => __( 'Education', 'eduvibe-core' )
                ]
            );

            $repeater->add_control(
                'details', 
                [
                    'label'       => __( 'Details', 'eduvibe-core' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'default'     => __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'eduvibe-core' )
                ]
            );
            
            $repeater->add_control(
                'button_text', 
                [
                    'label'       => __( 'Button Text', 'eduvibe-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => __( 'Learn More', 'eduvibe-core' ),
                    'default'     => __( 'Learn More', 'eduvibe-core' )
                ]
            );

            $repeater->add_control(
                'link',
                [
                    'label'           => __( 'Button Link', 'eduvibe-core' ),
                    'type'            => Controls_Manager::URL,
                    'default'         => [
                        'url'         => '#',
                        'is_external' => ''
                    ],
                    'show_external'   => true,
                    'placeholder'     => __( 'https://your-link.com', 'eduvibe-core' )
                ]
            );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab( 'service_item_style_tab', ['label' => __( 'Style', 'eduvibe-core' )]);

        $repeater->add_control(
		    'item_icon_bg_color',
		    [
		        'label'     => __( 'Icon Background Color', 'eduvibe-core' ),
		        'type'      => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} {{CURRENT_ITEM}}.service-card-2' => 'background: {{VALUE}};'
		        ]
		    ]
		);

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
			'services',
			[
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default'	=> [
                    [ 
                        'title'          => __( 'Remote Learning', 'eduvibe-core' ),
                        'item_icon_bg_color' => '#EAF8F6'
                    ],
                    [ 
                        'title'          => __( 'Awesome Tutors', 'eduvibe-core' ),
                        'item_icon_bg_color' => '#FFF3EE'
                    ],
                    [ 
                        'title'          => __( 'Global Certificate', 'eduvibe-core' ),
                        'item_icon_bg_color' => '#EFF4FC'
                    ],
                    [ 
                        'title'          => __( 'Carrier Guideline', 'eduvibe-core' ),
                        'item_icon_bg_color' => '#FFF1F1'
                    ]
				],
				'title_field' => '{{title}}'
			]
		);

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb_size',
                'default'   => 'full'
            ]
        );

  		$this->end_controls_section();

        $this->settings();
	}

	protected function render() {
        $settings            = $this->get_settings_for_display();
        $services            = $settings['services'];
        $grid_desktop_column = 12/$settings['desktop_grid_columns'];
        $grid_tablet_column  = 12/$settings['tablet_grid_columns'];
        $grid_mobile_column  = 12/$settings['mobile_grid_columns'];
        $grid_column         = 'eduvibe-services-one-single-grid eduvibe-col-lg-' . esc_attr( $grid_desktop_column ) . ' eduvibe-col-md-' . esc_attr( $grid_tablet_column ) . ' eduvibe-col-sm-' . esc_attr( $grid_mobile_column );
        if ( is_array( $services ) ) :
            echo '<div class="eduvibe-service-items-wrapper eduvibe-services-one-grid eduvibe-row">';
                foreach ( $services as $key => $service ) :
                    $link_key = 'link_' . $key; 
                    $image         = $service['thumb'];
                    $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb_size', $settings );

                    if ( empty( $image_src_url ) ) :
                        $image_url = $image['url']; 
                    else :
                        $image_url = $image_src_url;
                    endif;
                    
                    if ( $service['link']['url'] ) :
                        $this->add_render_attribute( $link_key, 'href', esc_url( $service['link']['url'] ) );
                        if ( $service['link']['is_external'] ) :
                            $this->add_render_attribute( $link_key, 'target', '_blank' );
                        endif;
                        if ( $service['link']['nofollow'] ) :
                            $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        endif;
                    endif;
                    echo '<div class="' . esc_attr( $grid_column ) . '">';
                        echo '<div class="service-card service-card-2 elementor-repeater-item-' . esc_attr( $service['_id'] ) . '">';
                            echo '<div class="inner">';
                                echo '<div class="icon">';
                                    echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                                        if ( 'image' === $service['image_or_icon'] ) :
                                            echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $service['thumb'] ) . '">';
                                        else :
                                            Icons_Manager::render_icon( $service['icon'], [ 'aria-hidden' => 'true' ] );
                                        endif;
                                    echo '</a>';
                                    echo '<div class="shape-list">';
                                        echo '<img class="shape shape-1" src="' . esc_url( get_template_directory_uri() . '/assets/images/service-icon-01.png' ) . '" alt="Shape Images">';
                                        echo '<img class="shape shape-2" src="' . esc_url( get_template_directory_uri() . '/assets/images/service-icon-02.png' ) . '" alt="Shape Images">';
                                        echo '<img class="shape shape-3" src="' . esc_url( get_template_directory_uri() . '/assets/images/service-icon-03.png' ) . '" alt="Shape Images">';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="content">';
                                    echo '<h6 class="title">';
                                        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                                            echo esc_html( $service['title'] );
                                        echo '</a>';
                                    echo '</h6>';
                                    echo $service['details'] ? '<p class="description">' . wp_kses_post( $service['details'] ) . '</p>' : '';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                endforeach;
            echo '</div>';
        endif;
    }
}