<?php
namespace EduVibeCore\LP\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for User Wishlist Courses for LearnPress.
 *
 * @since 1.0.0
 */
class Wishlist extends Widget_Base {

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
		return 'eduvibe-lp-course-wishlist';
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
		return __( 'Wishlist( LearnPress )', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-posts-grid';
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
		return [ 'eduvibe', 'learnpress', 'course', 'wishlist' ];
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
            'section_lp_wishlist',
            [
                'label' => __( 'WishList Courses( LearnPress )', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'style',
            [
                'label'   => __( 'Style', 'eduvibe-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => __( 'One', 'eduvibe-core' ),
                    '2' => __( 'Two', 'eduvibe-core' ),
                    '3' => __( 'Three', 'eduvibe-core' ),
                    '4' => __( 'Four', 'eduvibe-core' ),
                    '5' => __( 'Five', 'eduvibe-core' ),
                    '6' => __( 'Six', 'eduvibe-core' )
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
        $user_id = get_current_user_id();
        $pid = (array) get_user_meta( $user_id, '_lpr_wish_list', true );
        $args     = array(
            'post_type'           => 'lp_course',
            'post__in'            => $pid,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'posts_per_page'      => - 1
        );
        $query    = new \WP_Query( $args );
        $wishlist = array();
        $block_data = array(
            'style' => $settings['style'],
        );
        global $post;
        if ( $query->have_posts() ) :
            echo '<div class="eduvibe-row">';
            while ( $query->have_posts() ) :
                $query->the_post();
                echo '<div id="learn-press-tab-wishlist-course-'. esc_attr( $post->ID ) . '" class="course eduvibe-col-lg-4" data-context="tab-wishlist">';
                    learn_press_get_template( 'custom/course-block/blocks.php', compact( 'block_data' ) );
                echo '</div>';
            endwhile;
            echo '</div>';
        else :
            if ( is_user_logged_in() ) :
                _e( 'You\'ve not added any courses in your wishlist.', 'eduvibe' );
            else :
                _e( 'You need to Log in first to add course in your wishlist.', 'eduvibe' );
            endif;
        endif;
        wp_reset_postdata();
    }
}