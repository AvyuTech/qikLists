<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'repricer',
    'name' => 'Repricer',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '!@#$%RepRiseR!@#$%',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'consoleRunner' => [
            'class' => 'app\components\ConsoleRunner',
            'file' => '@app/yii' // or an absolute path to console file
        ],
        'firebaseNotifications' => [
            'class' => 'app\components\FirebaseNotifications',
            'authKey' => 'AIzaSyCQtlE7mNC2BOlD0irHg_ef-49VpAXaddk' // Firebase cloud messaging server key.
        ],
        'data' => 'app\components\GetData',
        'api' => 'app\components\GetApiData',
        'orderData' => 'app\components\GetOrderData',
        'pdf' => ['class'=>'app\components\ExportToPdf'],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'on beforeLogout' => function ($e) {
                $userLogs = \app\models\UserActivityLog::find()->where(['AND', ['ual_user_id' => $e->identity->u_id], ['ual_is_logged' => 1]])->all();
                if($userLogs) {
                    foreach ($userLogs as $userLog) {
                        $userLog->ual_logout_at = time();
                        $userLog->ual_time_spent = (time() - $userLog->ual_login_at);
                        $userLog->ual_is_logged = 0;
                        $userLog->save(false);
                    }
                }
                \Yii::$app->session->remove('userLogged');
            },
            'on afterLogin' => function ($e) {
                $userLog = new \app\models\UserActivityLog();
                $userLog->ual_user_id = $e->identity->u_id;
                $userLog->ual_user_ip = \Yii::$app->request->userIP;
                $userLog->ual_login_at = time();
                $userLog->ual_is_logged = 1;
                $userLog->save(false);
            }
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
        'formatter' => [
            'dateFormat' => 'php:Y-m-d',
            'datetimeFormat' => 'php:Y-m-d H:i:s',
            'timeFormat' => 'php:h:i:s A',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'currencyCode' => '$',
            'class' => 'yii\i18n\Formatter',
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'blog' => 'site/blog',
                'blog/<slug>' => 'site/blog-single',
            ],
        ],
    ],
    'modules' => [
        'dynagrid'=>[
            'class'=>'\kartik\dynagrid\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        /*'api' => [
            'class' => 'app\modules\api\ApiModule',
        ],
        'affiliates' => [
            'class' => 'app\modules\affiliate\AffiliateModule',
        ],*/
    ],
    'as beforeRequest' => [
        'class' => 'yii\filters\AccessControl',
        'except' => ['site/*', 'api/*'],
        'rules' => [
            [
                'actions' => ['login', 'error', 'home'],
                'allow' => true,
            ],
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    //$config['bootstrap'][] = 'debug';
    //$config['modules']['debug'] = [
      //  'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    //];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
