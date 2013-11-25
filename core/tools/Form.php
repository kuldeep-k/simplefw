<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Tools;

class Form
{
	public static $instance = NULL;
	
	public static function getInstance() 
	{
	    if(!isset(self::$instance)) 
	    {
    		self::$instance = new Form();
    	}
    	return self::$instance;
	}
	
	public function text($name, $value = null, $attributes = null)
	{
		$text = "<input type='text' name='".$name."' ";
		
		$text = $this->applyIdAndAttributes($text, $name, $attributes);
		
		if(!is_null($value))
		{
			$text .= "value='".$value."' ";
		}	
				
		$text .= ' >';
		return $text;
	}	
	
	public function hidden($name, $value = null, $attributes = null)
	{
		$text = "<input type='hidden' name='".$name."' ";
		
		$text = $this->applyIdAndAttributes($text, $name, $attributes);
		
		if(!is_null($value))
		{
			$text .= "value='".$value."' ";
		}
				
		$text .= ' >';
		return $text;
	}	
	
	public function submit($name, $value = null, $attributes = null)
	{
		$text = "<input type='submit' name='".$name."' ";
		
		$text = $this->applyIdAndAttributes($text, $name, $attributes);
		
		if(!is_null($value))
		{
			$text .= "value='".$value."' ";
		}
				
		$text .= ' >';
		return $text;
	}
	
	public function textArea($name, $value = null, $attributes = null)
	{
		$text = "<textarea name='".$name."' ";
		
		$text = $this->applyIdAndAttributes($text, $name, $attributes);
		
		$text .= $value."</textarea>";
		
		if(!is_null($value))
		{
			$text .= "".$value."";
		}
		
		$text .= "</textarea>";
		
		return $text;
	}	
	
	public function dropdown($name, $options, $value = null, $attributes = null)
	{
		$text = "<select name='".$name."' ";
		
		$text = $this->applyIdAndAttributes($text, $name, $attributes);
		
		$text .= ' >';
		if(is_array($options))
		{
			foreach($options as $k => $v)
			{
				if($value == $v)
				{
					$text .= "<option selected value='".$k."'>".$v."<option> ";
				}
				else
				{
					$text .= "<option value='".$k."'>".$v."<option> ";
				}		
			}	
		}
		if(!is_null($value))
		{
			$text .= "value='".$value."' ";
		}	
				
		$text .= ' <select>';
		return $text;
	}	
	
	private function applyIdAndAttributes($text, $name, $attributes) 
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
				$text .= $key."='".$val."' ";
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
