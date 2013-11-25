<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Mvc;
use SimpleFw\Core\Mvc\Exception\ViewNotFoundException;
use SimpleFw\Core\Tools\Helper;
use SimpleFw\Core\Tools\Form;
use SimpleFw\Core\Tools\FlashMessage;
use SimpleFw\Core\Tools\AppConfig;

class View
{
	public $controller; 	
	public $template; 	
	public $layout;
	public $page;
	public $AppConfig;
		
	public function inject($controller)
	{
		$this->controller = $controller;
		
		if($this->controller->getTemplate() != false)
		{
			if(is_null($this->controller->getTemplate()))
			{
				
				$this->controller->setTemplate($this->controller->getControllerName().'/'.$this->controller->setActionName());
			}
			$this->template = __DIR__.'/../../app/view/templates/'.$this->controller->getTemplate().'.php';
			
			if(!file_exists($this->template))
			{
				throw new ViewNotFoundException('Template File `'.$this->template.'` not found');
			}
		}	

		if($this->controller->getLayout() !== false)
		{
			if(is_null($this->controller->getLayout()))
			{
				$this->controller->setLayout('layout');
			}
			$this->layout = __DIR__.'/../../app/view/layouts/'.$this->controller->getLayout().'.php';
			
			if(!file_exists($this->layout))
			{
				throw new ViewNotFoundException();
			}
		}	
		
	}	
	public function render($page)
	{
		$this->page = $page;
		$this->helper = Helper::getInstance();
		$this->form = Form::getInstance();
		$this->FlashMessage = FlashMessage::getInstance();
		$this->AppConfig = AppConfig::getInstance();
		
		ob_start();
		
		include($this->template);
		$this->content = ob_get_clean();
		
		if(!$this->http_metas['title'])
		{
			$this->http_metas['title'] = $this->AppConfig->application_title.'::'.$this->controller->getControllerName().'/'.$this->controller->getActionName();
		}	
		ob_start();
		
		include($this->layout);
		$view_data = ob_get_clean();
		echo $view_data;
	}	
}	

?>
