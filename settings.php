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

require_once('remote/Math/BigInteger.php');
require_once('remote/Crypt/Random.php');
require_once('remote/Crypt/RC4.php');
require_once('remote/Crypt/Rijndael.php');
require_once('remote/Crypt/Twofish.php');
require_once('remote/Crypt/Blowfish.php');
require_once('remote/Crypt/TripleDES.php');
require_once('remote/Crypt/Hash.php');
require_once('remote/Net/SSH2.php');


defined('MOODLE_INTERNAL') || die;
$config = get_config('local_leads');

if (is_siteadmin()) {
    $settings = new admin_settingpage('local_leads', get_string('pluginname', 'local_leads'));
    $ADMIN->add('localplugins', $settings);

    $name = 'local_leads/numrecordings';
    $setting = new admin_setting_configtext_with_maxlength($name, 'Orbit AppID', 'orbit app id', 5, PARAM_INT, 2, 2);
    $settings->add($setting);

}