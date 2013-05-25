<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
//ini_set("session.cookie_domain", ".salonchimp.com");

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
        
	'name'=>'Salon Chimp',

	// preloading 'log' component
	'preload'=>array('log', 'urlAccess'),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'ext.yii-mail.YiiMailMessage',
                'ext.timepicker.EJuiDateTimePicker',
                'ext.EchMultiSelect.EchMultiSelect',
                'ext..qtip.QTip.*',
                'application.extensions.*',
                'application.extensions.crontab.*',
//                'application.components.CDataProviderIterator',
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
            'bootstrap' => array(
	    'class' => 'ext.bootstrap.components.Bootstrap',
//	    'responsiveCss' => false,
//                'coreCss' => true,
//                'ajaxCssImport' => true,
	),
//            'facebook'=>array(
//                'class' => 'ext.yii-facebook-opengraph.SFacebook',
//                'appId'=>'163229043837236', // needed for JS SDK, Social Plugins and PHP SDK
//                'secret'=>'a89a8a4ada197a613b32bf48a40af218', // needed for the PHP SDK
//                //'fileUpload'=>false, // needed to support API POST requests which send files
//                //'trustForwarded'=>false, // trust HTTP_X_FORWARDED_* headers ?
//                //'locale'=>'en_US', // override locale setting (defaults to en_US)
//                //'jsSdk'=>true, // don't include JS SDK
//                //'async'=>true, // load JS SDK asynchronously
//                //'jsCallback'=>false, // declare if you are going to be inserting any JS callbacks to the async JS SDK loader
//                //'status'=>true, // JS SDK - check login status
//                //'cookie'=>true, // JS SDK - enable cookies to allow the server to access the session
//                //'oauth'=>true,  // JS SDK - enable OAuth 2.0
//                //'xfbml'=>true,  // JS SDK - parse XFBML / html5 Social Plugins
//                //'frictionlessRequests'=>true, // JS SDK - enable frictionless requests for request dialogs
//                //'html5'=>true,  // use html5 Social Plugins instead of XFBML
//                'ogTags'=>array(  // set default OG tags
//                    'title'=>'MY_WEBSITE_NAME',
//                    'description'=>'MY_WEBSITE_DESCRIPTION',
//                    'image'=>'URL_TO_WEBSITE_LOGO',
//                ),
//              ),
//           
            //image extension 
            'image'=>array(
          'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            'params'=>array('directory'=>'/opt/local/bin'),
                ),
                
                
                'user'=>array(
                    'class' => 'WebUser',
                    'allowAutoLogin'=>true,
//                    'autoRenewCookie' => true,
//                    'identityCookie' => array('domain' => '.stuffuneedlocal.com'),
//                    'loginUrl'=>'http://sudhanshu.stuffuneedlocal.com/login',
                    'loginUrl'=>array('site/login'),

                    ),
                
                
             
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        'caseSensitive'=>false,
			'rules'=>array(
                                'login/'=>'site/login',
                                'signup/'=>'users/signup',
                                'features/'=>'site/features',
                                'pricing/'=>'site/pricing',
                                'about/'=>'site/about',
                                'terms'=>'site/terms',
                                'privacy'=>'site/privacy',
                                'search'=>'site/searchsalon',
                                'appointment'=>'users/appointment',
                                'customers'=>'mercustomers/admin',
//                                'settings'=>'users/settings',
                                /*'http://<user:\w+>.stuffuneedlocal.com/<controller:\w+>/<id:\d+>/'=>'<controller>/view',
				'http://<user:\w+>.stuffuneedlocal.com/<controller:\w+>/<action:\w+>/<id:\d+>/'=>'<controller>/<action>',
				'http://<user:\w+>.stuffuneedlocal.com/<controller:\w+>/<action:\w+>'=>'<controller>/<action>',      
                               */ 
                                '<controller:\w+>/<id:\d+>/'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>/'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                               
			),
		),
          /*   'session'=>array(
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
            'sessionTableName' => 'dbsession',
        ),*/
                'session' => array(
                        'class' => 'CDbHttpSession',
//                        'cookieParams' => array('domain' => '.stuffuneedlocal.com'),
                        'timeout' => 3600,
                        'sessionName' => 'session',
                     ),

		
		/*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
                */
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=salon_main',
			'emulatePrepare' => true,
                        'enableProfiling' =>true,
			'username' => 'root',
			'password' => '',
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
                                        'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
//					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
//				// uncomment the following to show log messages on web pages
//				/*
//				array(
//					'class'=>'CWebLogRoute',
//				),
//				*/
			),
		),
                
                 'mail' => array(
                    'class' => 'ext.yii-mail.YiiMail',
                    'transportType' => 'smtp', // change to ?php? when running in real domain.
                    'viewPath' => 'application.views.mail',
                    'logging' => true,
                    'dryRun' => false,
                    'transportOptions' => array(
                        'host' => 'mail.salonchimp.com',
                        'username' => 'info@salonchimp.com',
                        'password' => 'Deem123',
                        'port' => '25',
                        //'encryption' => 'STARTTLS',
                    ),
                ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'care@salonchimp.com',
      'merchantcontactno' => '+91-96600 38338',
//      'siteUrl'=>'http://sudhanshu.stuffuneedlocal.com',
//            'loginUrl'=>'http://sudhanshu.stuffuneedlocal.com/login',
//               'loginUrl'=>'http://www.salonchimp.com/site/login'
	),
);