<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

namespace local_oauth\privacy;

use core_privacy\local\metadata\collection;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\approved_userlist;
use core_privacy\local\request\contextlist;
use core_privacy\local\request\userlist;
use core_privacy\local\request\writer;

/**
 * Privacy provider for the local OAuth plugin.
 *
 * @package    local_oauth
 * @copyright  2026 Catalyst IT Australia
 * @author     Matthew Hilton <matthewhilton@catalyst-au.net>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class provider implements
	\core_privacy\local\metadata\provider,
	\core_privacy\local\request\core_userlist_provider,
	\core_privacy\local\request\plugin\provider {

	/** @var string[] Database tables containing user-linked OAuth data. */
	private const USER_DATA_TABLES = [
		'oauth_clients',
		'oauth_access_tokens',
		'oauth_authorization_codes',
		'oauth_refresh_tokens',
		'oauth_user_auth_scopes',
	];

	/**
	 * Return metadata about the data stored by the plugin.
	 *
	 * @param collection $collection The metadata collection to populate.
	 * @return collection
	 */
	public static function get_metadata(collection $collection): collection {
		$collection->add_database_table('oauth_clients', [
			'client_id' => 'privacy:metadata:oauth_clients:clientid',
			'redirect_uri' => 'privacy:metadata:oauth_clients:redirecturi',
			'grant_types' => 'privacy:metadata:oauth_clients:granttypes',
			'scope' => 'privacy:metadata:oauth_clients:scope',
			'user_id' => 'privacy:metadata:oauth_clients:userid',
		], 'privacy:metadata:oauth_clients');
		$collection->add_database_table('oauth_access_tokens', [
			'client_id' => 'privacy:metadata:oauth_access_tokens:clientid',
			'user_id' => 'privacy:metadata:oauth_access_tokens:userid',
			'expires' => 'privacy:metadata:oauth_access_tokens:expires',
			'scope' => 'privacy:metadata:oauth_access_tokens:scope',
		], 'privacy:metadata:oauth_access_tokens');
		$collection->add_database_table('oauth_authorization_codes', [
			'client_id' => 'privacy:metadata:oauth_authorization_codes:clientid',
			'user_id' => 'privacy:metadata:oauth_authorization_codes:userid',
			'redirect_uri' => 'privacy:metadata:oauth_authorization_codes:redirecturi',
			'expires' => 'privacy:metadata:oauth_authorization_codes:expires',
			'scope' => 'privacy:metadata:oauth_authorization_codes:scope',
		], 'privacy:metadata:oauth_authorization_codes');
		$collection->add_database_table('oauth_refresh_tokens', [
			'client_id' => 'privacy:metadata:oauth_refresh_tokens:clientid',
			'user_id' => 'privacy:metadata:oauth_refresh_tokens:userid',
			'expires' => 'privacy:metadata:oauth_refresh_tokens:expires',
			'scope' => 'privacy:metadata:oauth_refresh_tokens:scope',
		], 'privacy:metadata:oauth_refresh_tokens');
		$collection->add_database_table('oauth_user_auth_scopes', [
			'client_id' => 'privacy:metadata:oauth_user_auth_scopes:clientid',
			'user_id' => 'privacy:metadata:oauth_user_auth_scopes:userid',
			'scope' => 'privacy:metadata:oauth_user_auth_scopes:scope',
		], 'privacy:metadata:oauth_user_auth_scopes');

		return $collection;
	}

	/**
	 * Get the contexts containing data for a user.
	 *
	 * @param int $userid The user ID.
	 * @return contextlist
	 */
	public static function get_contexts_for_userid(int $userid): contextlist {
		global $DB;

		$contextlist = new contextlist();
		foreach (self::USER_DATA_TABLES as $table) {
			if ($DB->record_exists($table, ['user_id' => $userid])) {
				$contextlist->add_system_context();
				break;
			}
		}

		return $contextlist;
	}

	/**
	 * Export user data for the approved contexts.
	 *
	 * @param approved_contextlist $contextlist The approved context list.
	 * @return void
	 */
	public static function export_user_data(approved_contextlist $contextlist) {
		global $DB;

		foreach ($contextlist->get_contexts() as $context) {
			if ($context->contextlevel !== CONTEXT_SYSTEM) {
				continue;
			}

			$userid = $contextlist->get_user()->id;
			$writer = writer::with_context($context);
			foreach (self::USER_DATA_TABLES as $table) {
				$records = $DB->get_records($table, ['user_id' => $userid]);
				if (!empty($records)) {
					$writer->export_data([$table], (object) ['records' => array_values($records)]);
				}
			}
		}
	}

	/**
	 * Delete data for all users in a context.
	 *
	 * @param \context $context The context to delete from.
	 * @return void
	 */
	public static function delete_data_for_all_users_in_context(\context $context) {
		global $DB;

		if ($context->contextlevel !== CONTEXT_SYSTEM) {
			return;
		}

		foreach (self::USER_DATA_TABLES as $table) {
			$DB->delete_records($table);
		}
	}

	/**
	 * Delete user data for the approved contexts.
	 *
	 * @param approved_contextlist $contextlist The approved context list.
	 * @return void
	 */
	public static function delete_data_for_user(approved_contextlist $contextlist) {
		foreach ($contextlist->get_contexts() as $context) {
			if ($context->contextlevel === CONTEXT_SYSTEM) {
				self::delete_data_for_userid($contextlist->get_user()->id);
				return;
			}
		}
	}

	/**
	 * Delete all user data for a user.
	 *
	 * @param int $userid The user ID.
	 * @return void
	 */
	private static function delete_data_for_userid(int $userid) {
		global $DB;

		foreach (self::USER_DATA_TABLES as $table) {
			$DB->delete_records($table, ['user_id' => $userid]);
		}
	}

	/**
	 * Add users with data in the specified context to the user list.
	 *
	 * @param userlist $userlist The user list to populate.
	 * @return void
	 */
	public static function get_users_in_context(userlist $userlist) {
		if ($userlist->get_context()->contextlevel !== CONTEXT_SYSTEM) {
			return;
		}

		$sql = implode(' UNION ', array_map(
			static fn(string $table): string => "SELECT user_id FROM {{$table}} WHERE user_id IS NOT NULL",
			self::USER_DATA_TABLES
		));
		$userlist->add_from_sql('user_id', $sql, []);
	}

	/**
	 * Delete data for the specified users in a context.
	 *
	 * @param approved_userlist $userlist The approved user list.
	 * @return void
	 */
	public static function delete_data_for_users(approved_userlist $userlist) {
		if ($userlist->get_context()->contextlevel !== CONTEXT_SYSTEM || empty($userlist->get_userids())) {
			return;
		}

		foreach ($userlist->get_userids() as $userid) {
			self::delete_data_for_userid($userid);
		}
	}
}
