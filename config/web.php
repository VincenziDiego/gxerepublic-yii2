<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'GXERepublic',
    'timeZone' => 'Europe/Rome',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'as access' => [
                'class' => 'mdm\admin\components\AccessControl',
                'allowActions' => [
                    'admin/user/login', // Permetti login (se necessario)
                ],
            ],
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'as access' => [
                'class' => 'mdm\admin\components\AccessControl',
                'allowActions' => [
                    'admin/user/login', // Permetti login (se necessario)
                ],
            ],
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'mjUmj6Ttk6Dizz6JzZ_fUH8IOUgrbM5I',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'login' => 'site/login',
                'signup' => 'site/signup',
                'about' => 'site/about',
                'contact' => 'site/contact',
                'error' => 'site/error',
                'index' => 'site/index',
                'logout' => 'site/logout',
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'assetManager' => [
            'bundles' => [
                // Sovrascrivi l'asset bundle di yii2-admin
                'mdm\admin\assets\AdminAsset' => [
                    'css' => [
                        // Usa il tuo file CSS custom
                        'custom-admin.css',
                    ],
                    // Impedisci il caricamento degli altri CSS se necessario
                    'js' => [],
                    'sourcePath' => '@app/web/css', // Assicurati che questo percorso punti alla cartella corretta
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
        ],
    ];
}

return $config;
