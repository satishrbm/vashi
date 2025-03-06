<?php

namespace EduVibeCore\LP\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Course_Category extends \EduVibeCore\Widgets\Course_Category {

	public function get_name() {
		return 'eduvibe-lp-course-category';
	}

    public function get_title() {
        return __( 'LearnPress Course Category', 'eduvibe-core' );
    }

    public function get_keywords() {
        return [ 'eduvibe', 'category', 'static', 'learnpress', 'lms', 'taxonomy', 'categories' ];
    }
}