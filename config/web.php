<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'language' => 'es',
    'timezone'=>'America/Mexico_City',
    'sourceLanguage'=>'en',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@mdm/admin' => '@app/extensions/mdm/yii2-admin-2.2',
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // other module settings, refer detailed documentation
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',

            //'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            //'layout' => 'right-menu', // defaults to null, using the application's layout without the menu
            // other avaliable values are 'right-menu' and 'top-menu'


            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\models\Users',
                    'idField' => 'id',
                    'usernameField' => 'username',
                    'fullnameField' => 'profile.full_name',
                    'extraColumns' => [
                    ],
                ],
            ],
        ],
    ],
    'components' => [
        'assetManager' => [
            'bundles' => [
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyDGQzoImFxynXpURQgdZ97_yxBaq9T2N2U',
                        'libraries' => 'places',
                        'v' => '3.exp',
                        'sensor'=> 'false'
                    ]
                ]
            ]
        ],
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'mpcdemexico',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            //'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
            'class' => 'yii\rbac\DbManager',

        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'viewPath' => '@app/mail',
            'transport' => [
                "class" => "Swift_SmtpTransport",
                "host" => 'smtpout.secureserver.net',
                "username" => 'contacto@sifope.mx',
                "password" => "Mpcd3m3xic0_",
                //"port" => '587',
                //"encryption" => 'tls',
                "port" => '465',
                "encryption" => 'ssl',
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
         'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],

        */
    ],

    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [

            'site/recoverpass',
            'site/resetpass',
            'admin/*',
            'perfil-usuario/*',

            'site/index',
            'unidades/upplistresenas',
            'unidades/upplist',
            'site/login',
            'site/logout',
            'site/logout_movil',
            'site/logout_geo',
            'site/change_pass',
            'site/geolocalizador',
            'site/prueba_bots',
            'site/local-storange',
            'site/retrieve',
            'debug/*',
            'exportacion/*',
            'solicitudes-exportaciones/*',
            'gii/*',
            'some-controller/some-action',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}


return $config;
