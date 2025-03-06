<?php
namespace EduVibeCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for accordion.
 *
 * @since 1.0.0
 */
class Accordion extends Widget_Base {

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
		return 'eduvibe-accordion';
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
		return __( 'Accordion', 'eduvibe-core' );
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
		return 'eduvibe-elementor-icon eicon-accordion';
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
		return [ 'eduvibe', 'toggle', 'tab' ];
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
  			'accordion_content',
  			[
  				'label' => __( 'Contents', 'eduvibe-core' )
  			]
  		);

  		$repeater = new Repeater();

        $repeater->add_control(
			'active_by_default', [
				'label'        => __( 'Active as Default', 'eduvibe-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);
		
        $repeater->add_control(
			'title', [
				'label'   => __( 'Title', 'eduvibe-core' ),
				'type'    => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => __( 'Accordion Title', 'eduvibe-core' ),
				'dynamic' => [ 'active' => true ]
			]
		);
		
        $repeater->add_control(
			'content', [
				'label'   => __( 'Content', 'eduvibe-core' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'eduvibe-core' )
			]
		);

        $this->add_control(
			'accordions',
			[
				'type' 		=> Controls_Manager::REPEATER,
				'fields' 	=> $repeater->get_controls(),
				'default'	=> [
					[ 
						'title'          => esc_html__( 'Accordion Title 1', 'eduvibe-core' ),
						'active_by_default' => 'yes'
					],
					[ 'title' => esc_html__( 'Accordion Title 2', 'eduvibe-core' ) ],
					[ 'title' => esc_html__( 'Accordion Title 3', 'eduvibe-core' ) ]
				],
				'title_field' => '{{title}}'
			]
		);

		$this->add_control(
            'title_tag',
            [
                'label'    => __( 'Title HTML Tag', 'eduvibe-core' ),
                'type'     => Controls_Manager::SELECT,
                'default'  => 'h1',
                'options'  => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p'
                ]
            ]
        );

  		$this->end_controls_section();
	}

	protected function render() {
        $settings   = $this->get_settings_for_display();
		?>
        <div class="edu-accordion accordion-style-1">
            <?php foreach( $settings['accordions'] as $key => $accordion ) : 
                $each_item = $this->get_repeater_setting_key('title', 'accordions', $key);
                                
                $item_class = ['edu-accordion-item'];
                if ( $accordion['active_by_default'] === 'yes' ) :
                    $item_class[] = 'default-active';
                endif;
                $this->add_render_attribute( $each_item, 'class', $item_class );

            ?>
                <div <?php echo $this->get_render_attribute_string( $each_item ); ?>>
                    <div class="edu-accordion-header<?php echo $accordion['active_by_default'] === 'yes' ? ' default-active' : ''; ?>">
                    	<?php echo '<' . esc_attr( $settings['title_tag'] ) . ' class="edu-accordion-title">'; ?>
                            <?php echo wp_kses_post($accordion['title']); ?>
                    	<?php echo '</' . esc_attr( $settings['title_tag'] ) . '>'; ?>
                    </div>
                    <div class="edu-accordion-content">
                        <div class="edu-accordion-body<?php echo $accordion['active_by_default'] === 'yes' ? ' default-active' : ''; ?>">
                            <?php echo wp_kses_post( $accordion['content'] ); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
	<?php
    }
}