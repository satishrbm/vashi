<?php
namespace EduVibeCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Plugin;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for SVG scroll animation.
 *
 * @since 1.0.0
 */
class SVG_Scroll_Animation extends Widget_Base {

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
		return 'eduvibe-svg-scroll-animation';
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
		return __( 'SVG Scroll Animation', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-animation';
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
		return [ 'sal-js' ];
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
		return [ 'eduvibe', 'animated', 'animation', 'svg', 'path', 'scroll' ];
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
            'section_svg_scroll_animation',
            [
                'label' => __( 'Content', 'eduvibe-core' )
            ]
        );

        $this->add_control(
			'html',
			[
				'label'       => '',
				'type'        => Controls_Manager::CODE,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter your code', 'eduvibe-core' ),
				'show_label'  => false,
				'dynamic'     => [
					'active'  => true
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
        echo '<div class="eduvibe-svg-path-scroll-animation-wrapper" data-sal>';
            $this->print_unescaped_setting( 'html' );
            if ( Plugin::$instance->editor->is_edit_mode() ) :
                $this->render_editor_script();
            endif;
        echo '</div>';
	}

    /**
	 * Render HTML widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
        <div class="eduvibe-svg-path-scroll-animation-wrapper">
		    {{{ settings.html }}}
        </div>
		<?php
	}

    private function render_editor_script(){ 
    	?>
        <script type="text/javascript">
            jQuery( document ).ready( function($) {
            	let salActive = function () {
                    if ( 'undefined' !== typeof sal ) {
                        sal( {
                            threshold: 0.01,
                            once: true,
                        } );
                    }
                }
                salActive();
            } );
        </script>
    	<?php
    }
}