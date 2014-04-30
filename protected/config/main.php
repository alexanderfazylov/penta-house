<?php

$files = array();
$files['database'] = 'database.php';
$files['params'] = 'params.php';

foreach ($files as $file) {
    if (!file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . $file)) {
        die('Файл ' . $file . ' не создан');
    }
}
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'sourceLanguage' => 'en',
    'language' => 'ru',
    'name' => 'Penta-House',
    'preload' => array(
        'log',
    ),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.modules.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool
        'admin',
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '7878',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),

    ),

    // application components
    'components' => array(
        'ih' => array(
            'class' => 'CImageHandler',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                'gii' => 'gii',
                'gii/<controller:\w+>' => 'gii/<controller>',
                'gii/<controller:\w+>/<action:\w+>' => 'gii/<controller>/<action>',
                'admin/<controller:\w+>/<id:\d+>' => 'admin/<controller>/view',
                'admin/<controller:\w+>/<action:\w+>' => 'admin/<controller>/<action>',
                'admin/<controller:\w+>/<action:\w+>' => 'admin/<controller>/<action>',
            ),
        ),
        'db' => include_once($files['database']),

        'authManager' => array(
            'class' => 'AuthManager',
            'connectionID' => 'db',
        ),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),

    ),

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => include_once($files['params']),

);