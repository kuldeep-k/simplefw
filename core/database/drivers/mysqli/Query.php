<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Database\Drivers\Mysqli;

use SimpleFw\Core\Database\QueryInterface;
use SimpleFw\Core\Database\QueryException;
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
		$clause1 = $clause2 = '';
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
						$clause2 .= '\''.$this->connection->escape_string($value).'\', ';
						break;
					default:
						throw new QueryException('Only Integer/Double/String are allowed as query arguments.');
						break; 		
				}	 
				
			}	
			$clause1 = rtrim($clause1, ', ');
			$clause2 = rtrim($clause2, ', ');
			
			$query .= '('.$clause1.') VALUES ('.$clause2.')'; 
		}	
		$this->query = $query;
		return $this;
	}
	public function update($table, array $data, array $conditions = null )
	{
		$clause1 = $clause2 = '';
		$query = "UPDATE `".$table."` SET ";
		if(sizeof($data) > 0)
		{
			foreach($data as $field=>$value)
			{
				$query .= '`'.$field.'` = ';
				switch(gettype($value))
				{
					case "integer";
					case "double";
						$query .= $value.', ';
						break;
					case "string";
						$query .= '\''.$value.'\', ';
						break;
					default:
						throw new QueryException('Only Integer/Double/String are allowed as query arguments.');
						break; 		
				}	 
				
			}	
			$query = rtrim($query, ', ');
			 
		}	
		
		$query .= ' WHERE ';
		
		if(sizeof($conditions) > 0)
		{
			foreach($conditions as $field=>$value)
			{
				$query .= '`'.$field.'` = ';
				switch(gettype($value))
				{
					case "integer";
					case "double";
						$query .= $value.' AND ';
						break;
					case "string";
						$query .= '\''.$value.'\' AND ';
						break;
					default:
						throw new QueryException('Only Integer/Double/String are allowed as query arguments.');
						break; 		
				}	 
				
			}	
			$query = rtrim($query, ' AND ');
			 
		}	
		$this->query = $query;
		return $this;
	}
	public function delete($table, array $conditions)
	{
		if(sizeof($conditions) > 0)
		{
			$query = "DELETE FROM `".$table."` WHERE ";
		
			foreach($conditions as $field=>$value)
			{
				$query .= '`'.$field.'` = ';
				switch(gettype($value))
				{
					case "integer";
					case "double";
						$query .= $value.' AND ';
						break;
					case "string";
						$query .= '\''.$value.'\' AND ';
						break;
					default:
						throw new QueryException('Only Integer/Double/String are allowed as query arguments.');
						break; 		
				}	 
				
			}	
			$query = rtrim($query, ' AND ');
			$this->query = $query;
			return $this;	 
		}	
		return false;
		
	}
	public function __toString()
	{
		return $this->query;
	}
	public function lastInsertId()
	{
		return $this->connection->insert_id; 
	}		
	public function execute()
	{
		$result_set = $this->connection->query($this->query);
		if($this->connection->errno > 0)
		{
			throw new QueryException('DB Problem. ('.$this->connection->error.') <br /> Query: \''.$this->query.'\'');
		}	
		//echo $this->connection->error;
		//var_dump($post_data);
		//$result_class = "SimpleFw\Core\Database\Drivers\\".$db_driver."\\Result";
		$this->result->setResultSet($result_set);
		//var_dump($this->result);
		return $this->result;
	}
		
}
