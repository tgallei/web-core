<?php
if(!defined('index')) die();

function exception_handler($exception)
{
	$exception->__toString();
}
set_exception_handler('exception_handler');

function error_handler($code, $msg, $file, $line)
{
	$error = new SystemError($code, $msg, $file, $line);
	$error->__toString();
}
set_error_handler('error_handler');
?>