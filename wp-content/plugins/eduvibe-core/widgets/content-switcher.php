<?php
namespace EduVibeCore\Widgets;
use \Elementor\Plugin;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for content switcher.
 *
 * @since 1.0.0
 */
class Content_Switcher extends Widget_Base {

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
		return 'eduvibe-content-switcher';
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
		return __( 'Content Switcher', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-animation-text';
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
		return [ 'eduvibe', 'toggle', 'tab', 'content', 'switcher' ];
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
            'section_content_switcher',
            [
                'label' => __( 'Content Switcher', 'eduvibe-core' )
            ]
        );

        $this->start_controls_tabs( 'content_switcher_tabs' );

            $this->start_controls_tab( 'primary_content_tab', [ 'label' => __( 'Primary', 'eduvibe-core' ) ] );

                $this->add_control(
                    'primary_content_heading',
                    [
                        'label'       => __( 'Heading', 'eduvibe-core' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => __( 'Primary Heading', 'eduvibe-core' )
                    ]
                );

                $this->add_control(
                    'primary_content_type',
                    [
                        'label'   => __( 'Content Type', 'eduvibe-core' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'content',
                        'options' => [
                            'content'        => __( 'Content', 'eduvibe-core' ),
                            'saved_template' => __( 'Saved Template', 'eduvibe-core' )
                        ]
                    ]
                );

                $this->add_control(
                    'primary_content_saved_template',
                    [
                        'label'     => __( 'Select Section', 'eduvibe-core' ),
                        'type'      => Controls_Manager::SELECT,
                        'options'   => $this->get_saved_template( 'section' ),
                        'default'   => '-1',
                        'condition' => [
                            'primary_content_type' => 'saved_template'
                        ]
                    ]
                );

                $this->add_control(
                    'primary_content',
                    [
                        'label'       => __( 'Content', 'eduvibe-core' ),
                        'type'        => Controls_Manager::WYSIWYG,
                        'default'     => __( 'Primary content is written here.', 'eduvibe-core' ),
                        'placeholder' => __( 'Type your description here', 'eduvibe-core' ),
                        'condition'   => [
                            'primary_content_type' => 'content'
                        ]
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab( 'secondary_content_tab', [ 'label' => __('Secondary', 'eduvibe-core') ] );

                $this->add_control(
                    'secondary_content_heading',
                    [
                        'label'       => __( 'Heading', 'eduvibe-core' ),
                        'type'        => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default'     => __( 'Secondary Heading', 'eduvibe-core' )
                    ]
                );

                $this->add_control(
                    'secondary_content_type',
                    [
                        'label'   => __( 'Content Type', 'eduvibe-core' ),
                        'type'    => Controls_Manager::SELECT,
                        'default' => 'content',
                        'options' => [
                            'content'        => __( 'Content', 'eduvibe-core' ),
                            'saved_template' => __( 'Save Template', 'eduvibe-core' )
                        ]
                    ]
                );

                $this->add_control(
                    'secondary_content_saved_template',
                    [
                        'label'     => __( 'Select Section', 'eduvibe-core' ),
                        'type'      => Controls_Manager::SELECT,
                        'options'   => $this->get_saved_template( 'section' ),
                        'default'   => '-1',
                        'condition' => [
                            'secondary_content_type' => 'saved_template'
                        ]
                    ]
                );

                $this->add_control(
                    'secondary_content',
                    [
                        'label'       => __( 'Content', 'eduvibe-core' ),
                        'type'        => Controls_Manager::WYSIWYG,
                        'default'     => __( 'Secondary content is written here.', 'eduvibe-core' ),
                        'placeholder' => __( 'Type your description here', 'eduvibe-core' ),
                        'condition'   => [
                            'secondary_content_type' => 'content'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

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

    public function get_post_template( $type = 'page' ) {
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

		$templates = array();

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
        $settings = $this->get_settings_for_display();

        echo '<div class="eduvibe-content-switcher-wrapper">';
            echo '<div class="eduvibe-content-switcher-toggle-wrapper">';
                echo '<div class="eduvibe-content-switcher-primary-toggle-heading">';
                    echo esc_html( $settings['primary_content_heading'] );
                echo '</div>';

                echo '<div class="eduvibe-content-switcher-toggle-control">';
                    echo '<label class="eduvibe-content-switcher-toggle-label">';
                        echo '<input class="input" type="checkbox">';
                        echo '<span class="eduvibe-content-switcher-toggle-switch"></span>';
                    echo '</label>';
                echo '</div>';

                echo '<div class="eduvibe-content-switcher-secondary-toggle-heading">';
                    echo esc_html( $settings['secondary_content_heading'] );
                echo '</div>';
            echo '</div>';

            echo '<div class="eduvibe-content-switcher-content-wrapper">';
                echo '<div class="eduvibe-content-switcher-primary-content-wrapper">';
                    if( 'content' === $settings['primary_content_type'] ) :
                        echo wp_kses_post( $settings['primary_content'] );
                    endif;
                    if( 'save_template' === $settings['primary_content_type'] ) :
                        echo Plugin::$instance->frontend->get_builder_content_for_display( wp_kses_post( $settings['primary_content_saved_template'] ) );
                    endif;
                echo '</div>';

                echo '<div class="eduvibe-content-switcher-secondary-content-wrapper">';
                    if( 'content' === $settings['secondary_content_type'] ) :
                        echo wp_kses_post( $settings['secondary_content'] );
                    endif;
                    if( 'saved_template' === $settings['secondary_content_type'] ) :
                        echo Plugin::$instance->frontend->get_builder_content_for_display( wp_kses_post( $settings['secondary_content_saved_template'] ) );
                    endif;
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}