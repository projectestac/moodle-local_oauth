<?php

$string['pluginname'] = 'OAuth认证';
$string['settings'] = 'OAuth认证设置';
$string['addclient'] = '添加认证客户端';
$string['addotherclient'] = '添加另一个认证客户端';
$string['addnodesclient'] = '添加Àgora-Nodes客户端';
$string['addwordpressclient'] = '添加XTECBlocs客户端';

$string['client_id'] = '客户端ID';
$string['client_secret'] = '客户端密钥';
$string['redirect_uri'] = '重定向地址';
$string['grant_types'] = '授权模式';
$string['scope'] = '授权范围';
$string['user_id'] = '用户ID';
$string['wp_url'] = '博客地址';

$string['auth_question'] = '您希望授权 <strong>{$a}</strong> 吗?';
$string['auth_question_desc'] = '应用希望获得关于您账户的以下信息：:';
$string['auth_question_login'] = '该应用已被授权访问您的登陆信息';


$string['oauth:manageclients'] = '管理授权(OAuth)提供客户端';

$string['client_not_exists'] = '客户端不存在';
$string['saveok'] = '客户端保存成功';
$string['confirmdeletestr'] = '您确定要删除客户端 {$a} 吗?';
$string['delok'] = '客户端删除成功';
$string['client_id_existing_error'] = '具有相同ID的客户端已经存在, 请选择另一个';
$string['insert_error'] = '创建客户端时出错';
$string['update_error'] = '更新客户端数据时出错';
$string['delete_error'] = '删除客户端时出错';

$string['scope_user_info'] = '用户账户信息';

$string['event_user_not_granted'] = '用户不允许';
$string['event_user_granted'] = '用户允许';
$string['event_user_info_request'] = '已请求用户信息';
$string['event_user_info_request_failed'] = '用户信息请求失败';

$string['client_id_help'] = '客户端ID被用来指示提供者，它必须是独有的. 例如, 一个合法的ID可以是 "blog1" 或 "nodes".';
$string['redirect_uri_help'] = '用户登录后，将被重定向到的地址. 例如, 对于 XTECBlocs 或 Nodes, 重定向地址形似: <ul><li>XTECBlocs: <i>https://blocs.xtec.cat/nomdelbloc/wp-content/plugins/wordpress-social-login/hybridauth/callbacks/moodle.php</i></li><li>NODES: <i>https://agora.xtec.cat/nomdelcentre/wp-content/plugins/wordpress-social-login/hybridauth/callbacks/moodle.php</i></li></ul>';
