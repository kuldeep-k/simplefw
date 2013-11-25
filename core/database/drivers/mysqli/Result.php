<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Database\Drivers\Mysqli;

use SimpleFw\Core\Database\ResultInterface;

class Result implements ResultInterface
{
	public function setResultSet($result_set)
	{
		$this->result_set = $result_set;
	}	
	public function getResultSet()
	{
		return $this->result_set;
	}	
	public function fetchRow()
	{
		return $this->result_set->fetch_assoc();
	}
	public function fetchAll()
	{
		while($row = $this->result_set->fetch_assoc())
		{
			$data[] = $row;
		}	
		return $data;
	}
}
