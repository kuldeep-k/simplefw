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
		$this->query = $query;
		return $this;
	}
	public function insert($table, array $data)
	{
		$query = "INSERT INTO `".$table."`  ";
		if(sizeof($data) > 0)
		{
			foreach($data as $field=>$value)
			{
				$clause1 .= '`'.$field.'`,';
				switch(gettype($value))
				{
					case "integer";
					case "double";
						$clause2 .= $value.', ';
						break;
					case "string";
						$clause2 .= '\''.$value.'\', ';
						break;
					default:
						throw new QueryException('Only Integer/Double/String are allowed as query arguments.');
						break; 		
				}	 
				
			}	
			$clause1 = rtrim($clause1, ',');
			$clause2 = rtrim($clause2, ',');
			
			$query .= '('.$clause1.') VALUES ('.$clause2.')'; 
		}	
		$this->query = $query;
	}
	public function update($table, array $data, array $conditions = null )
	{
	}
	public function delete($table, array $conditions)
	{
	}
	public function __toString()
	{
		return $this->query;
	}
	public function execute()
	{
		$result_set = $this->connection->query($this->query);
		//echo $this->connection->error;
		//var_dump($this->connection->errono);
		//$result_class = "SimpleFw\Core\Database\Drivers\\".$db_driver."\\Result";
		$this->result->setResultSet($result_set);
		//var_dump($this->result);
		return $this->result;
	}
		
}
