<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package   quizaccess_quizoptions
 * @author    Manu Fraile Yarza (manuel.fraile@deusto.es)
 * @copyright Smiley Owl Tech S.L.
 * @contact   mikel.labayen@smowltech.com
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
require_once($CFG->dirroot . '/mod/quiz/backup/moodle2/backup_mod_quiz_access_subplugin.class.php');

defined('MOODLE_INTERNAL') || die();


/**
 * Provides the information to backup the quizoptions quiz access plugin.
 *
 * If this plugin is requires, a single
 * <quizaccess_quizoptions><required>1</required></quizaccess_quizoptions> tag
 * will be added to the XML in the appropriate place. Otherwise nothing will be
 * added. This matches the DB structure.
 */
class backup_quizaccess_quizoptions_subplugin extends backup_mod_quiz_access_subplugin {

    protected function define_quiz_subplugin_structure() {

        // Create XML elements.
        $subplugin = $this->get_subplugin_element();
        $subpluginwrapper = new backup_nested_element($this->get_recommended_name());
        $subplugintablesettings = new backup_nested_element('quizaccess_quizoptions',
                null, array('quizoptionsrequired'));

        // Connect XML elements into the tree.
        $subplugin->add_child($subpluginwrapper);
        $subpluginwrapper->add_child($subplugintablesettings);

        // Set source to populate the data.
        $subplugintablesettings->set_source_table('options_smowl_quiz',
                array('quizid' => backup::VAR_ACTIVITYID));

        return $subplugin;
    }
}
