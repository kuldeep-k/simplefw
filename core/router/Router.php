<?php

namespace SimpleFw\Core\Router;

class Router 
{
	const ERR_ROUTE_NOT_EXISTS = 100;
	
	const ERR_CONTROLLER_NOT_EXISTS  = 101;
	
	const ERR_ACTION_NOT_EXISTS  = 102;
	
	protected $is_raw = false;
	protected $controller;
	
	protected $controller_name;
	
	protected $action;
	
	protected $action_name;
	
	protected $query_string;
	
	public function __construct($uri)
	{
		//global $app_routes;
		$this->uri = $uri;
		//print_r($app_routes);
		$this->defined_routes = require_once(DOC_ROOT.'/config/routes.php');;
	}
	
	public function parse()
	{
		if(preg_match('/\?/', $this->uri))
		{
			$uri_arr = explode('?', $this->uri);
			$uri_part1 = $uri_arr[0];
			$this->query_string =  $uri_arr[1];
		}
		else
		{
			$uri_part1 = $this->uri;
		}
		
		foreach($this->defined_routes as $route) 
		{
			if(preg_match('/^\/'.$route['pattern'].'$/', $uri_part1, $return))
			{
				$this->controller_name = $return[1];
				$this->action_name = $return[2];
				return true;
			}	
		}	
		return false;
	}		
	
	public function getController()
	{
		if($this->is_raw === false)
		{
			$this->controller_name = $this->safe($this->controller_name);
		}	
		$controller_file_name = DOC_ROOT.'/app/controller/'.ucfirst($this->controller_name).'Controller.php';
		if(!file_exists($controller_file_name))
		{
			throw new RouteException(self::ERR_CONTROLLER_NOT_EXISTS);
		}
		require_once($controller_file_name);	
		$controller_class_name = "Simplefw\\App\\Controller\\".ucfirst($this->controller_name).'Controller';
		if(!class_exists($controller_class_name)) 
		{
			throw new RouteException(self::ERR_CONTROLLER_NOT_EXISTS);
		}			
		
		$this->controller = new $controller_class_name;
		$this->controller->setName($this->controller_name);	
		
		return $this->controller;
	}
	
	public function getAction()
	{
		if($this->is_raw == false)
		{
			$this->action_name = $this->safe($this->action_name);
		}
		if(!method_exists($this->controller, $this->action_name.'Action')) 
		{
			throw new RouteException(self::ERR_ACTION_NOT_EXISTS);
		}
		$this->action = $this->action_name.'Action';
		$this->controller->setActionName($this->action_name);
		$this->controller->setTemplate($this->controller_name.'/'.$this->action_name);
		return $this->action;
	}
	
	public function getQuery()
	{
		parse_str($this->query_string, $temp);
		
		if(is_array($temp))
		{
			foreach($temp as $key => $val)
			{
				if($this->is_raw == false)
				{
					$temp[$key] = $this->safe($val);
				}
			}	
		}
		
		return $temp;
	}
	
	protected function safe($value)
	{
		return strip_tags($value);
	}	
}	


?>
