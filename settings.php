<?php
// This file is part of the Local welcome plugin
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

defined('MOODLE_INTERNAL') || die;
$config = get_config('local_leads');

if (is_siteadmin()) {
    $settings = new admin_settingpage('local_leads', get_string('pluginname', 'local_leads'));
    $ADMIN->add('localplugins', $settings);

    $name = 'local_leads/orbiturl';
    $setting = new admin_setting_configtext($name, 'Orbit API endpoint', null, 0);
    $settings->add($setting);

    $name = 'local_leads/orbituser';
    $setting = new admin_setting_configtext($name, 'Orbit User', null, 0);
    $settings->add($setting);

    $name = 'local_leads/orbitpass';
    $setting = new admin_setting_configpasswordunmask($name, 'Orbit Password', null, 0);
    $settings->add($setting);
}