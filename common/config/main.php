<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'id-ID',
    'timeZone' => 'Asia/Jakarta',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'common\models\User',
                    'idField' => 'id'
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            //'defaultRoles' => ['guest'],
        ],
        'data' => [
            'class' => 'common\components\Data',
        ],
        'manajemen' => [
            'class' => 'common\components\Manajemen',
        ],
        'tanggal' => [
            'class' => 'common\components\Tanggal',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'loginUrl' => ['site/login'],
            'enableAutoLogin' => false,
            'authTimeout' => 1800,
        ],
        'session' => [
            'class' => 'yii\web\Session',
            'cookieparams' => ['httponly' => true, 'lifetime' => 1800],
            'timeout' => 1800,
            'useCookies' => true,
        ],
       
    ],
];
