<?php
Yii::setPathOfAlias('', $root);
Yii::setPathOfAlias('common', $root . DIRECTORY_SEPARATOR . 'common');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Academic Management Systems',
    'theme' => 'themes',
    'preload' => array('log', 'bootstrap'),
    'import' => array(
        'application.models.*',
        'application.models.acc.*',
        'common.components.*',
        'common.extensions.*',
        'common.extensions.image.helpers.*',
    ),
    'aliases' => array(
        'xupload' => 'common.extensions.xupload'
    ),
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=' . $db,
            'emulatePrepare' => true,
            'username' => $dbUser,
            'password' => $dbPwd,
            'tablePrefix' => '',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true
        ),
        'landa' => array(
            'class' => 'LandaCore',
        ),
        'user' => array(
            'loginUrl' => array('/site/login'),
            'allowAutoLogin' => true,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'dashboard' => '/site',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
            'urlSuffix' => '.html',
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'common.extensions.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters' => array('127.0.0.1', '192.168.1.11'),
                ),
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
        'bootstrap' => array(
            'class' => 'common.extensions.bootstrap.components.Bootstrap',
            'responsiveCss' => true,
            'fontAwesomeCss' => true,
        ),
        'image' => array(
            'class' => 'common.extensions.image.CImageComponent',
            'driver' => 'GD',
            'params' => array('directory' => '/opt/local/bin'),
        ),
        'themeManager' => array(
            'basePath' => $root . 'common/',
        ),
        'cache' => array(
            'class' => 'system.caching.CFileCache'
        ),
    ),
    'params' => array(
        'appVersion' => 'v.1',
        'client' => $client,
        'clientName' => $clientName,
        'id' => '1',
        'pathImg' => $root . 'images/',
    ),
);
?>
