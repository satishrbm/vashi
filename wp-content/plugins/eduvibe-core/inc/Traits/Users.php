<?php

namespace EduVibe_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \EduVibeCore\Helper;
use \Elementor\Controls_Manager;
trait Users {

    protected function query() {
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
            'image_size',
            [
                'label'       => __( 'Image Size', 'eduvibe-core' ),
                'type'        => Controls_Manager::SLIDER,
                'size_units'  => [ 'px' ],
                'range'       => [
                    'px'      => [
                        'min' => 100,
                        'max' => 1200
                    ]
                ],
                'default'     => [
                    'unit'    => 'px',
                    'size'    => $this->image_size
                ]
            ]
        );

        $this->add_control(
            'per_page',
            [
                'label'         => __( 'Number Of Instructors', 'eduvibe-core' ),
                'type'          => Controls_Manager::SLIDER,
                'description'   =>  __( 'Number of instructors to show. Default -1, it will show all.', 'eduvibe-core' ),
                'default'       => [
                    'size'      => -1,
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
                'description'       => __( 'Orderby', 'eduvibe-core' ),
                'options'           => [
                    'none'            => __( 'No order', 'eduvibe-core' ),
                    'ID'              => __( 'User ID', 'eduvibe-core' ),
                    'display_name'    => __( 'Display Name', 'eduvibe-core' ),
                    'user_name'       => __( 'User Name', 'eduvibe-core' ),
                    'include'         => __( 'Include', 'eduvibe-core' ),
                    'user_login'      => __( 'User Login', 'eduvibe-core' ),
                    'user_nicename'   => __( 'User Nicename', 'eduvibe-core' ),
                    'user_url'        => __( 'User URL', 'eduvibe-core' ),
                    'user_registered' => __( 'User Registered', 'eduvibe-core' ),
                    'post_count'      => __( 'Post Count', 'eduvibe-core' )
                ]
            ]
        );
        
        $this->add_control(
            'specific_user_include',
            [   
                'label'       => __( 'Specific Instructors( Include )', 'eduvibe-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => eduvibe_get_all_instructors( $this->instructor ),
                'description' => __( 'It will show the selected instructors only.', 'eduvibe-core' )

            ]
        );

        $this->add_control(
            'specific_user_exclude',
            [   
                'label'       => __( 'Specific Instructors( Exclude )', 'eduvibe-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => eduvibe_get_all_instructors( $this->instructor ),
                'description' => __( 'It will hide the selected instructors only.', 'eduvibe-core' )

            ]
        );

        $this->end_controls_section();
    }
}