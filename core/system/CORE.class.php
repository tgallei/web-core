<?php
if(!defined('index')) die();

abstract class CORE 
{
	private static $_benchmarkObj;
	private static $_dbObj;
	private static $_tplObj;
	private static $_phObj;
	
	/**
	 * Starting framework
	 */
	public static function init()
	{
		self::_initBenchmark();
		if(useDatabase) {
			self::_initDatabase();
		}
		self::_initTemplate();
		self::_initPageHandler();
	}
	
	private static function _initBenchmark()
	{
		self::$_benchmarkObj = new Benchmark();
	}
	
	public static function benchmark()
	{
		return self::$_benchmarkObj;
	}
	
	/**
	 * Opening database connection
	 */
	private static function _initDatabase()
	{
		self::$_dbObj = new Database(dbHost, dbUser, dbPass, dbDB, dbPCon);	
	}
	
	/**
	 * Get method for the database object
	 */
	public static function db()
	{
		return self::$_dbObj;
	}
	
	/**
	 * Starting smarty engine
	 */
	private static function _initTemplate()
	{
		self::$_tplObj = new Smarty();	
		self::$_tplObj->template_dir = scriptDir.'style/tpl';
		self::$_tplObj->compile_dir = scriptDir.'cache';
	}
	
	/**
	 * Get method for the smarty (template) object
	 */
	public static function tpl()
	{
		return self::$_tplObj;
	}
	
	/**
	 * Starting pagehandler
	 */
	private static function _initPageHandler()
	{
		$p = (isset($_GET['p']))?($_GET['p']):('home');
		self::$_phObj = new PageHandler($p);
		
		// Assign PageHandler to Smarty
		self::tpl()->assign('ph', self::ph());
	}
	
	/**
	 * Get method for the pagehandler
	 */
	public static function ph()
	{
		return self::$_phObj;
	}
	
	/**
	 * Shutdown
	 */
	public static function shutdown()
	{
		if(useDatabase) {
			self::db()->close();
		}
	}
}
?>