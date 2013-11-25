<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Router;
use SimpleFw\Core\Router\RouteException;
use SimpleFw\Core\Tools\AppConfig;

class Router 
{
	const ERR_ROUTE_NOT_EXISTS = 100;
	
	const ERR_CONTROLLER_NOT_EXISTS  = 101;
	
	const ERR_ACTION_NOT_EXISTS  = 102;
	
	const ERR_HOME_ROUTE_NOT_EXISTS  = 103;
	
	const ERR_PAGE_NOT_EXISTS  = 104;
	
	protected $is_raw = false;
	
	public $controller_name;
	
	public $action_name;
	
	public $query_string;
	
	public function __construct($uri)
	{
		
		
		$this->defined_routes = require_once(DOC_ROOT.'/config/routes.php');
		
		$this->app_config = AppConfig::getInstance();
		//echo $uri;die;
		$this->uri = $uri; 
		
		//var_dump(substr('abcdef', strpos('abcdef', 'ab') + strlen('ab')) );die;
		//echo substr('abcdef', strpos('abcdef', strlen('ab') ));die;
		//echo $this->uri.' -- '.$this->app_config->site_root.' -- ';
		//echo substr($this->uri, strpos($this->uri, $this->app_config->site_root) + strlen($this->app_config->site_root));die;
		//echo $this->uri = substr($this->uri, strpos($this->uri, $this->app_config->site_root) + strlen($this->app_config->site_root));
		//die;
		//$this->app_config = require_once(DOC_ROOT.'/config/app.php');
		
	}
	
	public function parse()
	{
		//echo $this->uri;
		
		 
		if($this->uri == $this->app_config->site_root)
		{
			//var_dump(!isset($this->app_config->home_route));die;
			if(!isset($this->app_config->home_route) || trim($this->app_config->home_route) == '' )
			{
				throw new RouteException(self::ERR_HOME_ROUTE_NOT_EXISTS);
			}	
			
			$home_route =$this->app_config->home_route;
			$home_route_array = explode('/', $home_route);
			
			$this->controller_name = $home_route_array[0];
			$this->action_name = $home_route_array[1];
			return true;			
		}
		$this->uri = rtrim($this->uri, '/');
		$this->uri = substr($this->uri, strpos($this->uri, $this->app_config->site_root) + strlen($this->app_config->site_root));
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
			$uri_part1 = ltrim($uri_part1, '/');
			//echo $uri_part1.' --  ';
			//echo $route['pattern'];
			
			if(preg_match('/^'.$route['pattern'].'$/', $uri_part1, $return))
			{
				//echo 'sss';
				$this->controller_name = $return[1];
				$this->action_name = $return[2];
				return true;
			}	
		}	
		die;
		return false;
	}		
	
	protected function safe($value)
	{
		return strip_tags($value);
	}	
}	


?>
