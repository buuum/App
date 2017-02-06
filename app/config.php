<?php

return [

    'environment'  => 'local',
    'cache'        => 'array',
    'session.name' => 's_id',

    'encode' => [
        'key'       => 'keypass',
        'algorithm' => 'GOST'
    ],

    'mail' => [
        'smtpsecure'      => 'tls',
        'host'            => "",
        'username'        => "",
        'port'            => 25,
        'password'        => "",
        'from'            => ['demo@demo.com', 'Demo'],
        'response'        => ['demo@demo.com', 'Demo'],
        'spool'           => true,
        'spool_directory' => __DIR__ . '/spool'
    ],

    'lang' => 'es_ES',

    'scope'  => 'Web',
    'scopes' => [
        'Adm' => '/adm/',
    ],

    'environments' => [
        'local' => [
            'host'        => 'buuum.dev',
            'public'      => 'httpdocs',
            'development' => true,
            'site_name'   => 'Demo',
            'lang'        => 'es_ES',
            'country'     => 'ES',
            'scope'       => 'Web',
            'scopes'      => [
                'Adm' => '/adm/',
            ],
            'locales'     => [
                'date'     => 'd/m/Y H:i:s',
                'number'   => [0, '', ''],
                'timezone' => "Europe/Madrid"
            ],
            'bbdd'        => [
                'database' => 'buuum',
                'host'     => 'localhost',
                'username' => 'root',
                'password' => ''
            ],
            'ftp'         => [

            ],
            'aws'         => [
                'key'    => '',
                'secret' => '',
                'bucket' => '',
                'urls'   => [
                    'http'  => 'http://s3-eu-west-1.amazonaws.com',
                    'https' => 'https://s3-eu-west-1.amazonaws.com'
                ]
            ],
            'analytics'   => [
                'UA'           => '',
                'tagmanagerid' => ''
            ]
        ]

    ]

];
