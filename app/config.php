<?php

return [

    'environment'  => 'local',
    'cache'        => 'array',
    'session.name' => 's_id',

    'encode' => [
        'key'       => '!32!32!',
        'algorithm' => 'GOST'
    ],

    'mail' => [
        'smtpsecure' => 'tls',
        'host'       => "",
        'username'   => "",
        'password'   => "",
        'from'       => ['@.com', ''],
        'response'   => ['@.com', '']
    ],

    'scope'  => 'Web',
    'scopes' => [],

    'local' => [
        'host'        => 'buuum.dev',
        'public'      => 'httpdocs',
        'development' => true,
        'bbdd'        => [
            'database' => 'buuum',
            'host'     => '127.0.0.1',
            'username' => 'admin',
            'password' => 'admin'
        ],
        'ftp'         => [

        ]
    ],
    'dev'   => [
        'host'        => 'buuum.dev',
        'public'      => 'httpdocs',
        'development' => true,
        'bbdd'        => [
            'database' => 'buuum',
            'host'     => '127.0.0.1',
            'username' => 'admin',
            'password' => 'admin'
        ],
        'ftp'         => [

        ]
    ],
    'prod'  => [
        'host'        => 'buuum.dev',
        'public'      => 'httpdocs',
        'development' => true,
        'bbdd'        => [
            'database' => 'buuum',
            'host'     => '127.0.0.1',
            'username' => 'admin',
            'password' => 'admin'
        ],
        'ftp'         => [

        ]
    ]

];