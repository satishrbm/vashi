<?php
namespace EduVibeCore\LP\Widgets;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Team_Two extends \EduVibeCore\Widgets\Team_Two {

    public function get_name() {
        return 'eduvibe-lp-team-two';
    }

    public function get_keywords() {
        return [ 'eduvibe', 'learnpress', 'lms', 'employee', 'member', 'worker', 'team',  'instructor', 'staff', 'carousel', 'slider' ];
    }
}