<?php
ob_start();
session_start();

// Define constants
define('index', true);
define('scriptDir', dirname(__FILE__).DIRECTORY_SEPARATOR);
define('scriptDirNS', dirname(__FILE__)); // ns = no slash

require_once(scriptDir.'core/config.inc.php');
require_once(scriptDir.'core/require.php');

CORE::init();
// False call
if(!strstr($_SERVER['HTTP_HOST'], host) || strstr($_SERVER['REQUEST_URI'], 'index.php') || $_SERVER['REQUEST_URI'] == '/') {
    HeaderUtil::redirect(startUrl);
}

// Trim all $_REQUEST vars
StringUtil::trimAll();
// Show page output
CORE::ph()->show();
// close mysql-connection and other stuff
CORE::shutdown();

ob_end_flush();
?>