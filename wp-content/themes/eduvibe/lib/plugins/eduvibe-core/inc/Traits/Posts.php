<?php

namespace EduVibe_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \EduVibeCore\Helper;
use \Elementor\Controls_Manager;
trait Posts {

    protected function query() {

        $excerpt_support = [
            'eduvibe-post-slider',
            'eduvibe-events-one',
            'eduvibe-events-two',
            'eduvibe-lp-course-slider',
            'eduvibe-ld-course-slider',
            'eduvibe-tl-course-slider'
        ];

        if ( NULL === $this->post_type ) :
            $this->post_type = 'post';
        endif;

        if ( NULL === $this->default_content_type ) :
            $this->start_controls_section(
                'query_settings',
                [
                    'label'     => __( 'Query Settings', 'eduvibe-core' )
                ]
            );
        else :
            $this->start_controls_section(
                'query_settings',
                [
                    'label'     => __( 'Query Settings', 'eduvibe-core' ),
                    'condition' => [
                        'content_type' => 'dynamic'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'per_page',
            [
                'label'         => __( 'Number Of Posts', 'eduvibe-core' ),
                'type'          => Controls_Manager::SLIDER,
                'description'   =>  __( 'Number of posts to show. Default 6. If you want to show all the posts then put <b>-1</b>', 'eduvibe-core' ),
                'default'       => [
                    'size'      => 6,
                ],
                'range'         => [
                    'px'        => [
                        'min'   => -1
                    ]
                ]
            ]
        ); 

        $this->add_control(
            'order',
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
            'order_by',
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
            'specific_post_include',
            [   
                'label'       => __( 'Specific Posts( Include )', 'eduvibe-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => Helper::retrieve_posts( $this->post_type ),
                'description' => __( 'It will show the selected posts only.', 'eduvibe-core' )

            ]
        );

        $this->add_control(
            'specific_post_exclude',
            [   
                'label'       => __( 'Specific Posts( Exclude )', 'eduvibe-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => Helper::retrieve_posts( $this->post_type ),
                'description' => __( 'It will hide the selected posts only.', 'eduvibe-core' )

            ]
        );

        $this->add_control(
            'enable_only_featured_posts',
            [
                'label'        => __( 'Only Has Featured Image', 'eduvibe-core' ),
                'type'         => Controls_Manager::SWITCHER,    
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'description'  => __( 'Only show posts which has feature image set.', 'eduvibe-core' ),           
                'default'      => 'no',
                'return_value' => 'yes'
            ]
        );

        if ( 'post' === $this->post_type ) :
            $this->add_control(
                'ignore_sticky',
                [
                    'type'         => Controls_Manager::SWITCHER,
                    'label'        => __( 'Ignore Sticky Posts?', 'eduvibe-core' ),
                    'label_on'     => __( 'Enable', 'eduvibe-core' ),
                    'label_off'    => __( 'Disable', 'eduvibe-core' ),
                    'default'      => 'no',
                    'return_value' => 'yes'
                ]
            );
        endif;

        if ( 'post' === $this->post_type || 'simple_event' === $this->post_type ) :
            $this->add_control(
                'enable_date',
                [
                    'type'         => Controls_Manager::SWITCHER,
                    'label'        => __( 'Date', 'eduvibe-core' ),
                    'label_on'     => __( 'Enable', 'eduvibe-core' ),
                    'label_off'    => __( 'Disable', 'eduvibe-core' ),
                    'default'      => 'yes',
                    'return_value' => 'yes'
                ]
            );
        endif;

        if ( 'post' === $this->post_type ) :
            $this->add_control(
                'date_format',
                [
                    'type'            => Controls_Manager::SELECT,
                    'label'           => __( 'Date Format', 'eduvibe-core' ),
                    'default'         => 'default',
                    'options'         => [
                        'default'     => __( 'Default', 'eduvibe-core' ),
                        'F j, Y'      => __( 'F j, Y', 'eduvibe-core' ),
                        'Y-m-d'       => __( 'Y-m-d', 'eduvibe-core' ),
                        'm/d/Y'       => __( 'm/d/Y', 'eduvibe-core' ),
                        'd/m/Y'       => __( 'd/m/Y', 'eduvibe-core' ),
                        'j M. Y'      => __( 'j M. Y', 'eduvibe-core' ),
                        'l F j, Y'    => __( 'l F j, Y', 'eduvibe-core' ),
                        'D M j'       => __( 'D M j', 'eduvibe-core' ),
                        'dS M Y'      => __( 'dS M Y', 'eduvibe-core' ),
                        'F Y'         => __( 'F Y', 'eduvibe-core' ),
                        'custom'      => __( 'Custom', 'eduvibe-core' )
                    ],
                    'condition'       => [
                        'enable_date' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'custom_date_format',
                [   
                    'label'           => __( 'Custom Date Format', 'eduvibe-core' ),
                    'type'            => Controls_Manager::TEXT,
                    'default'         => __( 'F j, Y', 'eduvibe-core' ),
                    'condition'       => [
                        'enable_date' => 'yes',
                        'date_format' => 'custom'
                    ]
                ]
            );
        endif;

        if ( in_array( $this->get_name(), $excerpt_support ) ) :
            $this->add_control(
                'enable_excerpt',
                [
                    'label'        => __( 'Excerpt.', 'eduvibe-core' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => __( 'Enable', 'eduvibe-core' ),
                    'label_off'    => __( 'Disable', 'eduvibe-core' ),
                    'default'      => 'yes',
                    'return_value' => 'yes'
                ]
            );  

            $this->add_control(
                'excerpt_length',
                [
                    'label'       => __( 'Number of Words', 'eduvibe-core' ),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 20,
                    'description' => __( 'Number of excerpt words.', 'eduvibe-core' ),
                    'condition'   => [
                        'enable_excerpt' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'excerpt_end',
                [
                    'label'       => __( 'Excerpt End Text', 'eduvibe-core' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => '...',
                    'description' => __( 'Content to show at the end of the excerpt. Default: ...', 'eduvibe-core' ),
                    'condition'   => [
                        'enable_excerpt' => 'yes'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'include_categories',
            [
                'label'       => __( 'Include Specific Category', 'eduvibe-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => Helper::retrieve_categories( $this->category_taxonomy, true ),
                'multiple'    => true
            ]
        );

        $this->end_controls_section();
    }
}