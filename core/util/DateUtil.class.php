<?php
if(!defined('index')) die();

abstract class DateUtil{
	public static function getCurrentTimestamp(){
		return date('Y-m-d H:i:s', time());
	}
}
?>