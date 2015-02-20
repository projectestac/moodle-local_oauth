<?php

function oauth_add_wordpress_client($client_id, $url) {
    global $DB;

    $url = trim($url);
    if (substr($url, -1) != '/') {
        $url .= '/';
    }
    $record = new stdClass();
    $record->redirect_uri = oauth_no_ssl_url($url.'wp-content/plugins/wordpress-social-login/hybridauth/?hauth.done=Moodle');
    $record->grant_types = 'authorization_code';
    $record->scope = 'user_info ';
    $record->user_id = '';

    //do save
    $record->client_id = $client_id;
    $record->client_secret = generate_secret();
    return $DB->insert_record('oauth_clients', $record);
}

function oauth_no_ssl_url($url) {
    return preg_replace("/^https:/i", "http:", $url);
}

function generate_secret() {
    // Get a whole bunch of random characters from the OS
    $fp = fopen('/dev/urandom', 'rb');
    $entropy = fread($fp, 32);
    fclose($fp);

    // Takes our binary entropy, and concatenates a string which represents the current time to the microsecond
    $entropy .= uniqid(mt_rand(), true);

    // Hash the binary entropy
    $hash = hash('sha512', $entropy);

    // Chop and send the first 80 characters back to the client
    return substr($hash, 0, 48);
}