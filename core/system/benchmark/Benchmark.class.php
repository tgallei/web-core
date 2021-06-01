<?php
if(!defined('index')) die();

class Benchmark {
	private $_startTime;
	private $_stopTime;
	
	public function __construct() 
	{
		$this->_startTime = self::getMicrotime();
	}

	public function stop() 
	{
		$this->_stopTime = self::getMicrotime();
	}

	private static function getMicrotime() 
	{
		return microtime(true);
	}

	public static function compareMicrotimes($startTime, $endTime) 
	{
		return round(($endTime - $startTime)*1000, 1);
	}
 	
	public function getResult() {
		return $this->compareMicrotimes($this->_startTime, $this->_stopTime).' ms for '.CORE::db()->numQueries.'/'.CORE::sock()->numQueries.' queries.';
	}
}
?>