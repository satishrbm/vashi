<?php

namespace EduVibe_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \Elementor\Controls_Manager;

trait Grid {

	protected function settings() {

        if( 'grid' === $this->default_display_type ) :
            $this->start_controls_section(
                'grid_settings',
                [
                    'label'     => __( 'Grid Settings', 'eduvibe-core' )
                ]
            );
        else :
            $this->start_controls_section(
                'grid_settings',
                [
                    'label'     => __( 'Grid Settings', 'eduvibe-core' ),
                    'condition' => [
                        'display_type' => 'grid'
                    ]
                ]
            );
        endif;

        $this->add_control(
            'desktop_grid_columns',
            [
                'label'        => __( 'Desktop Columns', 'eduvibe-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => $this->desktop_default_grid,
                'options'      => [
                    '1' => __( '1 Column', 'eduvibe-core' ),
                    '2' => __( '2 Columns', 'eduvibe-core' ),
                    '3' => __( '3 Columns', 'eduvibe-core' ),
                    '4' => __( '4 Columns', 'eduvibe-core' ),
                    '6' => __( '6 Columns', 'eduvibe-core' )
                ]
            ]
        );

        $this->add_control(
            'tablet_grid_columns',
            [
                'label'        => __( 'Tablet Columns', 'eduvibe-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => $this->tablet_default_grid,
                'options'      => [
                    '1' => __( '1 Column', 'eduvibe-core' ),
                    '2' => __( '2 Columns', 'eduvibe-core' ),
                    '3' => __( '3 Columns', 'eduvibe-core' ),
                    '4' => __( '4 Columns', 'eduvibe-core' ),
                    '6' => __( '6 Columns', 'eduvibe-core' )
                ],
                'description'  => __( 'Number of columns in tablet( from 992 px ).', 'eduvibe-core' )
            ]
        );

        $this->add_control(
            'mobile_grid_columns',
            [
                'label'        => __( 'Mobile Columns', 'eduvibe-core' ),
                'type'         => Controls_Manager::SELECT,
                'default'      => $this->mobile_default_grid,
                'options'      => [
                    '1' => __( '1 Column', 'eduvibe-core' ),
                    '2' => __( '2 Columns', 'eduvibe-core' ),
                    '3' => __( '3 Columns', 'eduvibe-core' ),
                    '4' => __( '4 Columns', 'eduvibe-core' ),
                    '6' => __( '6 Columns', 'eduvibe-core' )
                ],
                'description'  => __( 'Number of columns in mobile( works between 768 to 576 px ).', 'eduvibe-core' )
            ]
        );

        $this->end_controls_section();
	}
}