<?php

namespace EduVibeCore\Widgets;

use \EduVibeCore\Helper;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for post.
 *
 * @since 1.0.0
 */
class Post_Two extends Widget_Base {
    use \EduVibe_Core\Traits\Posts;

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
        return 'eduvibe-post-two';
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
        return __( 'Post 2', 'eduvibe-core' );
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
        return [ 'eduvibe', 'query', 'blog', 'post', 'posts' ];
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
    protected function _register_controls() {

        $this->start_controls_section(
            'featured_post_section',
            [
                'label' => __( 'Featured Post', 'eduvibe-core' )
            ]
        );

        $this->add_control(
			'always_show_the_latest_post', [
				'label'        => __( 'Always Show The Latest Post?', 'eduvibe-core' ),
				'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'description'  => __( 'Always show the latest post as the Featured Post', 'eduvibe-core' ),
				'default'      => 'yes',
				'return_value' => 'yes'
			]
		);

        $this->add_control(
            'featured_post',
            [   
                'label'       => __( 'Featured Post', 'eduvibe-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT,
                'multiple'    => true,
                'default'     => array_key_first( Helper::retrieve_posts( 'post' ) ),
                'options'     => Helper::retrieve_posts( 'post' ),
                'condition'   => [
                    'always_show_the_latest_post!' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'featured_post_thumb_size',
                'default'   => 'eduvibe-post-thumb'
            ]
        );

        $this->add_control(
            'featured_post_must_have_featured_post',
            [
                'label'        => __( 'Only Has Featured Image', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'description'  => __( 'Featured Post Must Have a Featured Image.', 'eduvibe-core' ),           
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_responsive_control(
            'featured_post_image_height',
            [
                'label'        => __( 'Image Height', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', 'em' ],
                'range'        => [
                    'px'       => [
                        'min'  => 300,
                        'step' => 5,
                        'max'  => 1250
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-post-two-wrapper .featured-post .thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'specific_posts_section',
            [
                'label' => __( 'Other Specific Posts', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'specific_posts',
            [   
                'label'       => __( 'Specific Posts', 'eduvibe-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => Helper::retrieve_posts( 'post' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'specific_posts_size',
                'default'   => 'eduvibe-post-thumb'
            ]
        );

        $this->add_control(
            'specific_posts_order',
            [
                'type'          => Controls_Manager::SELECT,
                'label'         => __( 'Order', 'eduvibe-core' ),
                'default'       => 'DESC',
                'description'   => __( 'Order', 'eduvibe-core' ),
                'options'       => [
                    'ASC'       => __( 'Ascending', 'eduvibe-core' ),
                    'DESC'      => __( 'Descending', 'eduvibe-core' )
                ]
            ]
        );        

        $this->add_control(
            'specific_posts_order_by',
            [
                'type'              => Controls_Manager::SELECT,
                'label'             => __( 'Order by', 'eduvibe-core' ),
                'default'           => 'date',
                'options'           => [
                    'none'            => __( 'No order', 'eduvibe-core' ),
                    'ID'              => __( 'Post ID', 'eduvibe-core' ),
                    'author'          => __( 'Author', 'eduvibe-core' ),
                    'title'           => __( 'Title', 'eduvibe-core' ),
                    'name'            => __( 'Name', 'eduvibe-core' ),
                    'type'            => __( 'Type', 'eduvibe-core' ),
                    'date'            => __( 'Published Date', 'eduvibe-core' ),
                    'modified'        => __( 'Modified Date', 'eduvibe-core' ),
                    'parent'          => __( 'By Parent', 'eduvibe-core' ),
                    'rand'            => __( 'Random Order', 'eduvibe-core' ),
                    'comment_count'   => __( 'Comment Count', 'eduvibe-core' ),
                    'relevance'       => __( 'Relevance', 'eduvibe-core' ),
                    'menu_order'      => __( 'Menu Order', 'eduvibe-core' ),
                    'meta_value'      => __( 'Meta Value', 'eduvibe-core' ),
                    'meta_value_num'  => __( 'Meta Value Num', 'eduvibe-core' ),
                    'post__in'        => __( 'Post In( by include order )', 'eduvibe-core' ),
                    'post_name__in'   => __( 'Post Name In', 'eduvibe-core' ),
                    'post_parent__in' => __( 'post Parent In', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'specific_posts_must_have_featured_post',
            [
                'label'        => __( 'Only Has Featured Image', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'description'  => __( 'Only show posts which has feature image set.', 'eduvibe-core' ),           
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_responsive_control(
            'specific_posts_image_height',
            [
                'label'        => __( 'Image Height', 'eduvibe-core' ),
                'type'         => Controls_Manager::SLIDER,
                'size_units'   => [ 'px', 'em' ],
                'range'        => [
                    'px'       => [
                        'min'  => 100,
                        'step' => 1,
                        'max'  => 500
                    ]
                ],
                'selectors'    => [
                    '{{WRAPPER}} .eduvibe-post-two-wrapper .specific-posts .thumbnail a img' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
			'specific_posts_active_white_bg', [
				'label'        => __( 'Active White Background', 'eduvibe-core' ),
				'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
				'default'      => 'no',
				'return_value' => 'yes'
			]
		);

        $this->add_control(
			'specific_posts_title_in_line_two', [
				'label'        => __( 'Post Title in 2 Lines(max)?', 'eduvibe-core' ),
				'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'description'  => __( 'By enabling this option, the post title will appear in a maximum of 2 lines.', 'eduvibe-core' ),
				'default'      => 'yes',
				'return_value' => 'yes'
			]
		);
        
        $this->end_controls_section();
    }

    /**
     * return image for featured post
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image_for_featured_post( $image_id, $settings ) {
        $image_size = $settings['featured_post_thumb_size_size'];

        if ( 'custom' === $image_size ) :
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'featured_post_thumb_size', $settings );
        else :
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        endif;
        
        return '<img src="' . esc_url( $image_src ). '" alt="' . esc_attr( eduvibe_thumbanil_alt_text( $image_id ) ) . '" />';
    }

    /**
     * return image for specific post
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_image_for_specific_post( $image_id, $settings ) {
        $image_size = $settings['specific_posts_size_size'];

        if ( 'custom' === $image_size ) :
            $image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'specific_posts_size', $settings );
        else :
            $image_src = wp_get_attachment_image_src( $image_id, $image_size );
            $image_src = $image_src[0];
        endif;
        
        return '<img src="' . esc_url( $image_src ). '" alt="' . esc_attr( eduvibe_thumbanil_alt_text( $image_id ) ) . '" />';
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
        $direction = is_rtl() ? 'true' : 'false';

        $this->add_render_attribute( 'container', 'class', 'eduvibe-post-two-wrapper' );

        if ( 'yes' === $settings['specific_posts_title_in_line_two'] ) :
            $this->add_render_attribute( 'container', 'class', 'specific-post-title-line-two' );
        endif;

        if ( 'yes' === $settings['specific_posts_active_white_bg'] ) :
            $this->add_render_attribute( 'container', 'class', 'specific-post-active-white-bg' );
        endif;
        
        if ( 'yes' === $settings['always_show_the_latest_post'] ) :
            $featured_post_id = array_key_first( Helper::retrieve_posts( 'post' ) );
        else :
            $featured_post_id = $settings['featured_post'];
        endif;
        
        $args_for_featured_post = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'posts_per_page' => 1,
            'post__in'       => array( $featured_post_id )
        );

        $args_for_specific_post = array(
            'post_type'      => 'post',
            'post_status'    => 'publish',
            'orderby'        => $settings['specific_posts_order_by'],
            'order'          => $settings['specific_posts_order'],
            'posts_per_page' => 4,
            'post__in'       => $settings['specific_posts'],
            'post__not_in'   => array( $featured_post_id )
        );

        if ( 'yes' === $settings['featured_post_must_have_featured_post'] ) :
            $args_for_featured_post['meta_query'][] = array( 'key' => '_thumbnail_id' );
        endif;

        if ( 'yes' === $settings['specific_posts_must_have_featured_post'] ) :
            $args_for_specific_post['meta_query'][] = array( 'key' => '_thumbnail_id' );
        endif;

        $wp_featured_post_query = new \WP_Query( $args_for_featured_post );
        $wp_specific_post_query = new \WP_Query( $args_for_specific_post );

        if ( $wp_featured_post_query->have_posts() || $wp_specific_post_query->have_posts() ) :
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                echo '<div class="eduvibe-row">';
                    echo '<div class="eduvibe-col-lg-6 featured-post">';
                        while ( $wp_featured_post_query->have_posts() ) : $wp_featured_post_query->the_post();
                            if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                                echo '<div class="inner">';
                                    echo '<div class="thumbnail">';
                                        echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                                            echo $this->render_image_for_featured_post( get_post_thumbnail_id( get_the_id() ), $settings ); 
                                        echo '</a>';
                                    echo '</div>';

                                    echo '<div class="content">';
                                        echo '<div class="single-cat-link">';
                                            echo eduvibe_category_by_id( get_the_ID() );
                                        echo '</div>';

                                        the_title( '<h5 class="title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h5>' );

                                        echo '<ul class="blog-meta">';
                                            echo '<li><i class="icon-calendar-2-line"></i>' . esc_html( get_the_date( 'd M, Y' ) ) . '</li>';
                                            if ( comments_open() || get_comments_number() ) :
                                                echo '<li>';
                                                    echo '<i class="icon-discuss-line"></i>';
                                                    printf( // WPCS: XSS OK.
                                                        /* translators: 1: comment count number, 2: title. */
                                                        esc_html( _nx( '%1$s Cmnt', '%1$s Cmnts', get_comments_number(), 'comments title', 'eduvibe' ) ),
                                                        number_format_i18n( get_comments_number() ),
                                                        '<span>' . get_the_title() . '</span>'
                                                    );
                                                echo '</li>';
                                            endif;
                                        echo '</ul>';
                                    echo '</div>';
                                echo '</div>';
                            endif;
                        endwhile;
                        wp_reset_postdata();
                    echo '</div>';

                    echo '<div class="eduvibe-col-lg-6 specific-posts">';
                        echo '<div class="eduvibe-row">';
                            while ( $wp_specific_post_query->have_posts() ) : $wp_specific_post_query->the_post();
                                echo '<div class="eduvibe-col-lg-6 eduvibe-col-md-6 eduvibe-col-sm-6">';
                                    echo '<div class="inner">';
                                        if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                                            echo '<div class="thumbnail">';
                                                echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                                                    echo $this->render_image_for_specific_post( get_post_thumbnail_id( get_the_id() ), $settings ); 
                                                echo '</a>';

                                                echo '<div class="single-cat-link">';
                                                    echo eduvibe_category_by_id( get_the_ID() );
                                                echo '</div>';
                                            echo '</div>';
                                        endif;

                                        echo '<div class="content">';
                                            the_title( '<h5 class="title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h5>' );
                                            echo '<ul class="blog-meta">';
                                                echo '<li><i class="icon-calendar-2-line"></i>' . esc_html( get_the_date( 'd M, Y' ) ) . '</li>';
                                                if ( comments_open() || get_comments_number() ) :
                                                    echo '<li>';
                                                        echo '<i class="icon-discuss-line"></i>';
                                                        printf( // WPCS: XSS OK.
                                                            /* translators: 1: comment count number, 2: title. */
                                                            esc_html( _nx( '%1$s Cmnt', '%1$s Cmnts', get_comments_number(), 'comments title', 'eduvibe' ) ),
                                                            number_format_i18n( get_comments_number() ),
                                                            '<span>' . get_the_title() . '</span>'
                                                        );
                                                    echo '</li>';
                                                endif;
                                            echo '</ul>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            endwhile;
                            wp_reset_postdata();
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        endif;
    }
}