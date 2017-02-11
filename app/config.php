<?php

return [

    'session.name' => 's_id',

    'encode' => [
        'key'       => '!))!99!',
        'algorithm' => 'GOST'
    ],

    'mail' => [
        'smtpsecure'      => 'tls',
        'host'            => "email-smtp.us-east-1.amazonaws.com",
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
            'lang'        => 'es_ES',
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
                'database' => 'db',
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
