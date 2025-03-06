<?php

namespace EduVibeCore\HF\Widgets;

use \EduVibe\Navwalker\WP_Bootstrap_Navwalker;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Icons_Manager;
use \Elementor\Plugin;
use \Elementor\Widget_Base;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * EduVibe Core
 *
 * Elementor widget for navigation menu.
 *
 * @since 1.0.0
 */
class Nav_Menu extends Widget_Base {

    /**
     * Menu index.
     *
     * @access protected
     * @var $nav_menu_index
     */
    protected $nav_menu_index = 1;

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
		return 'eduvibe-nav-menu';
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
		return __( 'Nav Menu', 'eduvibe-core' );
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
        return 'eduvibe-elementor-icon eicon-nav-menu';
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
		return [ 'eduvibe', 'menu', 'nav', 'navigation' ];
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
		return [ 'eduvibe_hf_elementor_widgets' ];
	}

    /**
     * Retrieve the menu index.
     *
     * Used to get index of nav menu.
     *
     * @since 1.0.0
     * @access protected
     *
     * @return string nav index.
     */
    protected function get_nav_menu_index() {
        return $this->nav_menu_index++;
    }

    /**
     * Retrieve the list of available menus.
     *
     * Used to get the list of available menus.
     *
     * @since 1.0.0
     * @access private
     *
     * @return array get WordPress menus list.
     */
    private function get_available_menus() {

        $menus   = wp_get_nav_menus();
        $options = [];
        foreach ( $menus as $menu ) :
            $options[ $menu->slug ] = $menu->name;
        endforeach;
        return $options;
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
            'section_nav_menu',
            [
                'label' => __( 'Nav Menu', 'eduvibe-core' )
            ]
        );

        $menus = $this->get_available_menus();

        if ( ! empty( $menus ) ) :
            $this->add_control(
                'menu',
                [
                    'label'        => __( 'Menu', 'eduvibe-core' ),
                    'type'         => Controls_Manager::SELECT,
                    'options'      => $menus,
                    'default'      => array_keys( $menus )[0],
                    'save_default' => true,
                    'separator'    => 'after',
                    'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'eduvibe-core' ), admin_url( 'nav-menus.php' ) )
                ]
            );
        else :
            $this->add_control(
                'menu_alert',
                [
                    'type'            => Controls_Manager::RAW_HTML,
                    'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'eduvibe-core' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
                    'separator'       => 'after',
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-info'
                ]
            );
        endif;

        $this->add_responsive_control(
            'alignment',
            [
                'label'             => __( 'Alignment', 'eduvibe-core' ),
                'type'              => Controls_Manager::CHOOSE,
                'options'           => [
                    'flex-start'    => [
                        'title'     => __( 'Left', 'eduvibe-core' ),
                        'icon'      => 'eicon-h-align-left'
                    ],
                    'center'        => [
                        'title'     => __( 'Center', 'eduvibe-core' ),
                        'icon'      => 'eicon-h-align-center'
                    ],
                    'flex-end'      => [
                        'title'     => __( 'Right', 'eduvibe-core' ),
                        'icon'      => 'eicon-h-align-right'
                    ],
                    'space-between' => [
                        'title'     => __( 'Justify', 'eduvibe-core' ),
                        'icon'      => 'eicon-h-align-stretch'
                    ]
                ],
                'selectors'         => [
                    '{{WRAPPER}} .eduvibe-navbar-expand-lg .eduvibe-navbar-nav' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_menu_responsive',
            [
                'label' => __( 'Responsive', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'breakpoint',
            [
                'label'        => __( 'Breakpoint', 'eduvibe-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'tablet',
                'options'      => [
                    'mobile'   => __( 'Mobile (768px >)', 'eduvibe-core' ),
                    'tablet'   => __( 'Tablet (992px >)', 'eduvibe-core' ),
                    'big-tablet' => __( 'Big Tablet (1200px >)', 'eduvibe-core' ),
                    'none'     => __( 'None', 'eduvibe-core' )
                ],
                'prefix_class' => 'eduvibe-nav-menu-breakpoint-'
            ]
        );

        $this->add_control(
            'menu_icon',
            [
                'label'       => __( 'Menu Icon', 'eduvibe-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-bars',
                    'library' => 'fa-solid'
                ]
            ]
        );

        $this->add_control(
            'close_icon',
            [
                'label'       => __( 'Icon', 'eduvibe-core' ),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fas fa-times',
                    'library' => 'fa-solid'
                ]
            ]
        );

        $spacing = is_rtl() ? 'left' : 'right';
        $this->add_control(
            'toggle_alignment',
            [
                'label'          => __( 'Toggle Alignment', 'eduvibe-core' ),
                'type'           => Controls_Manager::CHOOSE,
                'options'        => [
                    'flex-start' => [
                        'title'  => __( 'Left', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-left'
                    ],
                    'center'     => [
                        'title'  => __( 'Center', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-center'
                    ],
                    'flex-end'   => [
                        'title'  => __( 'Right', 'eduvibe-core' ),
                        'icon'   => 'eicon-text-align-right'
                    ]
                ],
                'selectors'      => [
                    '{{WRAPPER}} .eduvibe-elementor-mobile-hamburger-menu' => 'justify-content: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'nav_menu_style',
            [
                'label' => __( 'Nav Menu', 'eduvibe-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'menu_typography',
                'selector' => '{{WRAPPER}} .eduvibe-header-area.eduvibe-navbar-expand-lg ul.eduvibe-navbar-nav > li > a.nav-link'
            ]
        );

        $last_child_padding = is_rtl() ? 'left' : 'right';
        $this->add_responsive_control(
            'menu_padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-header-area.eduvibe-navbar-expand-lg ul.eduvibe-navbar-nav > li' => 'padding: 0 {{RIGHT}}{{UNIT}} 0 {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .eduvibe-header-area.eduvibe-navbar-expand-lg ul.eduvibe-navbar-nav > li > a.nav-link' => 'padding: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
                    '{{WRAPPER}} .eduvibe-header-area.eduvibe-navbar-expand-lg ul.eduvibe-navbar-nav > li:last-child' => 'padding-' . $last_child_padding . ': 0;'
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_margin',
            [
                'label'      => __( 'Margin', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-header-area.eduvibe-navbar-expand-lg ul.eduvibe-navbar-nav > li > a.nav-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'menu_style_tabs' );

            $this->start_controls_tab( 'menu_normal', [ 'label' => __( 'Normal', 'eduvibe-core' ) ] );

            $this->add_control(
                'menu_color',
                [
                    'label'     => __( 'Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .eduvibe-header-area.eduvibe-navbar-expand-lg ul.eduvibe-navbar-nav > li > a.nav-link' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'menu_hover', [ 'label' => __( 'Hover', 'eduvibe-core' ) ] );

            $this->add_control(
                'menu_hover_color',
                [
                    'label'     => __( 'Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .eduvibe-header-area.eduvibe-navbar-expand-lg ul.eduvibe-navbar-nav > li:hover > a.nav-link' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'menu_bar_style',
            [
                'label'     => __( 'Menu Bottom Bar', 'eduvibe-core' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'menu_bar_color',
            [
                'label'     => __( 'Color( Hover/Active )', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-header-area .main-navigation ul.eduvibe-navbar-nav > li.current-menu-item > a:after, {{WRAPPER}} .eduvibe-header-area .main-navigation ul.eduvibe-navbar-nav > li:hover > a:after' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_bar_size',
            [
                'label'       => __( 'Size', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 10
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .eduvibe-header-area .main-navigation ul.eduvibe-navbar-nav > li > a:after'  => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'menu_bar_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'      => '5',
                    'right'    => '5',
                    'bottom'   => '0',
                    'left'     => '0',
                    'unit'     => 'px',
                    'isLinked' => false
                ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-header-area .main-navigation ul.eduvibe-navbar-nav > li > a:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dropdown_style',
            [
                'label' => __( 'Dropdown', 'eduvibe-core' ),
                'tab'   => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'dropdwon_width',
            [
                'label'       => __( 'Width', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 800
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .eduvibe-header-area .main-navigation ul ul.eduvibe-dropdown-menu'  => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'dropdown_typography',
                'selector' => '{{WRAPPER}} .eduvibe-header-area ul.eduvibe-navbar-nav .dropdown ul.eduvibe-dropdown-menu li a'
            ]
        );

        $this->add_responsive_control(
            'dropdown_menu_padding',
            [
                'label'      => __( 'Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-header-area ul.eduvibe-navbar-nav .dropdown ul.eduvibe-dropdown-menu li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'dropdown_menu_border_radius',
            [
                'label'      => __( 'Border Radius', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-header-area ul.eduvibe-navbar-nav .dropdown ul.eduvibe-dropdown-menu li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->start_controls_tabs( 'dropdown_style_tabs' );

            $this->start_controls_tab( 'dropdown_normal', [ 'label' => __( 'Normal', 'eduvibe-core' ) ] );

            $this->add_control(
                'dropdown_color',
                [
                    'label'     => __( 'Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .eduvibe-header-area ul.eduvibe-navbar-nav .dropdown ul.eduvibe-dropdown-menu li a' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'dropdown_bg_color',
                [
                    'label'     => __( 'Background Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .eduvibe-header-area ul.eduvibe-navbar-nav .dropdown ul.eduvibe-dropdown-menu li a' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab( 'dropdown_hover', [ 'label' => __( 'Hover', 'eduvibe-core' ) ] );

            $this->add_control(
                'dropdown_hover_color',
                [
                    'label'     => __( 'Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .eduvibe-header-area ul.eduvibe-navbar-nav .dropdown ul.eduvibe-dropdown-menu li a:hover' => 'color: {{VALUE}};'
                    ]
                ]
            );

            $this->add_control(
                'dropdown_hover_bg_color',
                [
                    'label'     => __( 'Background Color', 'eduvibe-core' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .eduvibe-header-area ul.eduvibe-navbar-nav .dropdown ul.eduvibe-dropdown-menu li a:hover' => 'background-color: {{VALUE}};'
                    ]
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'responsive_style',
            [
                'label'     => __( 'Responsive', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'toggle_menu_color',
            [
                'label'     => __( 'Toggle Menu Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-elementor-mobile-hamburger-menu a, {{WRAPPER}} .eduvibe-header-transparent-enable .eduvibe-sticky-header-wrapper:not(.eduvibe-header-sticky) .eduvibe-elementor-mobile-hamburger-menu a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'toggle_menu_size',
            [
                'label'       => __( 'Toggle Menu Size', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 50
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .eduvibe-elementor-mobile-hamburger-menu a'  => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'close_icon_color',
            [
                'label'     => __( 'Close Icon Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-elementor-mobile-menu-close a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'close_icon_size',
            [
                'label'       => __( 'Close Icon Size', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'max' => 50
                    ]
                ],
                'selectors'   => [
                    '{{WRAPPER}} .eduvibe-elementor-mobile-menu-close a'  => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label'     => __( 'Overlay Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-elementor-mobile-menu-overlay' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'mobile_menu_padding',
            [
                'label'      => __( 'Mobile Menu Padding', 'eduvibe-core' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .eduvibe-mobile-menu-nav-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'mobile_menu_bg_color',
            [
                'label'     => __( 'Mobile Menu Background Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-mobile-menu-nav-wrapper' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'mobile_menu_color',
            [
                'label'     => __( 'Mobile Menu Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .eduvibe-mobile-menu-nav-wrapper ul li a, {{WRAPPER}} .eduvibe-header-transparent-enable .eduvibe-sticky-header-wrapper:not(.eduvibe-header-sticky) ul.eduvibe-elementor-mobile-menu-item > li > a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'mobile_menu_border',
                'selector' => '{{WRAPPER}} .eduvibe-mobile-menu-nav-wrapper ul li a, {{WRAPPER}} .eduvibe-header-transparent-enable .eduvibe-sticky-header-wrapper:not(.eduvibe-header-sticky) ul.eduvibe-elementor-mobile-menu-item > li > a'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'transparent_and_sticky_style',
            [
                'label'     => __( 'Transparent & Sticky', 'eduvibe-core' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'transparent_alert_text',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => __( 'If you set this Header as Transparent and Sticky then this section style will work. This style will be applied when the transparent menu will be hidden and get sticky.', 'eduvibe-core' ),
                'content_classes' => 'eduvibe-elementor-widget-alert elementor-panel-alert elementor-panel-alert-warning'
            ]
        );

        $this->add_control(
            'toggle_menu_transparent_sticky_color',
            [
                'label'     => __( 'Toggle Menu Color', 'eduvibe-core' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '.eduvibe-header-transparent-enable .eduvibe-sticky-header-wrapper.eduvibe-header-sticky {{WRAPPER}} .eduvibe-elementor-mobile-hamburger-menu a' => 'color: {{VALUE}};'
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
        $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],
            'menu_class'  => 'eduvibe-navbar-nav eduvibe-navbar-right nav-menu eduvibe-nav-ul-wrapper',
            'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
            'fallback_cb' => '__return_empty_string',
            'container'   => '',
            'walker'      => new WP_Bootstrap_Navwalker
        ];

        $menu_html = wp_nav_menu( $args );

        $this->add_render_attribute( 'wrapper', 'class', 'eduvibe-nav-menu-wrapper eduvibe-header-area eduvibe-navbar-expand-lg eduvibe-elementor-nav-menu-wrapper' );

        $this->add_render_attribute( 'menu', 'class', 'main-navigation eduvibe-navbar-collapse eduvibe-elementor-nav' );

        echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
            echo '<nav ' . $this->get_render_attribute_string( 'menu' ) . '>';
                echo trim( $menu_html );
            echo '</nav>';

            echo '<div class="eduvibe-default-header-mobile-navbar eduvibe-mobile-menu">';
                echo '<div class="eduvibe-elementor-mobile-menu-overlay"></div>';
                echo '<div class="eduvibe-elementor-mobile-hamburger-menu">';
                    echo '<a href="javascript:void(0);">';
                        Icons_Manager::render_icon( $settings['menu_icon'], [ 'aria-hidden' => 'true' ] );
                    echo '</a>';
                echo '</div>';
                echo '<div class="eduvibe-mobile-menu-nav-wrapper eduvibe-elementor-mobile-menu-nav-wrapper">';
                    echo '<div class="eduvibe-elementor-mobile-menu-close">';
                        echo '<a href="javascript:void(0);">';
                            Icons_Manager::render_icon( $settings['close_icon'], [ 'aria-hidden' => 'true' ] );
                        echo '</a>';
                    echo '</div>';
                    wp_nav_menu( array(
                        'menu'       => $settings['menu'],
                        'depth'      => 4,
                        'container'  => 'ul',
                        'menu_id'    => 'eduvibe-elementor-mobile-menu-item',
                        'menu_class' => 'eduvibe-elementor-mobile-menu-item'                     
                    ) );
                echo '</div>';
            echo '</div>';
        echo '</div>';

        if ( Plugin::$instance->editor->is_edit_mode() ) :
            $this->render_editor_script();
        endif;
    }

    private function render_editor_script(){ 
        ?>
        <script type="text/javascript">
            jQuery( document ).ready( function($) {
                $( '.main-navigation ul > li.mega-menu' ).each( function() {
                    let items       = $(this).find( ' > ul.eduvibe-dropdown-menu > li' ).length,
                    bodyWidth       = $( 'body' ).outerWidth(),
                    parentLinkWidth = $(this).find( ' > a' ).outerWidth(),
                    parentLinkpos   = $(this).find( ' > a' ).offset().left,
                    width           = items * 250,
                    left            = width / 2 - parentLinkWidth / 2,
                    linkleftWidth   = parentLinkpos + parentLinkWidth / 2,
                    linkRightWidth  = bodyWidth - (parentLinkpos + parentLinkWidth);

                    if (width / 2 > linkleftWidth) {
                        $(this).find( ' > ul.eduvibe-dropdown-menu' ).css( {
                            width: width + 'px',
                            right: 'inherit',
                            left: '-' + parentLinkpos + 'px'
                        } );
                    } else if (width / 2 > linkRightWidth) {
                        $(this).find( ' > ul.eduvibe-dropdown-menu' ).css( {
                            width: width + 'px',
                            left: 'inherit',
                            right: '-' + linkRightWidth + 'px'
                        } );
                    } else {
                        $(this).find( ' > ul.eduvibe-dropdown-menu' ).css( {
                            width: width + 'px',
                            left: '-' + left + 'px'
                        } );
                    }
                } );
            } );
        </script>
        <?php
    }
}