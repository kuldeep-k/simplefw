<?php

namespace SimpleFw\App\Controller;

use SimpleFw\Core\Mvc\Controller;
use SimpleFw\App\Model\LanguageModel;

class LanguageController extends Controller
{
	public function listAction()
	{
		$language = new LanguageModel();
		
		$langauges = $language->getLanguages();
		
		return array('languages' => $langauges);
		
		//echo 'Hello World';
	}
	
	public function addAction()
	{
		echo 'Hello World Add';
	}	
}	

?>
