<?php
namespace EduVibeCore\LP\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Team_Three extends \EduVibeCore\Widgets\Team_Three {

    public function get_name() {
        return 'eduvibe-lp-team-three';
    }

    public function get_keywords() {
        return [ 'eduvibe', 'learnpress', 'lms', 'employee', 'member', 'worker', 'team',  'instructor', 'staff', 'carousel', 'slider' ];
    }
}