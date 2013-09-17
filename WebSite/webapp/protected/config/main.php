<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	'theme' => 'hebo',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.user.models.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gioppo',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
		'user' => array(
			'debug' => false,
			'userTable' => 'user',
			'translationTable' => 'translation',
			'baseLayout' => 'webroot.themes.hebo.views.layouts.main',
			'mailer'=>'PHPMailer',
			'phpmailer'=>array(
					'transport'=>'smtp',
					'html'=>true,
					'properties'=>array(
							'CharSet' => 'UTF-8',
							'Host' => '194.116.110.17', // SMTP server
							'SMTPDebug' => false,          // enables SMTP debug information (for testing)
							'SMTPAuth' => true,            // enable SMTP authentication
							'SMTPSecure' => '',         // sets the prefix to the servier
							'Host' => '194.116.110.17',    // sets GMAIL as the SMTP server
							'Port' => 25,                   // set the SMTP port for the GMAIL server
							'Username' => 'saveus@cloudlabcsi.eu',  // GMAIL username
							'Password' => '1!Saveus',        // GMAIL password
					),
					'msgOptions'=>array(
							'fromName'=>'saveus',
							'toName'=>'New user',
					),
			),
		),
		'usergroup' => array(
			'usergroupTable' => 'usergroup',
			'usergroupMessageTable' => 'user_group_message',
		),
		'membership' => array(
			'membershipTable' => 'membership',
			'paymentTable' => 'payment',
		),
		'friendship' => array(
			'friendshipTable' => 'friendship',
		),
		'profile' => array(
			'privacySettingTable' => 'privacysetting',
			'profileTable' => 'profile',
			'profileCommentTable' => 'profile_comment',
			'profileVisitTable' => 'profile_visit',
		),
		'role' => array(
			'roleTable' => 'role',
			'userRoleTable' => 'user_role',
			'actionTable' => 'action',
			'permissionTable' => 'permission',
		),
		'message' => array(
			'messageTable' => 'message',
			'adminEmail' => 'saveus@cloudlabcsi.eu',
		),
		'registration' => array(
			'enableCaptcha' => false,
			'registrationEmail' => 'saveus@cloudlabcsi.eu',
		//'messageTable' => 'message',
		),

	),

	// application components
	'components'=>array(
	/*
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		*/
		'user'=>array(
			'class' => 'application.modules.user.components.YumWebUser',
			'allowAutoLogin'=>true,
			'loginUrl' => array('//user/user/login'),
		),
		
		'cache'=>array(
			'class'=>'system.caching.CDummyCache',
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
//			'connectionString' => 'pgsql:host=localhost;port=5432;dbname=saveus',
			'connectionString' => 'mysql:host=wso2mysql.test.italy.cloudlabcsi.local;dbname=saveus',
			'emulatePrepare' => true,
			'username' => 'saveus',
			'password' => '$aveuS!1',
			'charset' => 'utf8',
			'tablePrefix' => '',
			        'enableParamLogging' => true,

		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
	    'mailer' => array(
		  'class' => 'application.extensions.mailer.EMailer',
		  'pathViews' => 'application.views.email',
		  'pathLayouts' => 'application.views.email.layouts'
	    ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
			//		'categories'=>'*.*',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'saveus@cloudlabcsi.eu',
	),
);