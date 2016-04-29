<?php

return [

    'environment'  => 'local',
    'cache'        => 'array',
    'session.name' => 's_id',

    'scope'  => 'Web',
    'scopes' => [
        'Web'   => false
    ],

    'local' => [
        'host'        => 'buuum.dev',
        'public'      => 'httpdocs',
        'development' => true,
        'bbdd'        => [
            'database' => 'database_name',
            'host'     => '127.0.0.1',
            'username' => 'username',
            'password' => 'password'
        ],
        'ftp'         => [

        ]
    ]

];