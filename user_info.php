<?php

require_once '../../config.php';
require_once __DIR__.'/lib.php';

\core\session\manager::write_close();

$server = oauth_get_server();
$request = OAuth2\Request::createFromGlobals();
$response = new OAuth2\Response();

if (!$server->verifyResourceRequest($request, $response)) {
    $logparams = array('other' => array('cause' => 'invalid_approval'));
    $event = \local_oauth\event\user_info_request_failed::create($logparams);
    $event->trigger();

    $response->send();
    die();
}

$token = $server->getAccessTokenData($request);
if (empty($token['user_id'])) {
    // Tokens obtained without a user (i.e. client_credentials) cannot request user info.
    $logparams = array('other' => array('cause' => 'invalid_token'));
    $event = \local_oauth\event\user_info_request_failed::create($logparams);
    $event->trigger();

    $response->setError(401, 'invalid_token', 'The access token is not associated with a user');
    $response->send();
    die();
}

// The required scope is the one configured for the client. Tokens of deleted clients are rejected.
$clientscope = $DB->get_field('oauth_clients', 'scope', array('client_id' => $token['client_id']));
if ($clientscope === false) {
    $logparams = array('relateduserid' => $token['user_id'], 'other' => array('cause' => 'client_not_found'));
    $event = \local_oauth\event\user_info_request_failed::create($logparams);
    $event->trigger();

    $response->setError(401, 'invalid_token', 'The client associated with the access token does not exist');
    $response->send();
    die();
}
$clientscopes = preg_split('/\s+/', trim($clientscope), -1, PREG_SPLIT_NO_EMPTY);
if (empty($clientscopes)) {
    $clientscopes = array('user_info');
}

// It is enough for the token to have any of the client scopes. If it has none of them, all of them are required
// so that the error reports the scopes that are accepted.
$scoperequired = implode(' ', $clientscopes);
foreach ($clientscopes as $clientscope) {
    if ($server->getScopeUtil()->checkScope($clientscope, $token['scope'] ?? '')) {
        $scoperequired = $clientscope;
        break;
    }
}

// If the token has none of the client scopes, this will send a "403 insufficient_scope" error
if (!$server->verifyResourceRequest($request, $response, $scoperequired)) {
    $logparams = array('relateduserid' => $token['user_id'], 'other' => array('cause' => 'insufficient_scope'));
    $event = \local_oauth\event\user_info_request_failed::create($logparams);
    $event->trigger();

    $response->send();
    die();
}

$user = $DB->get_record('user', array('id' => $token['user_id'], 'deleted' => 0), 'id,auth,username,idnumber,firstname,lastname,email,lang,country,phone1,address,description');
if (!$user) {
    $logparams = array('other' => array('cause' => 'user_not_found'));
    $event = \local_oauth\event\user_info_request_failed::create($logparams);
    $event->trigger();

    $response->setError(404, 'user_not_found', 'The user associated with the access token does not exist');
    $response->send();
    die();
}

$logparams = array('userid' => $user->id);
$event = \local_oauth\event\user_info_request::create($logparams);
$event->trigger();

$response->setParameters((array)$user);
$response->send();
