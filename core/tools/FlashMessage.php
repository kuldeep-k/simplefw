<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Tools;

class FlashMessage
{
	const TYPE_ERROR = 'error';
	
	const TYPE_SUCCESS = 'success';
	
	const TYPE_INFO = 'info';
	
	const TYPE_NOTICE = 'notice';
	
	public static $instance = NULL;
	
	public static function getInstance() 
	{
	    if(!isset(self::$instance)) 
	    {
    		self::$instance = new FlashMessage();
    	}
    	return self::$instance;
	}
	
	public function setMessage($type, $message)
	{	
		if(!isset($_SESSION['FlashMessage']))
		{	
			$_SESSION['FlashMessage'] = array();
		}	
		
		$_SESSION['FlashMessage'] = array('type' => $type, 'message' => $message);
	}
	
	public function dump()
	{	
		$content = '';
		if(isset($_SESSION['FlashMessage']))
		{
			switch($_SESSION['FlashMessage']['type'])
			{
				case "error":
					$content = '<div class="error">';
					break;
				case "success":
					$content = '<div class="success">';
					break;
				case "info":
					$content = '<div class="info">';
					break;
				case "notice":
					$content = '<div class="notice">';
					break;		
			}	
			$content .= $_SESSION['FlashMessage']['message'];
			$content .= '</div>';
			unset($_SESSION['FlashMessage']);
		}	
		return $content;
	}
}