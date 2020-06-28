<?php
/**
 * zoom Moodle.
 *
 * @package    local_leads_Moodle
 * @copyright  2020 - mofet
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

function xmldb_local_leads_install()
{
    global $CFG;

    // We always want to run the upgrade.
    require_once($CFG->dirroot . '/local/leads/db/upgrade.php');
    return xmldb_local_leads_upgrade(0);
}
