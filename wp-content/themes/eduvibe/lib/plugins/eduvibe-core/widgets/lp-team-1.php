<?php
namespace EduVibeCore\LP\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Team_One extends \EduVibeCore\Widgets\Team_One {

    public function get_name() {
        return 'eduvibe-lp-team-one';
    }

    public function get_keywords() {
        return [ 'eduvibe', 'learnpress', 'lms', 'employee', 'member', 'worker', 'team',  'instructor', 'staff', 'carousel', 'slider' ];
    }
}