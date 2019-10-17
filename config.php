<?php

    // error_reporting( E_ALL & ~E_NOTICE & ~E_WARNING);
	error_reporting( E_ALL );
	
	define('SITE_NAME', '/pbx');	
	
	 
	// Database
	define('DB_PERSISTENCY', 'true');
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	
	define('DB_DATABASE_PBX',   'pbx');
	define('DB_DATABASE_QSTAT', 'qstatslite');
	define('PDO_DSN_PBX',   'mysql:host='.DB_SERVER.';dbname='.DB_DATABASE_PBX);	
	define('PDO_DSN_QSTAT', 'mysql:host='.DB_SERVER.';dbname='.DB_DATABASE_QSTAT);	
