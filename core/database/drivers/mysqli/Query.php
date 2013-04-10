<?php

namespace SimpleFw\Core\Database\Drivers\Mysqli;

use SimpleFw\Core\Database\QueryInterface;
//use SimpleFw\Core\Database\Drivers\Result;

class Query implements QueryInterface
{
	public $connection;
	public $result;
	public function __construct($connection)
	{
		$this->connection = $connection;
	}	 
	public function setResult($result)
	{
		$this->result = $result;
	}	
	public function getResult()
	{
		return $this->result;
	}	
	public function query($query, array $bind_params = null)
	{
		
		$result_set = $this->connection->query($query);
		echo $this->connection->error;
		//var_dump($this->connection->errono);
		//$result_class = "SimpleFw\Core\Database\Drivers\\".$db_driver."\\Result";
		$this->result->setResultSet($result_set);
		//var_dump($this->result);
		return $this->result;
	}
	public function insert(array $data)
	{
	}
	public function update(array $data, array $conditions = null )
	{
	}
	public function delete(array $conditions)
	{
	}
	public function __toString()
	{
	}
	public function execute()
	{
	}
		
}
