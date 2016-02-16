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
 * Deletes expired Oauth tokens
 *
 * @package    local_oauth
 * @copyright  2016 Pau Ferrer <pferre22@xtec.cat>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_oauth\task;

/**
 * Deletes expired Oauth tokens
 */
class clean extends \core\task\scheduled_task {

    /**
     * Get a descriptive name for this task.
     *
     * @return string
     */
    public function get_name() {
        return get_string('pluginname', 'local_oauth');
    }

    /**
     * Performs the task
     */
    public function execute() {
        global $DB;

        mtrace("Deleting expired tokens...", "\n");
        $time = time();
        $DB->delete_records_select('oauth_access_tokens', 'expires < :time', array('time' => $time));
        $DB->delete_records_select('oauth_authorization_codes', 'expires < :time', array('time' => $time));
        $DB->delete_records_select('oauth_refresh_tokens', 'expires < :time', array('time' => $time));
    }
}
