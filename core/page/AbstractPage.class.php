<?php
if(!defined('index')) die();

abstract class AbstractPage {
	private $_tpl;
	private $_show;

	public function __construct($tpl)
	{
		$this->_show = true;
		$this->_tpl = $tpl;
		$this->generatePage();
	}
	
	public function show()
	{
		$tplUc = StringUtil::ucfirst($this->_tpl);
		CORE::tpl()->assign($this->_tpl, $this);
		if(!empty($this->_tpl) && $this->_show)
			CORE::tpl()->display($this->_tpl.'.tpl');
	}
}
?>