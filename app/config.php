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
        'smtpsecure'      => 'tls',
        'host'            => "email-smtp.us-east-1.amazonaws.com",
        'username'        => "",
        'port'            => 25,
        'password'        => "",
        'from'            => ['news@testamus.com', 'Testamus'],
        'response'        => ['news@testamus.com', 'Testamus'],
        'spool'           => true,
        'spool_directory' => __DIR__ . '/spool'
    ],

    'typeform' => [
        'api_key' => ''
    ],

    'lang' => 'es_ES',

    'scope'  => 'Web',
    'scopes' => [
        'Admin' => '/admin/',
    ],

    'environments' => [
        'local' => [
            'host'        => 'buuum.dev',
            'public'      => 'httpdocs',
            'development' => true,
            'lang'        => 'es_ES',
            'scope'       => 'Web',
            'scopes'      => [
                'Admin' => '/admin/',
            ],
            'locales'     => [
                'date'     => 'd/m/Y H:i:s',
                'number'   => [0, '', ''],
                'timezone' => "Europe/Madrid"
            ],
            'bbdd'        => [
                'database' => '',
                'host'     => 'localhost',
                'username' => '',
                'password' => ''
            ],
            'ftp'         => [

            ],
            'aws'         => [
                'key'    => '',
                'secret' => '',
                'bucket' => '',
                'urls'   => [
                    'http'  => 'http://s3-eu-west-1.amazonaws.com/4timedev',
                    'https' => 'https://s3-eu-west-1.amazonaws.com/4timedev'
                ]
            ],
            'analytics'   => [
                'UA'           => '',
                'tagmanagerid' => ''
            ]

        ],


    ]

];
