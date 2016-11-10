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

    'environments' => [
        'local' => [
            'host'        => 'buuum.dev',
            'public'      => 'httpdocs',
            'development' => true,
            'lang'        => 'es_ES',
            'scope'       => 'Web',
            'scopes'      => [],
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
            'host'        => 'buuum2.dev',
            'public'      => 'httpdocs',
            'development' => true,
            'lang'        => 'es_ES',
            'scope'       => 'Web',
            'scopes'      => [],
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
            'host'        => 'buuum3.dev',
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

    ]

];