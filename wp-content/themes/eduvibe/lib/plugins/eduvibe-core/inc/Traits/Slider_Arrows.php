<?php

namespace EduVibe_Core\Traits;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;

trait Slider_Arrows {

	protected function arrows() {
		if( 'slider' === $this->default_display_type ) :
			$this->start_controls_section(
	            'arrows_style',
	            [
	                'label'     => __( 'Arrows', 'eduvibe-core' ),
	                'tab'       => Controls_Manager::TAB_STYLE,
	                'condition' => [
	                    'arrows_and_dots' => [ 'arrows', 'both' ]
	                ]
	            ]
	        );
	    else :
	    	$this->start_controls_section(
	            'arrows_style',
	            [
	                'label'     => __( 'Arrows', 'eduvibe-core' ),
	                'tab'       => Controls_Manager::TAB_STYLE,
	                'condition' => [
						'arrows_and_dots' => [ 'arrows', 'both' ],
						'display_type'    => 'slider'
	                ]
	            ]
	        );
	   	endif;

        $this->add_control(
            'arrows_position',
            [
                'label'       => __( 'Position', 'eduvibe-core' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'default',
                'options'     => [
                    'default'   => __( 'Default', 'eduvibe-core' ),
                    'top-right' => __( 'Top Right', 'eduvibe-core' )
                ]
            ]
        );

    	$this->end_controls_section();
	}
}