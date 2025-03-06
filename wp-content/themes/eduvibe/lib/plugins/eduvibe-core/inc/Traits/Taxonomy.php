<?php

namespace EduVibe_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \EduVibeCore\Helper;
use \Elementor\Controls_Manager;

trait Taxonomy {

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
            'items_to_show',
            [
                'label'       => __( 'Number of Category to Show.', 'eduvibe-core' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 0,
                'min'         => 0,
                'step'        => 1,
                'description' => __( 'Default 0. It will show all the category items.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'include_categories',
            [
                'label'       => __( 'Include Specific Category', 'eduvibe-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => Helper::retrieve_categories( $this->taxomy_name ),
                'multiple'    => true
            ]
        );

        $this->add_control(
            'exclude_categories',
            [
                'label'       => __( 'Exclude Specific Category', 'eduvibe-core' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT2,
                'options'     => Helper::retrieve_categories( $this->taxomy_name ),
                'multiple'    => true,
                'description' => __( 'Either use exclude or include, don\'t use both together.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'order_by',
            [
                'type'    => Controls_Manager::SELECT,
                'label'   => __( 'Order by', 'eduvibe-core' ),
                'default' => 'name',
                'options' => [
                    'name'       => __( 'Name', 'eduvibe-core' ),
                    'id'         => __( 'ID', 'eduvibe-core' ),
                    'count'      => __( 'Count', 'eduvibe-core' ),
                    'slug'       => __( 'Slug', 'eduvibe-core' ),
                    'term_group' => __( 'Term Group', 'eduvibe-core' ),
                    'none'       => __( 'None', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'order',
            [
                'type'          => Controls_Manager::SELECT,
                'label'         => __( 'Order', 'eduvibe-core' ),
                'default'       => 'DESC',
                'options'       => [
                    'ASC'       => __( 'Ascending', 'eduvibe-core' ),
                    'DESC'      => __( 'Descending', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'enable_parent_only',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Only Top Level Category?', 'eduvibe-core' ),
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'no',
                'return_value' => 'yes',
                'description'  => __( 'By enabling this option, only top level category will show.', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'hide_empty_cat',
            [
                'type'         => Controls_Manager::SWITCHER,
                'label'        => __( 'Empty Category', 'eduvibe-core' ),
                'label_on'     => __( 'Enable', 'eduvibe-core' ),
                'label_off'    => __( 'Disable', 'eduvibe-core' ),
                'default'      => 'yes',
                'return_value' => 'yes'
            ]
        );

        $this->end_controls_section();
    }
}