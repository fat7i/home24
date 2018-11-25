<?php

date_default_timezone_set('Europe/Berlin');

$_ENV =
    [
        'env'           => 'local', /* local | production | testing */
        'debug'         => false,
        'time_zone'     => 'Europe/Berlin', /* See list of Supported Timezones  http://php.net/manual/en/timezones.php */


        'db' => [
            'server'        =>  'localhost',
            'dbname'        =>  '...',
            'dbuser'        =>  '...',
            'dbpassword'    =>  '...',
        ],

        'rate_limit' => [
            'limit'         => 450,        // Requests count
            'time'          => 15 * 60,    // Period time (15 minutes)
        ]
    ];
