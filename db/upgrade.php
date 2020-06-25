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

defined('MOODLE_INTERNAL') || die();


function xmldb_local_leads_upgrade($oldversion)
{
    global $CFG, $DB;
    $dbman = $DB->get_manager();

/*    if ($oldversion <= 2020013100.20) {

        $table = new xmldb_table('local_leads_recordings');
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null, null);
        $table->add_field('meetingid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, null, 'id');
        $table->add_field('status', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'meetingid');
        $table->add_field('type', XMLDB_TYPE_CHAR, '10', null, null, null, null, 'status');
        $table->add_field('recordingstart', XMLDB_TYPE_INTEGER, '10', null, null, null, '0', 'type');
        $table->add_field('recordingend', XMLDB_TYPE_INTEGER, '10', null, null, null, '0', 'recordingstart');
        $table->add_field('response', XMLDB_TYPE_TEXT, null, null, null, null, '0', 'recordingend');
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0', 'response');
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);

        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }
    }*/

    return true;
}
