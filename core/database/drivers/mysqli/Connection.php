<?php

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

