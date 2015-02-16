<?php

$string['pluginname'] = 'OAuth provider';
$string['settings'] = 'OAuth provider settings';
$string['addclient'] = 'Add new client';

$string['client_id'] = 'Client identifier';
$string['client_secret'] = 'Client secret Key';
$string['redirect_uri'] = 'Redirect URL';
$string['grant_types'] = 'Grant Types';
$string['scope'] = 'Scope';
$string['user_id'] = 'User ID';

$string['auth_question'] = 'Do you want to authorize <strong>{$a}</strong>?';
$string['auth_question_desc'] = 'This application is asking to have access this information over your account:';
$string['auth_question_login'] = 'This application is to access your login information';


$string['oauth:manageclients'] = 'Manage OAuth provider Clients';

$string['client_not_exists'] = 'Client does not exist';
$string['saveok'] = 'Client successfully saved';
$string['confirmdeletestr'] = 'Are you sure you want to delete client {$a}?';
$string['delok'] = 'Client successfully deleted';
$string['insert_error'] = 'Error occurred creating client';
$string['update_error'] = 'Error occurred updating client data';
$string['delete_error'] = 'Error occurred deleting client';

$string['scope_user_info'] = 'User Profile Information';

$string['event_user_not_granted'] = 'User not granted';
$string['event_user_granted'] = 'User granted';
$string['event_user_info_request'] = 'User info requested';
$string['event_user_info_request_failed'] = 'User info request failed';

$string['client_id_help'] = 'Identifier to be used from the client form in order to reference this provider. It has to be unique. For instance, a valid identifier could be "nodes" or "bloc1".';
$string['redirect_uri_help'] = 'URI where to redirect after login. For instance, for WordPress installation which have the WP Social Login plugin, the redirect URI is like <i>http://wordpress_server/wp-content/plugins/wordpress-social-login/hybridauth/?hauth.done=Moodle</i><ul><li>URL1</li><li>URL2</li></ul>';