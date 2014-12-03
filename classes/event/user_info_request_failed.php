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
 * local_oauth user granted event.
 *
 * @package    local_oauth
 * @copyright  2014 Pau Ferrer Ocaña
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_oauth\event;
defined('MOODLE_INTERNAL') || die();

class user_info_request_failed extends user_info_request {

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        $cause = $this->data['other']['cause'];
        return "Error $cause ocurred when user info has been requested.";
    }

    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('event_user_info_request_failed', 'local_oauth');
    }

    /**
     * Custom validation.
     *
     * @return void
     */
    protected function validate_data() {
        if (!isset($this->data['other']['cause'])) {
            throw new \coding_exception('The property cause must be set.');
        }
    }

    /**
     * Return legacy data for add_to_log().
     *
     * @return array
     */
    protected function get_legacy_logdata() {
        $userid = isset($this->userid) ? $this->userid : null;
        return array(SITEID, 'local_oauth', 'user_info_request_failed', '', $this->get_description(), 0, $userid);
    }

}
