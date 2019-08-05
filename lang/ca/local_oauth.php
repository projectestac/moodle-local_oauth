<?php

$string['pluginname'] = 'Proveïdor OAuth';
$string['settings'] = 'Configuració del proveïdor OAuth';
$string['addclient'] = 'Afegeix client nou';
$string['addotherclient'] = 'Afegeix altres clients';
$string['addnodesclient'] = 'Afegeix client Àgora-Nodes';
$string['addwordpressclient'] = 'Afegeix client XTECBlocs';

$string['client_id'] = 'Identificador de client';
$string['client_secret'] = 'Clau secreta de client';
$string['redirect_uri'] = 'URL de redirecció';
$string['grant_types'] = 'Tipus de concessió';
$string['scope'] = 'Abast';
$string['user_id'] = 'ID d\'usuari';
$string['wp_url'] = 'URL del blog';

$string['auth_question'] = 'Voleu autorizar l\'accés a <strong>{$a}</strong>?';
$string['auth_question_desc'] = 'L\'aplicació està demanant accés a la informació següent del seu compte:';
$string['auth_question_login'] = 'L\'aplicació vol tenir accés a la informació de login';


$string['oauth:manageclients'] = 'Gestiona els clients del proveïdor OAuth';

$string['client_not_exists'] = 'El client no existeix';
$string['saveok'] = 'El client s\'ha desat correctament';
$string['confirmdeletestr'] = 'Segur que voleu eliminar el client {$a}?';
$string['delok'] = 'El client s\'ha eliminat correctament';
$string['client_id_existing_error'] = 'L\'identificador de client especificat ja existeix, cal seleccionar-ne un altre';
$string['insert_error'] = 'Error creant el client';
$string['update_error'] = 'Error actualitzant la informació del client';
$string['delete_error'] = 'Error eliminant el client';

$string['scope_user_info'] = 'Informació del perfil d\'usuari/ària';

$string['event_user_not_granted'] = 'Usuari/ària no autoritzat';
$string['event_user_granted'] = 'Usuari/ària autoritzat';
$string['event_user_info_request'] = 'Petició de dades d\'usuari/ària';
$string['event_user_info_request_failed'] = 'Error en la petició de dades d\'usuari/ària';

$string['client_id_help'] = 'ID de l\'aplicació per fer servir al formulari del client (XTECBlocs o Nodes) per tal de referenciar el proveïdor. Ha de ser únic. Per exemple, un ID de l\'aplicació vàlid pot ser "blog1" o "nodes".';
$string['redirect_uri_help'] = 'URI a on redirigir després d\'autenticar-se. Per exemple, per a XTECBlocs o Nodes, l\'URL de redirecció ha de ser semblant a: <ul><li>XTECBlocs: <i>https://blocs.xtec.cat/nomdelbloc/wp-content/plugins/wordpress-social-login/hybridauth/callbacks/moodle.php</i></li><li>NODES: <i>https://agora.xtec.cat/nomdelcentre/wp-content/plugins/wordpress-social-login/hybridauth/callbacks/moodle.php</i></li></ul>';
