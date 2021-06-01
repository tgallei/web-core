<?php
if(!defined('index')) die();

class PageHandler 
{
	private $_pageId;
	private $_url;
	private $_tpls;
	
	private $_title;
	private $_description;
	private $_keywords;
	
	private $_needLogin;	
	
	private $_pageObj;
	
	public function setAlert($alert)
	{
		$_SESSION['alert'] = CORE::db()->sqlStr($alert);
	}
	
	public function getAlert()
	{
		$ret = isset($_SESSION['alert']) ? $_SESSION['alert']:"";
		unset($_SESSION['alert']);
		return $ret;
	}
	
	public function isAlert()
	{
		return isset($_SESSION['alert']) && $_SESSION['alert'] != "" ? true:false;
	}
	
	public function __construct($p)
	{
		if(empty($p))
			$this->_url = 'home';
		else
			$this->_url = $p;
		$this->_getPage();
	}
	
	private function _getPage()
	{
		$pageFile = file_get_contents("page.json");
		$json = json_decode($pageFile, true);
		$pages = array();

		foreach ($json['pages'] as $data) {
			$url = $data["url"];

			$pages[$url] = $data;
		}

		if(isset($pages[$this->_url])) {
			$page = $pages[$this->_url];
			$this->_tpls = $page['tpls'];
			$this->_title = str_replace('%var%', StringUtil::trim($page['title']), title);
			$this->_needLogin = isset($page['needlogin']) ? $page['needlogin'] == true : false;
			/*$this->_description = $row['description'];
			$this->_keywords = $row['keywords'];*/
		} else {
			$this->_url = 'error404';
			$this->_getPage();
		}			
	}
	
	public function isPage($url)
	{
		return StringUtil::trim($this->_url) == StringUtil::trim($url) ? true:false;
	}
	
	public function show()
	{
		if($this->_needLogin)
			SessionUtil::checkPermission();	
		$tpls = array();
		$tmp = explode(',', $this->_tpls);	
		foreach($tmp as $tpl)
			$tpls[] = StringUtil::trim($tpl);
		$this->_pageObj = new Page($tpls);
		foreach($this->_pageObj->pageObjects as $template) {
			$template->show();
		}
	}

	public function setTitle($title, $append = false)
	{
		if($append)
			$this->_title = str_replace('%var%', $title, $this->_title);
		else
			$this->_title = $title;
	}

	public function getTitle()
	{
		return $this->_title;	
	}
	public function getUrl()
	{
		return $this->_url;	
	}

	public function getKeywords()
	{
		return $this->_keywords;	
	}

	public function getDescription()
	{
		return $this->_description;	
	}
	
	public function benchmarkResult()
	{
		CORE::benchmark()->stop();
		return CORE::benchmark()->getResult();
	}
}
?>