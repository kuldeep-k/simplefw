<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Database;

use SimpleFw\Core\Database\Drivers as Drivers;

class Database 
{
	public function __construct($dsn)	
	{
		// Pending Socket and Port Handling
		$dsn_arr = parse_url($dsn);
		$db_driver = ucfirst($dsn_arr['scheme']);
		$db_class = "SimpleFw\Core\Database\Drivers\\".$db_driver."\\Connection";
		$this->connection = new $db_class();  

		$this->connection->setHost($dsn_arr['host']);
		$this->connection->setUser($dsn_arr['user']);
		$this->connection->setPassword($dsn_arr['pass']);
		//$this->connection->setSocket();
		//$this->connection->setPort();
		//echo $dsn_arr['path'];
		$database = preg_replace("/\//", "", $dsn_arr['path']);
		$this->connection->setDatabase($database);
		$this->connection->connect();
		$query_class = "SimpleFw\Core\Database\Drivers\\".$db_driver."\\Query";
		$this->query = new $query_class($this->connection->getConnection());
		$result_class = "SimpleFw\Core\Database\Drivers\\".$db_driver."\\Result";
		$this->query->setResult(new $result_class());
		//$this->setQuery($this->connection->getConnection());
	}

	public function setQuery($query)
	{
		$this->query = new Query($this->connection);
	} 

	public function getQuery()
	{
		return $this->query;
	} 


}

?>
