<?php
if(!defined('index')) die();

// Core - Constants
define('coreDir', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('coreVersion', '1.0.0');
define('coreBuild', '0001');
define('coreFirstVersionYear', '2021');


// Main settings
define('host', 'localhost');
define('title', '%var% | Empty Core');
define('startUrl', 'http://'.host.'/home');

// Database - Access
define('useDatabase', false);
/*
define('dbHost', 'localhost');
define('dbPort', 3306);
define('dbUser', 'root');
define('dbPass', '');
define('dbDB', 'database');
define('dbPCon', false);
define('prefix', 'prefix_');
*/

// Time
define('time', time());
define('timeStamp', date('Y-m-d H:i:s', time()));

// IP
define('ip', getenv("HTTP_X_FORWARDED_FOR") ? getenv("HTTP_X_FORWARDED_FOR"):getenv('REMOTE_ADDR'));
?>