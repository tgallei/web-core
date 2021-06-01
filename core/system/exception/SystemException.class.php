<?php
if(!defined('index')) die();

class SystemException extends Exception
{	
	protected $_description;
	
	/**
	 * Constructor
	 */
	public function __construct($message = '', $code = 0, $description = '')
	{
		parent::__construct($message, $code);
		$this->_description = $description;
	}
	
	private function _getDescription()
	{
		return $this->_description;
	}
	
	private function __getTraceAsString() 
	{
		$str = preg_replace('/Database->__construct\(.*\)/', 'Database->__construct(...)', $this->getTraceAsString());
		return str_replace(scriptDirNS, '', $str);
	}
	
	private function __toLog()
	{
		// Save to logfile and send as mail or sms
	}
	
	public function __toString() 
	{
		echo '<h3>Fatal error: '.$this->getMessage().'</h3>';
		echo '('.$this->getCode().') '.$this->_getDescription();
		echo '<br /><br />';
		echo '<pre>';
		var_dump($_REQUEST);
		echo '</pre>';
		echo '<br /><br />';
		echo '<pre>'.$this->__getTraceAsString().'</pre>';
		die();
	}
}
?>