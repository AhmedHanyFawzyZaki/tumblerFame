<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . '/../extensions/bootstrap');


return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Tumblr Fame',
    'defaultController' => 'Home/home',
    //'homeUrl'=>'home',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        //'application.extensions.yiichat.*',
//		'application.extensions.LocationPicker.*',
        'ext.YiiMailer.YiiMailer',
        'ext.shoppingCart.*',
    ),
    //'theme'=>'bootstrap', // requires you to copy the theme under your themes directory
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'admin',
            'generatorPaths' => array(
                'bootstrap.gii',
            ),
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('*', '::1'),
        ),
    ),
    // application components
    'components' => array(
        ///////////// shopping cart
        'shoppingCart' => array(
            'class' => 'ext.shoppingCart.EShoppingCart',
        ),
        'bootstrap' => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'mailer' => array(
            'class' => 'ext.mail.Mailer',
        ),
        'Paypal' => array(
            'class' => 'application.components.Paypal',
            'apiUsername' => 'ahmed.hany.fawzy-facilitator_api1.hotmail.com',
            'apiPassword' => 'AA86G2K284HDV3L2', //'1355392425',
            'apiSignature' => 'ArcoIsSBiDf1YkCyrHH34-M8jKo3AhzsU7eWzVM9-3t50NlXZqMw6JiR',
            'apiLive' => false,
            /* 'apiUsername' => 'jackyhaw_api1.hotmail.com', //'prosel_1355392367_biz_api1.ukprosolutions.com',
              'apiPassword' => '2CC9E68BMV4NTHVU', //'1355392425',
              'apiSignature' => 'AAIiAXSPszLiaQUwSR6OjA97kNmvAJ9zIhuNvvxt-ftaC3m-JbqrWA6.',
              'apiLive' => true, */
            'currency' => 'USD',
            'returnUrl' => 'home/confirm/', //regardless of url management component
            'cancelUrl' => 'home/cancel/', //regardless of url management component
        ),
        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
        ),
        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'home/page/<slug>' => 'home/page'
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=tumb',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'tum_',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'home/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            // uncomment the following to show log messages on web pages

            /* array(
              'class'=>'CWebLogRoute',
              ), */
            ),
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'ahmed.hany.fawzy@hotmail.com',
        'apiConsumerKey' => 'yqFnbUuOD9tjDPzNA1YSTdZ2tMUNabh3K61sElSRUgKQKhbsur',
    ),
);
