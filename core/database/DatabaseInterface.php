<?php

namespace SimpleFw\Core\Database;

interface DatabaseInterface 
{
	public function setHost($host);
	public function setUser($user);
	public function setPassword($password);
	public function setDatabase($database);
	public function connect();
}




