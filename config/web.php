<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => '/clicker/default/index',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'clicker' => [
            'class' => 'app\modules\clicker\Module',
        ],
    ],
    'container' => [
        'definitions' => [
            GridView::class => function ($container, $params, $args) {
                return new GridView(ArrayHelper::merge([
                    'tableOptions' => ['class' => 'table table-bordered table-hover'],
                    'layout' => "{items}\n{summary}\n{pager}",
                ], $args));
            },
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'uV-ZgaKgHSWUL0MBACmQPSgmUYULErB4',
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
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
                'action' => \yii\web\UrlNormalizer::ACTION_REDIRECT_TEMPORARY,
            ],
            'rules' => [
                '/' => '/clicker/default/index',
                'click' => '/clicker/default/click',
                'error/<id>' => '/clicker/default/error',
                'success/<id>' => '/clicker/default/success',
            ],
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'linkAssets' => true,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['172.18.0.6', '172.18.0.1', '127.0.0.1']
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['172.18.0.6', '172.18.0.1', '127.0.0.1']
    ];
}

return $config;
