<?php
if(!defined('index')) die();

class Page {
	public $pageObjects = array();
	public function __construct($tpls)
	{
		foreach($tpls as $tpl)
		{
			if($tpl != '')
			{
				$template = StringUtil::ucfirst($tpl);
				if(file_exists(coreDir.'page/tpl/p'.$template.'.class.php'))
				{
					require_once(coreDir.'page/tpl/p'.$template.'.class.php');
					eval('$obj = new p'.$template.'(\''.$tpl.'\');');
					$this->pageObjects[] = $obj;
				}
				else if(file_exists(scriptDir.'style/tpl/'.$tpl.'.tpl'))
				{
					$obj = new DefaultPage($tpl);
					$this->pageObjects[] = $obj;
				} 
				else
					throw new SystemException($tpl.'.tpl not found', 0, 'Maybe you forgot \'.class\'-extension.');
			}
		}
	}
}
?>