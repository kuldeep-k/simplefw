<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Database;

interface QueryInterface 
{
	public function query($query, array $bind_params = null);
	public function insert($table, array $data);
	public function update($table, array $data, array $conditions = null );
	public function delete($table, array $conditions);
	public function __toString();
	public function execute();
}




