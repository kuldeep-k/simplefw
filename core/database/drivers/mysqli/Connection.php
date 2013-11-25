<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Database\Drivers\Mysqli;

use SimpleFw\Core\Database\DatabaseInterface;
use SimpleFw\Core\Database\DatabaseConnection;

class Connection extends DatabaseConnection implements DatabaseInterface
{
	public function connect()
	{
		$this->connection = new \Mysqli($this->host, $this->user, $this->password, $this->database);
	}
	
	

}

