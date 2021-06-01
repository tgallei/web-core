<?php
if(!defined('index')) die();

abstract class CookieUtil
{
	public static function get($cookieName) {
		return isset($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : null;
	}

	public static function remove($cookieName) {
		if(isset($_COOKIE[$cookieName])){
			unset($_COOKIE[$cookieName]);
			// empty value and expiration one hour before
			setcookie($cookieName, "", time() - 7200);
			setcookie($cookieName, "", time() - 7200, "/");
		}
	}
}
?>