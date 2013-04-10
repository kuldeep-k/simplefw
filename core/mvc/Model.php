<?php

namespace SimpleFw\Core\Mvc;

use SimpleFw\Core\Database\Database;

class Model
{
	public $db;
	public function __construct()
	{
		$this->db =  new Database('mysqli://root:root@localhost/prog_lang');
	}
}	
