<?php

namespace SimpleFw\Core\Database;

//use SimpleFw\Core\Database\Drivers as Drivers;

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
		//$this->setQuery($this->connection->getConnection());
	}

	public function setQuery($connection)
	{
		$this->query = new Query($connection);
	} 

	public function getQuery()
	{
		return $this->query;
	} 


}

?>
