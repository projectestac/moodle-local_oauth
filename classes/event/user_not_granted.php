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
 * local_oauth user not granted event.
 *
 * @package    local_oauth
 * @copyright  2014 Pau Ferrer Ocaña
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_oauth\event;
defined('MOODLE_INTERNAL') || die();

class user_not_granted extends user_granted {

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        $clientid = $this->data['other']['clientid'];
        $scope = $this->data['other']['scope'];
        return "The user has not been granted to access for $clientid to $scope.";
    }

    /**
     * Return legacy data for add_to_log().
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        return array(SITEID, 'local_oauth', 'user_not_granted', '', $this->get_description(), 0, $this->data['objectid']);
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('event_user_not_granted', 'local_oauth');
    }
}
