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

use advanced_testcase;
use core\context\system;
use core_privacy\local\metadata\collection;
use core_privacy\local\request\approved_contextlist;
use core_privacy\local\request\writer;

/**
 * Tests for the local OAuth privacy provider.
 *
 * @package    local_oauth
 * @copyright  2026 Catalyst IT Australia
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author     Matthew Hilton <matthewhilton@catalyst-au.net>
 * @covers \local_oauth\privacy\provider
 */
final class provider_test extends advanced_testcase {
    /**
     * Set up the test environment.
     */
    protected function setUp(): void {
        parent::setUp();
        $this->resetAfterTest(true);
    }

    /**
     * Test metadata declaration.
     */
    public function test_get_metadata(): void {
        $collection = provider::get_metadata(new collection('local_oauth'));

        $this->assertCount(5, $collection->get_collection());
    }

    /**
     * Test that only users with OAuth data have a system context.
     */
    public function test_get_contexts_for_userid(): void {
        $userwithdata = $this->getDataGenerator()->create_user();
        $userwithoutdata = $this->getDataGenerator()->create_user();
        $this->create_oauth_data($userwithdata->id);

        $contexts = provider::get_contexts_for_userid($userwithdata->id)->get_contexts();
        $this->assertEquals([system::instance()], $contexts);
        $this->assertEmpty(provider::get_contexts_for_userid($userwithoutdata->id)->get_contexts());
    }

    /**
     * Test OAuth data export.
     */
    public function test_export_user_data(): void {
        $user = $this->getDataGenerator()->create_user();
        $this->create_oauth_data($user->id);
        $context = system::instance();

        provider::export_user_data(new approved_contextlist($user, 'local_oauth', [$context->id]));
        $writer = writer::with_context($context);
        $clients = $writer->get_data(['oauth_clients']);
        $this->assertCount(1, $clients->records);
        $this->assertEquals($user->id, $clients->records[0]->user_id);
        $this->assertCount(1, $writer->get_data(['oauth_access_tokens'])->records);
        $this->assertCount(1, $writer->get_data(['oauth_authorization_codes'])->records);
        $this->assertCount(1, $writer->get_data(['oauth_refresh_tokens'])->records);
        $this->assertCount(1, $writer->get_data(['oauth_user_auth_scopes'])->records);
    }

    /**
     * Test deletion only removes data for the approved user.
     */
    public function test_delete_data_for_user(): void {
        global $DB;

        $user = $this->getDataGenerator()->create_user();
        $otheruser = $this->getDataGenerator()->create_user();
        $this->create_oauth_data($user->id);
        $this->create_oauth_data($otheruser->id);
        $context = system::instance();

        provider::delete_data_for_user(new approved_contextlist($user, 'local_oauth', [$context->id]));

        foreach ([
            'oauth_clients',
            'oauth_access_tokens',
            'oauth_authorization_codes',
            'oauth_refresh_tokens',
            'oauth_user_auth_scopes',
        ] as $table) {
            $this->assertFalse($DB->record_exists($table, ['user_id' => $user->id]));
            $this->assertTrue($DB->record_exists($table, ['user_id' => $otheruser->id]));
        }
    }

    /**
     * Create records in each user-linked OAuth table.
     *
     * @param int $userid The user ID.
     * @return void
     */
    private function create_oauth_data(int $userid): void {
        global $DB;

        $suffix = (string) $userid;
        $DB->insert_record('oauth_clients', (object) [
            'client_id' => 'client' . $suffix,
            'client_secret' => 'secret' . $suffix,
            'user_id' => $userid,
        ]);
        $DB->insert_record('oauth_access_tokens', (object) [
            'access_token' => 'access' . $suffix,
            'client_id' => 'client' . $suffix,
            'user_id' => $userid,
            'expires' => time() + HOURSECS,
        ]);
        $DB->insert_record('oauth_authorization_codes', (object) [
            'authorization_code' => 'code' . $suffix,
            'client_id' => 'client' . $suffix,
            'user_id' => $userid,
            'expires' => time() + HOURSECS,
        ]);
        $DB->insert_record('oauth_refresh_tokens', (object) [
            'refresh_token' => 'refresh' . $suffix,
            'client_id' => 'client' . $suffix,
            'user_id' => $userid,
            'expires' => time() + HOURSECS,
        ]);
        $DB->insert_record('oauth_user_auth_scopes', (object) [
            'client_id' => 'client' . $suffix,
            'user_id' => $userid,
            'scope' => 'user_info',
        ]);
    }
}
