<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Salonier',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'ext.yii-mail.YiiMailMessage',
                'ext.timepicker.EJuiDateTimePicker',
                'ext.EchMultiSelect.EchMultiSelect',
                'application.extensions.*',
                /*'application.modules.cal.models.*',
                'application.modules.cal.components.*',
                'application.modules.cal.controllers.*',
                'application.modules.cal.views.*',
                'application.modules.cal.CalModule.*',
		'application.modules.cal.models.*',
                */
                
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
                
                'cal' => array(
                    'debug' => true // For first run only!
                ),
		
	),

	// application components
	'components'=>array(
                            'user'=>array(
                                'class' => 'WebUser',
                                ),
             
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        'caseSensitive'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>/'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>/'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
                */
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=salonier_salonier',
			'emulatePrepare' => true,
			'username' => 'salonier_saryu',
			'password' => '2012india2012',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
                
                  'mail' => array(
                    'class' => 'ext.yii-mail.YiiMail',
                    'transportType' => 'smtp', // change to ?php? when running in real domain.
                    'viewPath' => 'application.views.mail',
                    'logging' => true,
                    'dryRun' => false,
                    'transportOptions' => array(
                        'host' => 'mail.hostingmachine.net',
                        'username' => 'ravindar@hostingmachine.net',
                        'password' => 'Deem123',
                        'port' => '26',
                        //'encryption' => 'STARTTLS',
                    ),
                ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);