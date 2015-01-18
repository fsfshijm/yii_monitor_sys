<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
$QMM_BASE_DIR = realpath(dirname(__FILE__).'/../../');
Yii::setPathOfAlias('lib', $QMM_BASE_DIR.'/lib');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$DOMOB_WEB_BASE_DIR = $_SERVER['DOCUMENT_ROOT'];
$logDir = $DOMOB_WEB_BASE_DIR.'/logs';
Yii::setPathOfAlias('bootstrap', $DOMOB_WEB_BASE_DIR.'/../lib/extensions/yii-bootstrap-2.1.0.r355');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'多盟监控数据平台',
	'theme' => 'bootstrap',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		///*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gii',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('10.0.0.*','::1'),
		),
		//*/
	),

	// application components
	'components'=>array(
		'bootstrap' => array(
			'class' => 'bootstrap.components.Bootstrap',
		),
        'user' => array(
            // enable cookie-based authentication
            //'allowAutoLogin'=>true,
            'class'=>'lib.cas.CASWebUser',
            //'serverHost'=>'login.xxxxxxxx-inc.cn',
            //'serverPort'=>443,
            'serverHost'=>'sso.back.xxxxxxxx-inc.cn',
            'serverPort'=>4443,
            'serverName'=>'cas',
        ),
        /*
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),*/
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=your_db_name;port=3320;dbname=monitor',
			'emulatePrepare' => true,
			'username' => 'monitor',
			'password' => 'dmqa714monitor',
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
					'levels'=>'trace',
					'logPath'=> $logDir,
					'logFile'=> 'qmm.trace.log'
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'debug, info',
					'logPath'=> $logDir,
					'logFile'=> 'qmm.info.log'
				),

				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
					'logPath'=> $logDir,
					'logFile'=> 'qmm.warn.log'
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
		'adminEmail'=>'webmaster@example.com',
	),
	'params' => array (
		'objStatus' => array(
			'Normal'=>'/images/blue.png', 
			'UnWached'=>'/images/grey.png', 
			'Warning'=>'/images/yellow.png', 
			'Error'=>'/images/red.png',
		),
		'CheckerStatus' => array(
			'Normal'=>'/images/32x32/blue.png', 
			'Stoped'=>'/images/32x32/grey.png', 
			'DataLost'=>'/images/32x32/yellow.png', 
			'Error'=>'/images/32x32/red.png',
		),
		'CheckerTypes' => array(
			0=>"同比增加",
			1=>"同比减少",
			2=>"环比增加",
			3=>"环比减少",
			4=>"绝对值大于",
			5=>"绝对值小于",
		),

	)
);
