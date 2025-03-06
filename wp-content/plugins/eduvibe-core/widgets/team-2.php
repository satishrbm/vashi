<?php

namespace EduVibeCore\Widgets;

use \Elementor\Controls_Manager;
use \Elementor\Control_Media;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use \Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for team.
 *
 * @since 1.0.0
 */
class Team_Two extends Widget_Base {
    use \EduVibe_Core\Traits\Slider_Arrows;
    use \EduVibe_Core\Traits\Slider_Dots;
    use \EduVibe_Core\Traits\Users;
    use \EduVibe_Core\Traits\Grid, \EduVibe_Core\Traits\Slider {
        \EduVibe_Core\Traits\Slider::settings insteadof \EduVibe_Core\Traits\Grid;
        \EduVibe_Core\Traits\Grid::settings as grid_settings;
    }
    
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
        return 'eduvibe-team-two';
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
        return __( 'Team / Instructor 2( Grid / Carousel )', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-person';
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

    protected $desktop_max_slider     = 6;
    protected $desktop_default_slider = 4;
    protected $desktop_default_grid   = 4;
    protected $tablet_max_slider      = 3;
    protected $tablet_default_slider  = 3;
    protected $tablet_default_grid    = 3;
    protected $mobile_max_slider      = 2;
    protected $mobile_default_slider  = 2;
    protected $mobile_default_grid    = 1;
    protected $image_size             = 600;
    protected $instructor             = 'lp_teacher';
    protected $default_content_type   = 'mixed';
    protected $default_display_type;

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
            'section_team',
            [
                'label' => __( 'Team / Instructor', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'content_type',
            [
                'label'       => __( 'Content Type', 'eduvibe-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'dynamic',
                'options'     => [
                    'dynamic' => __( 'Dynamic', 'eduvibe-core' ),
                    'static'  => __( 'Static', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'open_link_tab', 
            [
                'label'        => __( 'Open Social Link in New Tab', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->add_control(
            'display_type',
            [
                'label'      => __( 'Display Type', 'eduvibe-core' ),
                'type'       => Controls_Manager::SELECT,
                'default'    => 'grid',
                'options'    => [
                    'grid'   => __( 'Grid', 'eduvibe-core' ),
                    'slider' => __( 'Slider', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'team_static_items_separator_before',
            [
                'type'             => Controls_Manager::DIVIDER,
                'condition'        => [
                    'content_type' => 'static'
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name', 
            [
                'label'       => __( 'Name', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'John Doe', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'         => __( 'Profile Link', 'eduvibe-core' ),
                'type'          => Controls_Manager::URL,
                'show_external' => true,
                'placeholder'   => __( 'https://your-link.com', 'eduvibe-core' ),
                'default'       => [
                    'url'         => '#',
                    'is_external' => 'true'
                ]
            ]
        );

        $repeater->add_control(
            'designation', 
            [
                'label'       => __( 'Designation', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => __( 'Airline Copilots, Liberal', 'eduvibe-core' )
            ]
        );

        $repeater->add_control(
            'thumb', 
            [
                'label'       => __( 'Image', 'eduvibe-core' ),
                'type'        => Controls_Manager::MEDIA,
                'default'     => [
                    'url'     => get_template_directory_uri() . '/assets/images/team-1-placeholder.png'
                ]
            ]
        );
        
        $repeater->add_control(
            'social_share', 
            [
                'label'       => __( 'Social Profile Links', 'eduvibe-core' ),
                'type'        => Controls_Manager::HEADING,
                'separator'   => 'before'
            ]
        );

        $repeater->add_control(
            'linkedin', 
            [
                'label'       => __( 'Linkedin', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '#'
            ]
        );

        $repeater->add_control(
            'facebook', 
            [
                'label'       => __( 'Facebook', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '#'
            ]
        );

        $repeater->add_control(
            'twitter', 
            [
                'label'       => __( 'Twitter', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '#'
            ]
        );

        $repeater->add_control(
            'youtube', 
            [
                'label'       => __( 'Youtube', 'eduvibe-core' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '#'
            ]
        );

        $this->add_control(
            'members',
            [
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [ 'name'  => __( 'David J. Owens', 'eduvibe-core' ) ],
                    [ 'name'  => __( 'Bob P. Limones', 'eduvibe-core' ) ],
                    [ 
                        'name'  => __( 'Tom R. Hurley', 'eduvibe-core' )
                    ],
                    [ 'name'  => __( 'Robert H. Lane', 'eduvibe-core' ) ]
                ],
                'title_field' => '{{name}}',
                'condition'    => [
                    'content_type' => 'static'
                ]
            ]
        );

        $this->add_control(
            'team_static_items_separator_after',
            [
                'type'             => Controls_Manager::DIVIDER,
                'condition'        => [
                    'content_type' => 'static'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumb_size',
                'default'   => 'full',
                'condition' => [
                    'content_type' => 'static'
                ]
            ]
        );

        $this->add_control(
            'enable_profile_page_link',
            [
                'label'        => __( 'Link To Instructor Profile Page', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    'content_type' => 'dynamic'
                ]
            ]
        );

        $this->add_control(
            'enable_designation',
            [
                'label'        => __( 'Designation', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    'content_type' => 'dynamic'
                ]
            ]
        );

        $this->add_control(
            'enable_social_icons',
            [
                'label'        => __( 'Social Icons', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes',
                'condition'    => [
                    'content_type' => 'dynamic'
                ]
            ]
        );

        $this->add_control(
            'dynamic_default_active_item',
            [
                'label'       => __( 'By Default Active', 'eduvibe-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 2,
                'options'     => [
                    '0' => __( 'First', 'eduvibe-core' ),
                    '1' => __( 'Second', 'eduvibe-core' ),
                    '2' => __( 'Third', 'eduvibe-core' ),
                    '3' => __( 'Fourth', 'eduvibe-core' )
                ]
            ]
        );

        $this->end_controls_section();

        $this->query();

        $this->grid_settings();

        $this->settings();

        $this->arrows();

        $this->dots();
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
        $link_tab  = 'yes' === $settings['open_link_tab'] ? '_blank': '_self';
        $direction = is_rtl() ? 'true' : 'false';
        $members   = '';

        $this->add_render_attribute( 'container', 'class', 'eduvibe-team-two-wrapper' );
        $this->add_render_attribute( 'container', 'class', 'eduvibe-team-two-' . esc_attr( $settings['display_type'] ) );
        $this->add_render_attribute( 'single-wrapper', 'class', 'eduvibe-team-two-single-' . esc_attr( $settings['display_type'] ) );

        if ( 'grid' === $settings['display_type'] ) :
            $this->add_render_attribute( 'container', 'class', 'eduvibe-row' );
            $grid_desktop_column = 12/$settings['desktop_grid_columns'];
            $grid_tablet_column  = 12/$settings['tablet_grid_columns'];
            $grid_mobile_column  = 12/$settings['mobile_grid_columns'];
            $grid_column = 'eduvibe-col-lg-' . esc_attr( $grid_desktop_column ) . ' eduvibe-col-md-' . esc_attr( $grid_tablet_column ) . ' eduvibe-col-sm-' . esc_attr( $grid_mobile_column );
            $this->add_render_attribute( 'single-wrapper', 'class', $grid_column );
        else :
            $this->add_render_attribute( 
                'container', 
                [
                    'class'                   => 'eduvibe-slider-item',
                    'data-slidestoshow'       => intval( esc_attr( $settings['desktop_columns']['size'] ) ),
                    'data-tablet-items'       => intval( esc_attr( $settings['tablet_columns']['size'] ) ),
                    'data-mobile-items'       => intval( esc_attr( $settings['mobile_columns']['size'] ) ), 
                    'data-small-mobile-items' => intval( esc_attr( $settings['small_mobile_columns']['size'] ) ),
                    'data-slidestoscroll'     => intval( esc_attr( $settings['slides_to_scroll']['size'] ) ),
                    'data-speed'              => intval( esc_attr( $settings['transition_duration'] ) ),
                    'data-navigation'         => esc_attr( $settings['arrows_and_dots'] ),
                    'data-direction'          => esc_attr( $direction )
                ]
            );

            if ( 'yes' === $settings['autoplay'] ) :
                $this->add_render_attribute( 'container', 'data-autoplay', 'true' );
                $this->add_render_attribute( 'container', 'data-autoplayspeed', intval( esc_attr( $settings['autoplay_speed'] ) ) );
                if ( 'yes' === $settings['pause'] ) :
                    $this->add_render_attribute( 'container', 'data-pauseonhover', 'true' );
                endif;
            endif;

            if ( 'yes' === $settings['loop'] ) :
                $this->add_render_attribute( 'container', 'data-loop', 'true' );
            endif;

            if ( 'arrows' === $settings['arrows_and_dots'] || 'both' === $settings['arrows_and_dots'] ) :
                $this->add_render_attribute( 'container', 'data-arrow-prev', esc_attr( $settings['arrows_prev_icon']['value'] ) );
                $this->add_render_attribute( 'container', 'data-arrow-next', esc_attr( $settings['arrows_next_icon']['value'] ) );
                $this->add_render_attribute( 'container', 'class', 'arrow-position-' . esc_attr( $settings['arrows_position'] ) );
            endif;
        endif;

        if ( 'static' === $settings['content_type'] ) :
            $members = $settings['members'];
        endif;

        if ( 'static' === $settings['content_type'] && is_array( $members ) ) :
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                foreach ( $members as $key => $member ) :
                    $link_key      = 'link_' . $key;
                    $image         = $member['thumb'];
                    $image_src_url = Group_Control_Image_Size::get_attachment_image_src( $image['id'], 'thumb_size', $settings );

                    if ( empty( $image_src_url ) ) :
                        $image_url = $image['url']; 
                    else :
                        $image_url = $image_src_url;
                    endif;

                    if ( $member['link']['url'] ) :
                        $this->add_render_attribute( $link_key, 'href', esc_url( $member['link']['url'] ) );
                        if ( $member['link']['is_external'] ) :
                            $this->add_render_attribute( $link_key, 'target', '_blank' );
                        endif;
                        if ( $member['link']['nofollow'] ) :
                            $this->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        endif;
                    endif;
                    echo '<div ' . $this->get_render_attribute_string( 'single-wrapper' ) . '>';
                        echo '<div class="edu-instructor-grid edu-instructor-3' . ( $settings['dynamic_default_active_item'] == $key ? ' eduvibe-hover-active' : '' ) . ( 'slider' === $settings['display_type'] ? ' edu-instructor-3-slider-visible' : ' edu-instructor-3-visible' ) . '">';
                            echo '<div class="edu-instructor">';
                                echo '<div class="inner">';
                                    echo '<div class="thumbnail">';
                                        echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                                            echo '<img src="' . esc_url( $image_url ) . '" alt="' . Control_Media::get_image_alt( $member['thumb'] ) . '">';
                                        echo '</a>';
                                    echo '</div>';
                                    echo '<div class="edu-instructor-info">';
                                        if ( $member['name'] ) :
                                            echo '<h5 class="title">';
                                                echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
                                                    echo esc_html( $member['name'] );
                                                echo '</a>';
                                            echo '</h5>';
                                        endif;
                                        echo $member['designation'] ? '<span class="desc">' . esc_html( $member['designation'] ) . '</span>' : '';
                                        if ( ! empty( $member['facebook'] ) || ! empty( $member['twitter'] ) || ! empty( $member['linkedin'] ) || ! empty( $member['youtube'] ) ) :
                                            echo '<div class="team-share-info bg-transparent">';
                                                echo $member['linkedin'] ? '<a href="' . esc_url( $member['linkedin'] ) . '" target="' . esc_attr( $link_tab ) . '"><i class="icon-linkedin"></i></a>' : '';
                                                echo $member['facebook'] ? '<a href="' . esc_url( $member['facebook'] ) . '" target="' . esc_attr( $link_tab ) . '"><i class="icon-Fb"></i></a>' : '';
                                                echo $member['twitter'] ? '<a href="' . esc_url( $member['twitter'] ) . '" target="' . esc_attr( $link_tab ) . '"><i class="icon-Twitter"></i></a>' : '';
                                                echo $member['youtube'] ? '<a href="' . esc_url( $member['youtube'] ) . '" target="' . esc_attr( $link_tab ) . '"><i class="icon-youtube"></i></a>' : '';
                                            echo '</div>';
                                        endif;
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                endforeach;
            echo '</div>';
        elseif ( 'dynamic' === $settings['content_type'] ) :
            $args = array(
                'role'    => $this->instructor,
                'orderby' => $settings['order_by'],
                'order'   => $settings['order'],
                'include' => $settings['specific_user_include'],
                'exclude' => $settings['specific_user_exclude'],
                'number'  => $settings['per_page']['size']
            );
            $enable_profile_link = $settings['enable_profile_page_link'];
            $users = new \WP_User_Query( $args );

            if ( is_array( $users->results ) ) :
                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                    foreach ( $users->results as $key => $user ) :
                        $job = $profile_url = '';
                        if ( 'eduvibe-tl-team-two' === $this->get_name() ) :
                            $profile_url = tutor_utils()->profile_url( $user->ID );
                            $job         = get_the_author_meta('_tutor_profile_job_title', $user->ID );
                        elseif ( 'eduvibe-lp-team-two' === $this->get_name() ) :
                            $profile_url = eduvibe_lp_author_profile_url( $user->ID );
                            $job         = $user->eduvibe_job;
                        endif;
                        echo '<div ' . $this->get_render_attribute_string( 'single-wrapper' ) . '>';
                            echo '<div class="edu-instructor-grid edu-instructor-3' . ( $settings['dynamic_default_active_item'] == $key ? ' eduvibe-hover-active' : '' ) . ( 'slider' === $settings['display_type'] ? ' edu-instructor-3-slider-visible' : ' edu-instructor-3-visible' ) . '">';
                                echo '<div class="edu-instructor">';
                                    echo '<div class="inner">';
                                        echo '<div class="thumbnail">';
                                            echo 'yes' === $enable_profile_link ? '<a href="' . esc_url( $profile_url ) . '">' : '';
                                                echo get_avatar( $user->ID, $settings['image_size']['size'], null, null, array( 'class' => array( 'eduvibe-instructor-image' ) ) );
                                            echo 'yes' === $enable_profile_link ? '</a>' : '';
                                        echo '</div>';

                                        echo '<div class="edu-instructor-info">';
                                            echo '<h5 class="title">';
                                                echo 'yes' === $enable_profile_link ? '<a href="' . esc_url( $profile_url ) . '">' : '';
                                                    echo esc_html( $user->display_name );
                                                echo 'yes' === $enable_profile_link ? '</a>' : '';
                                            echo '</h5>';

                                            if ( 'yes' === $settings['enable_designation'] && ! empty( $job ) ) :
                                                echo '<span class="team-member-designation">' . esc_html( $job ) . '</span>';
                                            endif;

                                            if ( 'yes' === $settings['enable_social_icons'] ) :
                                                echo '<div class="team-share-info bg-transparent">';
                                                    eduvibe_user_social_icons( $user->ID, $link_tab, $this->instructor );
                                                echo '</div>';
                                            endif;

                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    endforeach;
                echo '</div>';
            endif;
        endif;
    }
}