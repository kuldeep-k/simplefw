<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Mvc;

use SimpleFw\Core\Request;
use SimpleFw\Core\Response;
use SimpleFw\Core\Tools\AppConfig;

class Controller 
{
	protected $query;
	
	protected $request;
	
	protected $template;
	
	protected $layout;
	
	protected $name;
	
	protected $action_name;
	
	public $app_config;
	
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
	
	public function setControllerName($action_name)
	{
		$this->controller_name = $controller_name;
	}	

	public function getControllerName()
	{
		return $this->controller_name;
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
		$app_config = AppConfig::getInstance();
		//die($app_config->site_root.'/'.$url);
		
		header('location: http://'.$_SERVER['HTTP_HOST'].$app_config->site_root.$url);
		exit;
	}	
	
}	

?>
