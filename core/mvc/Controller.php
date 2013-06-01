<?php

namespace SimpleFw\Core\Mvc;

use SimpleFw\Core\Request;
use SimpleFw\Core\Response;


class Controller 
{
	protected $query;
	
	protected $request;
	
	protected $template;
	
	protected $layout;
	
	protected $name;
	
	protected $action_name;
	
	public function setRequest(Request $request)
	{
		$this->request = $request;
	}	
	
	public function getRequest()
	{
		return $this->request;
	}

	public function setResponse($response)
	{
		$this->response = $response;
	}	
	
	public function getResponse()
	{
		return $this->response;
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
	
	public function redirect($url)
	{
		header('location: /'.$url);
		exit;
	}	
	
}	

?>
