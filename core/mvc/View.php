<?php

namespace SimpleFw\Core\Mvc;

class ViewNotFoundException extends Exception {}

class View
{
	public $controller; 	
	public function inject($controller)
	{
		$this->controller = $controller;
		
		if($this->controller->getTemplate() != false)
		{
			if(is_null($this->controller->getTemplate()))
			{
				$this->controller->setTemplate($this->controller->getControllerName().'/'.$this->controller->setActionName());
			}
			$this->template = '../app/views/templates/'.$this->controller->getTemplate().'.php';
			
			if(!file_exists($this->template))
			{
				throw new ViewNotFoundException();
			}
		}	


		if($this->controller->getLayout() != false)
		{
			if(is_null($this->controller->getLayout()))
			{
				$this->controller->setLayout('layout');
			}
			$this->layout = '../app/views/layouts/'.$this->controller->getLayout().'.php';
			
			if(!file_exists($this->layout))
			{
				throw new ViewNotFoundException();
			}
		}	
		
	}	
	public function render()
	{
		$data = $this->controller->getViewParams();
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
