<?php

namespace SimpleFw\Core\Tools;

class Form
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
	
	public function text($name, $value = null, $attributes = null)
	{
		$text = "<input type='text' name='".$name."' ";
		
		$text .= "value='".$value."' ";
				
		$text .= ' >'
		return $text;
	}	
	
	public function textArea($name, $value = null, $attributes = null)
	{
		$text = "<input type='textarea' name='".$name."' ";
			
		
		$text .= ">".$value."</textarea>";
		
		return $text;
	}	
	
	private function applyIdAndAtributes($text, $attributes) 
	{
		if(!array_key_exists($attributes['id']))
		{
			$text .= "id='".$name."' ";
		}	
		else
		{
			$text .= "id='".$attributes['id']."' ";
		}	
		
		if(is_array($attributes))
		{
			unset($attributes['id']);
			foreach($attributes as $key => $val)
			{
				$text .= $key"='".$val."' ";
			}	
		}
		else if(is_string($attributes))
		{
			$text .= $attributes;
		}
		
		return $text;	
	}	
}	

?>