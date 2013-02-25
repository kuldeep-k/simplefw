<?php

namespace SimpleFw\Core\Mvc;

class Controller 
{
	protected $query;
	
	protected $template;
	
	protected $name;
	
	protected $action_name;
	
	public function setQuery($query)
	{
		$this->query = $query;
	}	
	
	public function getQuery()
	{
		return $this->query;
	}

	public function setTemplate($name)
	{
		$this->template = $template;
	}	

	public function getTemplate()
	{
		return $this->template;
	}
		
	public function setName($name)
	{
		$this->name = $name;
	}	

	public function getName()
	{
		return $this->name;
	}	
	
	public function setActionName($action_name)
	{
		$this->action_name = $action_name;
	}	

	public function getActionName()
	{
		return $this->action_name;
	}	
	
}	

?>
