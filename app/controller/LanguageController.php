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
		
		
	}
	
	public function addAction()
	{
		
		//header('content-type: appliaction:json');
		//echo json_encode(array('title' => 'Hello World Add'));
		//exit;
	}	
}	

?>
