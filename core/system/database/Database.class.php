<?php
if(!defined('index')) die();

class Database
{	
	/**
	 * MySQL-Connection object
	 */
	private $_connection;
	
	/**
	 * Number of queries
	 */
	public $numQueries;
	
	/**
	 * Constructor
	 */
	public function __construct()
	{		
		$this->numQueries = 0;
		$this->_connect();
	}
	
	/**
	 * Establishing connection
	 */
	private function _connect()
	{
		if(!dbPCon)
			$this->_connection = mysqli_connect(dbHost, dbUser, dbPass, dbDB);
		else
			$this->_connection = mysql_pconnect("p:".dbHost, dbUser, dbPass, dbDB);	
			
		if(!$this->_connection)	
			throw new SystemException(mysqli_error(), 0, 'Connection to the database not established.');	
		else
		{
			// Change whole charset to utf8
			//mysql_set_charset('utf8');
			mysqli_query($this->_connection, "SET NAMES 'utf8'");
			mysqli_query($this->_connection, "SET CHARACTER SET 'utf8'");
			
		}
	}
	
	/**
	 * Execute a sql command
	 */
	public function query($sql)
	{
		$res = mysqli_query($this->_connection, $sql);
		if(!$res)
			throw new SystemException(mysqli_error($this->_connection), 0, "<pre>".$sql."</pre></br />could not executed.");
		else
		{
			$this->numQueries++;
			return $res;
		}
	}
	
	/**
	 * Close the database connection if pconnect flag isn't set
	 */
	public function close()
	{
		if(!dbPCon)
			mysqli_close($this->_connection); 
	}
	
	public function sqlStr($str)
	{
		return mysqli_real_escape_string($this->_connection, $str);
	}
}
?>