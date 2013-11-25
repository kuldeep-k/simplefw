<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Database;

interface DatabaseInterface 
{
	public function setHost($host);
	public function setUser($user);
	public function setPassword($password);
	public function setDatabase($database);
	public function connect();
}




