<?php
if(!defined('index')) die();

abstract class EncryptionUtil
{
	public static function encrypt( $string ) {
		try {
			$string = base64_encode( base64_encode ( $string ) );
			$string = $string."".base64_mail_extension;
			$string = base64_encode( base64_encode ( $string ) );
		} catch (Exception $e) {
			$string = false;
		}
		return $string;
	}

	public static function decrypt( $string ) {
		try {
			$string = base64_decode( base64_decode ( $string ) );
			$string = substr($string, 0, strlen(base64_mail_extension)*-1);
			$string = base64_decode( base64_decode ( $string ) );
		} catch (Exception $e) {
			$string = false;
		}
		return $string;
	}
}
?>