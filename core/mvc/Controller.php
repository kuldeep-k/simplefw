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

	public function setTemplate($template)
	{
		$this->template = $template;
	}	

	public function getTemplate()
	{
		return $this->template;
	}
	
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}	

	public function getLayout()
	{
		return $this->layout;
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
