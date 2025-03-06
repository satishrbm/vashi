<?php
namespace EduVibeCore\Widgets;
use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for testimonial carousel.
 *
 * @since 1.0.0
 */
class Testimonial_One extends Widget_Base {

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
        return 'eduvibe-testimonial-carousel-one';
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
        return __( 'Testimonial Carousel 1', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-testimonial-carousel';
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
        return [ 'eduvibe-slick' ];
    }

    /**
     * Get style dependencies.
     *
     * Retrieve the list of style dependencies the element requires.
     *
     * @since 1.9.0
     * @access public
     *
     * @return array Element styles dependencies.
     */
    public function get_style_depends() {
        return [ 'eduvibe-slick' ];
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
        return [ 'eduvibe', 'testimonial', 'review', 'blockquote', 'feedback', 'slider', 'carousel' ];
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
        $rating_number = range( 1, 5 );
        $rating_number = array_combine( $rating_number, $rating_number );

        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => __( 'Testimonial', 'eduvibe-core' )
            ]
        );
        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'thumb_size',
                'default' => 'thumbnail'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name', 
            [
                'label'       => __( 'Name', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Lorraine D. Raines', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
            'testimonial',
            [
                'label'       => __( 'Testimonial', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => __( 'Lorem ipsum dolor sit amet, consectetur dloril adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo.', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
            'designation', 
            [
                'label'       => __( 'Designation', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'WordPress Expert', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
            'thumb', 
            [
                'label'       => __( 'Image', 'eduvibe-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url'     => Utils::get_placeholder_image_src()
                ]
            ]
        );

        $repeater->add_control(
            'rating', 
            [
                'label'       => __( 'Rating', 'eduvibe-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 5,
                'options'     => $rating_number
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [ 'name'  => __( 'David J. Owens', 'eduvibe-core' ) ],
                    [ 'name'  => __( 'Bob P. Limones', 'eduvibe-core' ) ],
                    [ 'name'  => __( 'Tom R. Hurley', 'eduvibe-core' ) ],
                    [ 'name'  => __( 'Robert H. Lane', 'eduvibe-core' ) ]
                ],
                'title_field' => '{{name}}'
            ]
        );

        $this->end_controls_section();
    }

    /**
     * echo testimonial rating
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function rating( $ratings ) {
        for ( $i = 1; $i <= 5; $i++ ) :
            if ( $ratings >= $i ) :
                $active_class = '<i class="on icon-Star"></i>';
            else :
                $active_class = '<i class="off icon-Star"></i>';
            endif;
            echo $active_class;
        endfor;
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
        $settings     = $this->get_settings_for_display();
        $testimonials = $settings['testimonials'];
        $direction    = is_rtl() ? 'true' : 'false';

        $this->add_render_attribute( 
            'container', 
            [
                'class' => 'eduvibe-testimonial-three inner testimonial-card-activation-1 slick-arrow-style-2'
            ]
        );

        if ( is_array( $testimonials ) ) :
            echo '<div class="eduvibe-testimonial-3-wrapper testimonial-card-box variation-2">';
                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                    foreach ( $testimonials as $key => $testimonial ) :
                        $image         = $testimonial['thumb'];
                        $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb_size', $settings );

                        if ( empty( $image_src_url ) ) :
                            $image_url = $image['url']; 
                        else :
                            $image_url = $image_src_url;
                        endif;
                        echo '<div class="single-card">';
                            echo '<div class="rating">';
                                $this->rating( $testimonial['rating'] );
                            echo '</div>';
                            
                            echo $testimonial['testimonial'] ? '<p class="description">' . wp_kses_post( $testimonial['testimonial'] ) . '</p>' : '';
                            
                            echo '<div class="client-info">'; 
                                if ( ! empty( $image_url ) ) :
                                    echo '<div class="thumbnail">';
                                        echo '<img src="' . esc_url( $image_url ) . '" class="testimonial-author-avatar" alt="' . Control_Media::get_image_alt( $testimonial['thumb'] ) . '">';
                                    echo '</div>';
                                endif;  
                                if ( ! empty( $testimonial['name'] ) || ! empty( $testimonial['designation'] ) ) :
                                    echo '<div class="content">';
                                        echo $testimonial['name'] ? '<h6 class="title">' . esc_html( $testimonial['name'] ) . '</h6>' : '';
                                        echo $testimonial['designation'] ? '<span class="designation">' . esc_html( $testimonial['designation'] ) . '</span>' : '';
                                    echo '</div>';
                                endif;
                            echo '</div>';
                        echo '</div>';
                    endforeach;
                echo '</div>';
            echo '</div>';
        endif;
    }
}