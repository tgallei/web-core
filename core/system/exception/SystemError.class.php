<?php
if(!defined('index')) die();

class SystemError
{	
	private $_code;
	private $_message;
	private $_file;
	private $_line;
	
	/**
	 * Constructor
	 */
	public function __construct($code, $message, $file, $line)
	{
		$this->_code = $code;
		$this->_message = $message;
		$this->_file = $file;
		$this->_line = $line;
	}
	
	private function _getErrorType() {
		switch ($this->_code) {
			case E_USER_ERROR:
				return "Fatal Error";	
			case E_USER_WARNING:
				return "Warning";		
			case 8:
				return "Notice";		
			default:
				return "Unknown";
		}
	}
	
	private function __toLog()
	{
		// Save to logfile and send as mail or sms
	}
	
	public function __toString() 
	{
		echo '<h3>'.$this->_getErrorType().': '.$this->_message.'</h3>';
		echo $this->_file.' ['.$this->_line.']';
		die();
	}
}
?>