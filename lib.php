<?php

/**
 * @since      08-Aug-2016
 * @package    local_akindi
 * @author     David Wolever <david@wolever.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

require_once("$CFG->dirroot/user/profile/lib.php");

/**
 * Extends course navigation with the Akindi link.
 *
 * @param navigation_node $navigation The navigation node to extend
 * @param stdClass $course The course to object for the report
 * @param stdClass $context The context of the course
 */
function local_akindi_extend_navigation_course($navigation, $course, $context) {
  global $CFG;
  if (has_capability('moodle/grade:edit', $context)) {
    $url = new moodle_url('/local/akindi/launch.php', array('id'=>$course->id));
    $navigation->add('Launch Akindi', $url, navigation_node::TYPE_SETTING, null, null, new pix_icon('i/navigationitem', ''));
      
  }
}

/**
 * Returns the possible fields used for student ID numbers.
 */
function ak_settings_get_student_id_options() {
  $options = array(
    'idnumber'=>"ID number (idnumber)",
    'userid'=>"Moodle user id (userid)",
  );
  $customfields = profile_get_custom_fields();
  foreach ($customfields as $field) {
    $options[$field->shortname] = "{$field->name} ({$field->shortname})";
  }
  return $options;
}
