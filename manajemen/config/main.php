<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-manajemen',
    'name' => 'Asistensi Perencanaan DS',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'manajemen\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'menus' => [
                'assignment' => [
                    'label' => 'Grand Access' // change label
                ],
                'route' => null, // disable menu route
            ]
        ]
    ],
    'components' => [
        
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
           
        ],        
        'request' => [
            'csrfParam' => '_csrf-manajemen',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'identityCookie' => ['name' => '_identity-manajemen', 'httpOnly' => true],
            'authTimeout' => 1800,
        ],
        'session' => [
            // this is the name of the session cookie used for login on the manajemen
            'name' => 'advanced-manajemen',
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
        'view'=>[
            'theme' => [
                
                'pathMap' => [
                    '@app/views' => '@app/layouts'
                 ],
                ],
            ],
            'authManager' => [
                'class' => 'yii\rbac\DbManager',
                'defaultRoles' => ['guest'],
            ],
        // 'assetManager' => [
        //     'bundles' => [
        //         'dmstr\web\AdminLteAsset' => [
        //             'skin' => 'skin-yellow',
        //         ],
        //     ],
        // ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                '*',
                'site/*', // tambahkan action-action yg lain di sini
            ]
        ],
        
        'urlManager' => [
            //'enablePrettyUrl' => true,
            //'showScriptName' => false,
            'rules' => [
                'logout' => 'site/logout',
            ],
        ],
        
    ],
    'params' => $params,
];
