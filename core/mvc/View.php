<?php

namespace SimpleFw\Core\Mvc;
use SimpleFw\Core\Mvc\Exception;
use SimpleFw\Core\Tools\Helper;

class View
{
	public $controller; 	
	public $template; 	
	public $layout;
	public $page;
	
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
				throw new ViewNotFoundException();
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
		ob_start();
		
		include($this->template);
		$content = ob_get_clean();
		//echo $content;
		
		ob_start();
		include($this->layout);
		$view_data = ob_get_clean();
		echo $view_data;
	}	
}	

?>
