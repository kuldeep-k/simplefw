<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Tools;

class AppConfig
{
	public static $instance = NULL;
	
	public $app_config;
	
	public function __construct()
	{
		//echo 'Helo';
		$this->app_config = include DOC_ROOT.'/config/app.php';
		//$this->app_config = $_APP_CONFIG;
		//var_dump($this->app_config);die;
	}	
	
	public static function getInstance() 
	{
	    if(!isset(self::$instance)) 
	    {
    		self::$instance = new AppConfig();
    	}
    	return self::$instance;
	}

	public function __get($var)
	{
		if(!array_key_exists($var, $this->app_config))
		{
			throw new \Exception('Not a defined settings ['.$var.']');
		}	
		return $this->app_config[$var];
	}	 	

	public function __isset($var)
	{
		return array_key_exists($var, $this->app_config); 
	}	 	
	
}	


?>