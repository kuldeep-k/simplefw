<?php

namespace SimpleFw\App\Controller;

use SimpleFw\Core\Mvc\Controller;
use SimpleFw\Core\Http\Request;
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
		if(Request::getInstance()->hasPost())
		{
			$post_data = Request::getInstance()->getPost();
			unset($post_data['submit']);
			$language = new LanguageModel();
			$language->insert($post_data);
			$this->redirect('language/list');
		}		
	}	
	
	public function editAction()
	{
		if(Request::getInstance()->hasPost())
		{
			$post_data = Request::getInstance()->getPost();
			unset($post_data['submit']);
			$language = new LanguageModel();
			$language->update($post_data, array('id' => $post_data['id'] ));
			$this->redirect('language/list');
		}
		
		$lang = new LanguageModel();
		$langauge = $lang->getLanguage((int)$_GET['id']);
		
		return array('language' => $langauge);				
	}	
	
	public function deleteAction()
	{
		$language = new LanguageModel();
		$language->delete(array('id' => (int)$_GET['id'] ));
		$this->redirect('language/list');
	}	
}	

?>
