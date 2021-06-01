<?php
if(!defined('index')) die();

abstract class HeaderUtil
{
	public static function redirect($loc)
	{
		CORE::shutdown();
		header("HTTP/1.1 301 Moved Permanently");
		header('Location: '.$loc);
		die('Weiter zu <a href="'.$loc.'">'.$loc.'</a>');
	}
}
?>