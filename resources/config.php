<?php

date_default_timezone_set('Europe/Berlin');
//error_reporting(E_ALL);
//ini_set('display_errors', 1);


$_ENV =
    [
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
