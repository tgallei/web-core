<?php
if(!defined('index')) die();

class DBResult
{	
	private static $_cache = array();
	
	private $_sql;
	private $_compare;
	private $_res;
	
	private $_fetch_array = array();
	private $_fetch_assoc = array();
	private $_fetch_object = array();
	private $_fetch_row = array();
	private $_result;
	private $_num_rows;
	
	private static function _inCache($sql)
	{
		$found = false;
		if(isset(self::$_cache))
		{
			foreach(self::$_cache as $item)
			{
				if($item->_compare == $sql)
				{
					$obj = $item;
					$found = true;
					break;
				}	
			}
		} else
			self::$_cache = array();
			
		return $found ? $obj:NULL;
	}
	
	public static function initObj($sql, $cache = true)
	{
		if(!($obj = self::_inCache($sql)))
		{
			if($cache)
				$obj = new DbResult($sql);
			else
				$obj = new DbResult($sql, false);			
		}
		if(!$cache)
			$obj->_res = CORE::db()->query($sql);
		return $obj;
	}
	
	public function __construct($sql, $fireQuery = true) 
	{
		$this->_sql = $sql;
		$this->_compare = $sql;
		if($fireQuery)
			$this->_res = CORE::db()->query($sql);
		self::$_cache[] = $this;
	}
	
	public function fetch_array()
	{
		if($this->_fetch_array == NULL)
			while($res = mysqli_fetch_array($this->_res))
				$this->_fetch_array[] = $res;
		return $this->_fetch_array;
	}
	
	public function fetch_assoc()
	{
		if($this->_fetch_assoc == NULL)
			while($res = mysqli_fetch_assoc($this->_res))
				$this->_fetch_assoc[] = $res;
		return $this->_fetch_assoc;
	}
	
	public function fetch_assoc_or()
	{
		$var = $this->fetch_assoc();
		return $var[0];
	}
	
	public function fetch_object()
	{
		if($this->_fetch_object == NULL)
			while($res = mysqli_fetch_object($this->_res))
				$this->_fetch_object[] = $res;
		return $this->_fetch_object;
	}
	
	public function fetch_row()
	{
		if($this->_fetch_row == NULL)
			$this->_fetch_row = mysqli_fetch_row($this->_res);
		return $this->_fetch_row;
	}
	
	public function result()
	{
		if($this->_result == NULL)
			$this->_result = mysqli_result($this->_res, 0);	
		return $this->_result;
	}
	
	public function num_rows()
	{
		if($this->_num_rows == NULL)
			$this->_num_rows = mysqli_num_rows($this->_res);
		return $this->_num_rows;
	}
	
	public static function fillAttr($obj, $fields, $sep = "")
	{
		foreach($fields as $k => $field)
			$obj->{$sep.$k} = $fields[$k];
	}
	
	public static function lastInsertId()
	{
		return mysql_insert_id();
	}
}
?>