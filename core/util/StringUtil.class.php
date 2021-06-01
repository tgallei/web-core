<?php
if(!defined('index')) die();

abstract class StringUtil
{
	public static function objToArr($var, $what = array())
	{
		$cv = count($what) == 0 ? get_class_vars(get_class($var)):$what;			
		$arr = array();			
		foreach ($cv as $attr => $v)
		{
			if(is_int($attr))
				$arr[$v] = $var->{$v};
			else
				$arr[$attr] = $var->{$attr};
		}
		return $arr;
	}
	public static function debug($var)
	{
		echo "<pre>";
		var_dump($var);
		echo "</pre>";
		die();	
	}
	
	public static function checkEmail($email) 
	{
	 	if(preg_match("/^(?:[a-z0-9!#$%&'*+=?^_`{|}~-öüäß-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-öüäß-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9öüäß](?:[a-z0-9-öüäß]*[a-z0-9öüäß])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/", strtolower($email)))
			return true;
		else
			return false;
	}
	
	public static function trimAll()
	{
		foreach($_POST as $k => $i)
			$_POST[$k] = self::trim($i);
		foreach($_GET as $k => $i)
			$_GET[$k] = self::trim($i);
		foreach($_SESSION as $k => $i)
			$_SESSION[$k] = self::trim($i);
	}
	
	public static function trim($str)
	{
		if(!is_array($str) && !is_object($str))
			return trim($str);
		else
			return $str;
	}
	
	public static function ucfirst($str)
	{
		return ucfirst($str);
	}
	
	public static function md5($str)
	{
		return md5($str);	
	}
	
	public static function sha1($str)
	{
		return sha1($str);
	}
	
	public static function randomHash($len = "8", $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789")
	{
		$str = "";
		for($i = 0; $i < $len; $i++)
			$str .= substr($chars, rand(0, strlen($chars)-1), 1);
		return $str;
	}
	
	public static function generateSalt()
	{
		return self::randomHash(40);	
	}
	
	public static function getSaltedHashSha1($salt, $str)
	{
		return self::sha1($str.':'.$salt);
	}
	
	public static function getSaltedHashMd5($salt, $str)
	{
		return self::md5($str.':'.$salt);
	}
	
	public static function getDoubleSaltedHash($salt, $str)
	{
		return self::sha1(self::getSaltedHashMd5($salt, $str).':'.self::getSaltedHashSha1($salt, $str));
	}
	
	public static function isPhoneNumber($str){

		if(preg_match("/^([0-9+\/]*)$/", str_replace(" ", "", $str)))
			return true;
		else
			return false;
	}
	
	public static function isEmpty($str){
		if(!isset($str) || strlen($str)<=0){
			return true;
		}
		return false;
	}
	
	
	public static function trim_text($input, $length, $strip_html = true) {
		//strip tags, if desired
		if ($strip_html) {
		    $input = strip_tags($input);
		}
	      
		//no need to trim, already shorter than trim length
		if (strlen($input) <= $length) {
		    return $input;
		}
	      
		//find last space within length
		$last_space = strrpos(substr($input, 0, $length), ' ');
		$trimmed_text = substr($input, 0, $last_space);
	      
		return $trimmed_text;
	}

	public static function startsWith ($str, $startString) { 
    	$len = strlen( $startString); 
    	return ( substr( $str, 0, $len ) === $startString ); 
	} 

	public static function isHTML($string){
		return $string != strip_tags($string) ? true : false;
	}

	public static function replace($string, $search, $replace){
		// Liefert: <body text='schwarz'>
        return str_replace($search, $replace, $string);
	}
}
?>