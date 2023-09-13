<?php

if ($hassiteconfig) {
    $ADMIN->add('server', new admin_externalpage(
        'local_oauth_settings',
        get_string('settings', 'local_oauth'),
        $CFG->wwwroot . '/local/oauth/index.php',
        ['local/oauth:manageclients']
    ));
}
