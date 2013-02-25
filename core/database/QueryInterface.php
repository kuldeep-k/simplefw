<?php

namespace SimpleFw\Core\Database;

interface QueryInterface 
{
	public function query($query, array $bind_params = null);
	public function insert(array $data);
	public function update(array $data, array $conditions = null );
	public function delete(array $conditions);
	public function __toString();
	public function execute();
}




