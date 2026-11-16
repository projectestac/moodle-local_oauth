<?php

function oauth_get_server() {
    global $CFG;

    // Autoloading (composer is preferred, but for this example let's just do this)
    require_once $CFG->dirroot . '/local/oauth/OAuth2/Autoloader.php';
    OAuth2\Autoloader::register();

    $storage = new OAuth2\Storage\Moodle(array());

    // Pass a storage object or array of storage objects to the OAuth2 server class
    $server = new OAuth2\Server($storage);
    $server->setConfig('enforce_state', false);

    // Issue refresh tokens only to the clients that have the "refresh_token" grant type.
    // When a response type is added, the server no longer creates the default ones, so "code" must be added too.
    $server->addResponseType(new \local_oauth\access_token($storage, $storage, $storage), 'token');
    $server->addResponseType(new OAuth2\ResponseType\AuthorizationCode($storage), 'code');

    // Add the "Client Credentials" grant type (it is the simplest of the grant types)
    $server->addGrantType(new OAuth2\GrantType\ClientCredentials($storage));

    // Add the "Authorization Code" grant type (this is where the oauth magic happens)
    $server->addGrantType(new OAuth2\GrantType\AuthorizationCode($storage));

    // Add the "Refresh Token" grant type. Refresh tokens are rotated: each use returns a new one and invalidates
    // the one used.
    $server->addGrantType(new OAuth2\GrantType\RefreshToken($storage, [
        'always_issue_new_refresh_token' => true,
        'unset_refresh_token_after_use' => true,
    ]));

    return $server;
}

function get_authorization_from_form($url, $clientid, $scope = false) {
 
    global $CFG, $OUTPUT, $USER;
 
    require_once "{$CFG->libdir}/formslib.php";
    require_once 'forms.php';

    if (is_scope_authorized_by_user($USER->id, $clientid, $scope)) {
        return true;
    }

    $mform = new local_oauth_authorize_form($url);
    if ($mform->is_cancelled()) {
        return false;
    }

    if ($fromform = $mform->get_data() and confirm_sesskey()) {
        authorize_user_scope($USER->id, $clientid, $scope);
        return true;
    }

    echo $OUTPUT->header();
    $mform->display();
    echo $OUTPUT->footer();

    die();

}


function is_scope_authorized_by_user($userid, $clientid, $scope = false) {
    global $DB;
    if (!$scope) {
        $scope = 'login';
    }
    return $DB->record_exists('oauth_user_auth_scopes', array('client_id' => $clientid, 'scope' => $scope, 'user_id' => $userid));
}

function authorize_user_scope($userid, $clientid, $scope = false) {
    global $DB;
    if (!$scope) {
        $scope = 'login';
    }
    $record = new StdClass();
    $record->client_id = $clientid;
    $record->user_id = $userid;
    $record->scope = $scope;

    $DB->insert_record('oauth_user_auth_scopes', $record);
}