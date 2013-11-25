<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Http;

use SimpleFw\Core\Router\Router;
use SimpleFw\Core\Router\RouteException;

class Request 
{
	const ERR_CONTROLLER_NOT_EXISTS  = 101;
	
	const ERR_ACTION_NOT_EXISTS  = 102;
	
	public $is_raw = false;
	
	protected $router;
	
	protected $controller;
	
	protected $controller_name;
	
	protected $action;
	
	protected $action_name;
	
	protected $query_string;
	
	public static $instance = NULL;
	
	public static function getInstance() 
	{
	    if(!isset(self::$instance)) 
	    {
    		self::$instance = new Request();
    	}
    	return self::$instance;
	}
	
	public function setRouter(Router $router)
	{
		$this->router = $router;
	}	
	
	public function getRouter()
	{
		return $this->router;
	}
	
	public function getController()
	{
		$this->controller_name = $this->getRouter()->controller_name;
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
		$this->action_name = $this->getRouter()->action_name;
		if($this->is_raw == false)
		{
			$this->action_name = $this->safe($this->action_name);
		}
		
		if(!method_exists($this->controller, $this->action_name.'Action')) 
		{
			throw new RouteException('Required Action not found', self::ERR_ACTION_NOT_EXISTS);
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
	
	public function getPost()
	{
		$posts = array();
		
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			if(is_array($_POST))
			{
				//var_dump($this->is_raw);die;
				foreach($_POST as $key => $val)
				{
					if($this->is_raw == false)
					{
						$posts[$key] = $this->safe($val);
					}
					else
					{
						$posts[$key] = $val;
					}	
				}	
			}
		}	
		
		return $posts;
	}
	
	public function hasPost()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			return true;
		}	
		
		return false;
	}	
	
	protected function safe($value)
	{
		return strip_tags($value);
	}	
}	


?>
