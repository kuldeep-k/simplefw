<?php

namespace SimpleFw\Core\Database\Drivers\Mysqli;

use SimpleFw\Core\Database\QueryInterface;

class Query implements QueryInterface
{
	public function query($query, array $bind_params = null)
	{
	}
	public function insert(array $data)
	{
	}
	public function update(array $data, array $conditions = null )
	{
	}
	public function delete(array $conditions)
	{
	}
	public function __toString()
	{
	}
	public function execute()
	{
	}
}
