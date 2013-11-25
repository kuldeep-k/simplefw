<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Database;

class DatabaseConnection 
{
	protected $host;
	protected $user;
	protected $password;
	protected $database;
	protected $connection;

	public function setHost($host)
	{
		$this->host = $host;
	}
	public function setUser($user)
	{
		$this->user = $user;
	}
	public function setPassword($password)
	{
		$this->password = $password;
	}
	public function setDatabase($database)
	{
		$this->database = $database;
	}
	public function getConnection()
	{
		return $this->connection;
	}

}


