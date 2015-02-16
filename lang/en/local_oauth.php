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

$string['client_id_help'] = 'ID de la aplicación para utilizar en el formulario del cliente (Nodes o XTECBlocs) para referenciar el proveedor. Debe ser único. Por ejemplo, un ID de la aplicación válido puede ser "nodes" o "bloc1".';
$string['redirect_uri_help'] = 'URI donde redirigir después de la autenticación. Por ejemplo, para XTECBlocs o Nodes, la URL de redirección debe ser parecida a: <ul><li>XTECBlocs: <i>http://blocs.xtec.cat/nomdelbloc/wp-content/plugins/wordpress-social-login/hybridauth/?hauth.done=Moodle</i></li><li>NODES: <i>http://agora.xtec.cat/nomdelcentre/wp-content/plugins/wordpress-social-login/hybridauth/?hauth.done=Moodle</i></li></ul>';
