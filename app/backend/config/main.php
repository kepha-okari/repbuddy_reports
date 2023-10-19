<?php
    $params = array_merge(
        require __DIR__ . '/../../common/config/params.php',
        require __DIR__ . '/../../common/config/params-local.php',
        require __DIR__ . '/params.php',
        require __DIR__ . '/params-local.php'
    );

    return [
        'id' => 'app-backend',
        'name' => 'Peanut',
        'basePath' => dirname(__DIR__),
        'controllerNamespace' => 'backend\controllers',
        'bootstrap' => ['log'],
        'modules' => [
            'gridview' => [
                'class' => 'kartik\grid\Module',
                // other module settings
            ]
        ],
        'components' => [
            'request' => [
                'csrfParam' => '_csrf-backend',
            ],
            'session' => [
                'class' => 'yii\web\Session',
                'timeout' => 1200,

            ],
            'user' => [
                'identityClass' => 'common\models\User',
                'enableAutoLogin' => false,
                'authTimeout' => 1200,
                'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
            ],
            'session' => [
                // this is the name of the session cookie used for login on the backend
                'name' => 'advanced-backend',
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
            'errorHandler' => [
                'errorAction' => 'site/error',
            ],
            
            'urlManager' => [
                'enablePrettyUrl' => false,
                'showScriptName' => false,
                'rules' => [
                ],
            ],
            
        ],
        'params' => $params,
    ];
