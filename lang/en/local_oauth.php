<?php

$string['pluginname'] = 'OAuth provider';
$string['settings'] = 'OAuth provider settings';
$string['addclient'] = 'Add new client';
$string['addotherclient'] = 'Add other client';
$string['addnodesclient'] = 'Add Àgora-Nodes client';
$string['addwordpressclient'] = 'Add XTECBlocs client';

$string['client_id'] = 'Client identifier';
$string['client_secret'] = 'Client secret Key';
$string['redirect_uri'] = 'Redirect URL';
$string['grant_types'] = 'Grant Types';
$string['scope'] = 'Scope';
$string['user_id'] = 'User ID';
$string['wp_url'] = 'Blog URL';

$string['auth_question'] = 'Do you want to authorize <strong>{$a}</strong>?';
$string['auth_question_desc'] = 'This application is asking to have access this information over your account:';
$string['auth_question_login'] = 'This application is to access your login information';


$string['oauth:manageclients'] = 'Manage OAuth provider Clients';

$string['client_not_exists'] = 'Client does not exist';
$string['saveok'] = 'Client successfully saved';
$string['confirmdeletestr'] = 'Are you sure you want to delete client {$a}?';
$string['delok'] = 'Client successfully deleted';
$string['client_id_existing_error'] = 'The Client identifier specified already exists, please choose another one';
$string['insert_error'] = 'Error occurred creating client';
$string['update_error'] = 'Error occurred updating client data';
$string['delete_error'] = 'Error occurred deleting client';

$string['scope_user_info'] = 'User Profile Information';

$string['privacy:metadata:oauth_clients'] = 'OAuth client registrations associated with a user.';
$string['privacy:metadata:oauth_clients:clientid'] = 'The OAuth client identifier.';
$string['privacy:metadata:oauth_clients:redirecturi'] = 'The URL to which the OAuth client redirects users.';
$string['privacy:metadata:oauth_clients:granttypes'] = 'The OAuth grant types available to the client.';
$string['privacy:metadata:oauth_clients:scope'] = 'The OAuth scopes available to the client.';
$string['privacy:metadata:oauth_clients:userid'] = 'The user associated with the OAuth client.';
$string['privacy:metadata:oauth_access_tokens'] = 'OAuth access tokens issued to a user.';
$string['privacy:metadata:oauth_access_tokens:clientid'] = 'The OAuth client that received the access token.';
$string['privacy:metadata:oauth_access_tokens:userid'] = 'The user to whom the access token was issued.';
$string['privacy:metadata:oauth_access_tokens:expires'] = 'The time when the access token expires.';
$string['privacy:metadata:oauth_access_tokens:scope'] = 'The OAuth scopes granted to the access token.';
$string['privacy:metadata:oauth_authorization_codes'] = 'OAuth authorization codes issued to a user.';
$string['privacy:metadata:oauth_authorization_codes:clientid'] = 'The OAuth client that received the authorization code.';
$string['privacy:metadata:oauth_authorization_codes:userid'] = 'The user to whom the authorization code was issued.';
$string['privacy:metadata:oauth_authorization_codes:redirecturi'] = 'The URL to which the OAuth client redirects after authorization.';
$string['privacy:metadata:oauth_authorization_codes:expires'] = 'The time when the authorization code expires.';
$string['privacy:metadata:oauth_authorization_codes:scope'] = 'The OAuth scopes granted by the authorization code.';
$string['privacy:metadata:oauth_refresh_tokens'] = 'OAuth refresh tokens issued to a user.';
$string['privacy:metadata:oauth_refresh_tokens:clientid'] = 'The OAuth client that received the refresh token.';
$string['privacy:metadata:oauth_refresh_tokens:userid'] = 'The user to whom the refresh token was issued.';
$string['privacy:metadata:oauth_refresh_tokens:expires'] = 'The time when the refresh token expires.';
$string['privacy:metadata:oauth_refresh_tokens:scope'] = 'The OAuth scopes granted to the refresh token.';
$string['privacy:metadata:oauth_user_auth_scopes'] = 'OAuth scopes a user has authorised for a client.';
$string['privacy:metadata:oauth_user_auth_scopes:clientid'] = 'The OAuth client authorised by the user.';
$string['privacy:metadata:oauth_user_auth_scopes:userid'] = 'The user who authorised the OAuth scope.';
$string['privacy:metadata:oauth_user_auth_scopes:scope'] = 'The OAuth scope authorised by the user.';

$string['event_user_not_granted'] = 'User not granted';
$string['event_user_granted'] = 'User granted';
$string['event_user_info_request'] = 'User info requested';
$string['event_user_info_request_failed'] = 'User info request failed';

$string['client_id_help'] = 'Identifier to be used from the client form in order to reference this provider. It has to be unique. For instance, a valid identifier could be "blog1" or "nodes".';
$string['redirect_uri_help'] = 'URI where to redirect after login. For instance, for XTECBlocs or Nodes, the redirect URI are like: <ul><li>XTECBlocs: <i>https://blocs.xtec.cat/nomdelbloc/wp-content/plugins/wordpress-social-login/hybridauth/callbacks/moodle.php</i></li><li>NODES: <i>https://agora.xtec.cat/nomdelcentre/wp-content/plugins/wordpress-social-login/hybridauth/callbacks/moodle.php</i></li></ul>';
