<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);
$commonConfig = require(__DIR__ . '/../../common/config/main.php');

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules'=>[
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['*'], // adjust this to your needs

        ],
        //'debug'=>'yii\debug\Module'
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'db' => $commonConfig['components']['db'],
        'image' => $commonConfig['components']['image'],
        'urlManager' => [
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'cache'=>false,
            'rules' => [
                'blog/page<page:\d+>' => 'blog/index',
                '/' => 'blog/index',
                '/blog/rss'=>'blog/rss',
                'blog/<slug:[0-9a-zA-Z\\-\\+]+>' => 'blog/view',

                '<controller>/<action>' => '<controller>/<action>'
            ]
        ],
        'request' => [
            'baseUrl' => '',
        ],
    ],
    'params' => $params,
];
