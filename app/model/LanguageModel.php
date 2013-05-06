<?php

namespace SimpleFw\App\Model;

use SimpleFw\Core\Mvc\Model as Model;

class LanguageModel extends Model
{
	public function getLanguages()
	{
		$result = $this->db->getQuery()->query('select * from programming_language ')->execute();
		return $result->fetchAll();
	}	
}	