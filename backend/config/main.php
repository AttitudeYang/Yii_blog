<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    "aliases" => [    
         "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
         ],  
    'modules' => [
        'admin' => [
                   'class' => 'mdm\admin\Module',
                   'layout' => 'top-menu',//yii2-admin的导航菜单
                   ],
        ],
    'components' => [
        'request' => [
            'parsers' =>[
                'application/json' => 'yii\web\JsonParser',
                'text\json' => 'yii\web\JsonParser',
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\Adminuser',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'PHPBACKENSESSION',
            'savePath'=>sys_get_temp_dir(),
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
        "authManager" => [        
            "class" => 'yii\rbac\DbManager', //这里记得用单引号而不是双引号        
            "defaultRoles" => ["guest"],    
        ],   
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],

    'as access' => [
    'class' => 'mdm\admin\components\AccessControl',
    'allowActions' => [
        '*'
        //controller/action
    ],
    ],
    'defaultRoute' => 'post/index',
    'params' => $params,
];
