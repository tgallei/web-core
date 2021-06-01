<?php
if(!defined('index')) die();

abstract class SessionUtil{
	public static function login($userid){
		self::logout();
		
		$_SESSION['loggedin'] = true;
		$_SESSION['userid'] = intval($userid);
	}
	
	public static function logout(){
		session_destroy();
		$_SESSION['loggedin'] = false;
		$_SESSION['userid'] = -1;
	}
	
	// Checks permission and redirect to a void site
	public static function checkPermission(){
		if(!self::checkLoggedin())
			HeaderUtil::redirect("/login");
		else
		{
			// check if banned
		}
	}
	
	public static function checkLoggedin(){
		if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
		{
			if(isset($_SESSION['userid']) && intval($_SESSION['userid']) > 0)
			{				
				// prüfen ob user vorhanden ist
				// prüfen ob gesperrt
				return true;
			} else
				return false;
		}
		else
			return false;
	}
	
	public static function getUserId(){
		return isset($_SESSION['userid']) ? $_SESSION['userid']:-1;
	}

	public static function getClientIp(){
		return isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
	}
}
?>