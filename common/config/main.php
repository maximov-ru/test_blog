<?php

\Yii::setAlias('@frontwebroot',dirname(dirname(__DIR__)) . '/frontend/web/');
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'useMemcached'=>true,
            'servers' => [
                [
                    'host' => 'localhost',
                    'port' => 11211,
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;port=3306;dbname=dbtest',
            'username' => 'testuser',
            'password' => 'pass',
            'charset' => 'utf8',
            // 'enableSchemaCache' => true,
            // 'schemaCacheDuration' => 3600,
        ],
        'image' => array(
            'class' => 'yii\image\ImageDriver',
            'driver' => 'GD',  //GD or Imagick
        ),

    ],
];
