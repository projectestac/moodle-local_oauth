<?php

$string['pluginname'] = 'Proveedor de OAuth';
$string['settings'] = 'Configuración del proveedor de OAuth';
$string['addclient'] = 'Añadir nuevo cliente';
$string['addotherclient'] = 'Añadir otros clientes';
$string['addnodesclient'] = 'Añadir cliente Àgora-Nodes';
$string['addwordpressclient'] = 'Añadir cliente XTECBlocs';

$string['client_id'] = 'Identificador de cliente';
$string['client_secret'] = 'Clave secreta de cliente';
$string['redirect_uri'] = 'URL de redirección';
$string['grant_types'] = 'Tipos de concesión';
$string['scope'] = 'Ámbito';
$string['user_id'] = 'ID de usuario';
$string['wp_url'] = 'URL del blog';

$string['auth_question'] = '¿Quiere autorizar el acceso a <strong>{$a}</strong>?';
$string['auth_question_desc'] = 'La aplicación está pidiendo acceso a la siguiente información de su cuenta:';
$string['auth_question_login'] = 'Esta aplicación quiere acceder a su información de login';


$string['oauth:manageclients'] = 'Gestionar los clientes del proveedor de OAuth';

$string['client_not_exists'] = 'El cliente no existe';
$string['saveok'] = 'El cliente se ha guardado correctamente';
$string['confirmdeletestr'] = 'Está seguro que quiere eleminar el cliente {$a}?';
$string['delok'] = 'El cliente se ha eliminado correctamente';
$string['client_id_existing_error'] = 'El identificador de cliente especificado ya existe, seleccione otro';
$string['insert_error'] = 'Se ha producido un error creando el cliente';
$string['update_error'] = 'Se ha producido un error actualizando la información del cliente';
$string['delete_error'] = 'Se ha producido un error eliminando el cliente';

$string['scope_user_info'] = 'Información del perfil de usuario';

$string['event_user_not_granted'] = 'Usuario no autorizado';
$string['event_user_granted'] = 'Usuario autorizado';
$string['event_user_info_request'] = 'Petición de datos de usuario';
$string['event_user_info_request_failed'] = 'Error en la petición de datos de usuario';

$string['client_id_help'] = 'ID de la aplicación para utilizar en el formulario del cliente (XTECBlocs o Nodes) para referenciar el proveedor. Debe ser único. Por ejemplo, un ID de la aplicación válido puede ser "blog1" o "nodes".';
$string['redirect_uri_help'] = 'URI donde redirigir después de la autenticación. Por ejemplo, para XTECBlocs o Nodes, la URL de redirección debe ser parecida a: <ul><li>XTECBlocs: <i>https://blocs.xtec.cat/nomdelbloc/wp-content/plugins/wordpress-social-login/hybridauth/callbacks/moodle.php</i></li><li>NODES: <i>https://agora.xtec.cat/nomdelcentre/wp-content/plugins/wordpress-social-login/hybridauth/callbacks/moodle.php</i></li></ul>';
