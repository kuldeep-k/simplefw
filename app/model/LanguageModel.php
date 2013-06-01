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
	
	public function getLanguage($id)
	{
		$result = $this->db->getQuery()->query('select * from programming_language where id =  '.$id)->execute();
		return $result->fetchRow();
	}
	
	public function insert($data)
	{
		$this->db->getQuery()->insert('programming_language', $data)->execute();
		//$this->db->getQuery()->execute();
		return $this->db->getQuery()->lastInsertId();
	}	
	
	public function update($data, $filters)
	{
		$this->db->getQuery()->update('programming_language', $data, $filters)->execute();
		return true;
	}

	public function delete($filters)
	{
		$this->db->getQuery()->delete('programming_language', $filters)->execute();
		return true;
	}

}	