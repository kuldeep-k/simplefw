<?php

namespace SimpleFw\Core\Router;

class Router 
{
	const ERR_ROUTE_NOT_EXISTS = 100;
	
	const ERR_CONTROLLER_NOT_EXISTS  = 101;
	
	const ERR_ACTION_NOT_EXISTS  = 102;
	
	protected $is_raw = false;
	
	public $controller_name;
	
	public $action_name;
	
	public $query_string;
	
	public function __construct($uri)
	{
		$this->uri = $uri;
		
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
	
	protected function safe($value)
	{
		return strip_tags($value);
	}	
}	


?>
