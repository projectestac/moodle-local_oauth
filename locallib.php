<?php

function oauth_add_wordpress_client($client_id, $url) {
    global $DB;

    $url = trim($url);
    if (substr($url, -1) != '/') {
        $url .= '/';
    }
    $record = new stdClass();
    $record->redirect_uri = $url.'wp-content/plugins/wordpress-social-login/hybridauth/?hauth.done=Moodle';
    $record->grant_types = 'authorization_code';
    $record->scope = 'user_info ';
    $record->user_id = '';

    //do save
    $record->client_id = $client_id;
    $record->client_secret = generate_secret();
    return $DB->insert_record('oauth_clients', $record);
}