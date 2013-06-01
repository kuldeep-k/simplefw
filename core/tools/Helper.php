<?php

namespace SimpleFw\Core\Tools;

class Helper
{
	public static $instance = NULL;
	
	public static function getInstance() 
	{
	    if(!isset(self::$instance)) 
	    {
    		self::$instance = new Helper();
    	}
    	return self::$instance;
	}
	
	public function link($url, $query_params = null, $attributes = null, $style_attributes = null)
	{
		$base_url = $_SERVER['SCHEME'].'//'.$_SERVER['HTTP_HOST'];
		$link = $base_url.'/'.$url;
		if(is_array($query_params))
		{
			$link .= '?'.http_build_query($query_params);
		}	
		
		if(is_array($attributes))
		{
		}
		
		if(is_array($style_attributes))
		{
		}	
		
		return $link;
	}	
}	

?>