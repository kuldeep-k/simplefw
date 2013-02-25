<?php

namespace SimpleFw\Core;

use SimpleFw\Core\Router\Router;
use SimpleFw\Core\Database\Database;
//require_once(DOC_ROOT.'/core/Controller.php');
//require_once(DOC_ROOT.'/core/Router.php');
//require_once(DOC_ROOT.'/core/Database.php');
//require_once(DOC_ROOT.'/core/View.php');

//use 

try
{

	spl_autoload_register(function ($class_name){
		$class_name_path = str_replace("\\", "/", str_replace("SimpleFw\\", "", $class_name));
		$class_name_path .= '.php';
		$class_file_dir = strtolower(dirname($class_name_path));
		$class_file_name = basename($class_name_path);
		//echo '<br />';
		//echo $class_name.' - ';
		//echo $class_file_dir.'/'.$class_file_name;
		include('../'.$class_file_dir.'/'.$class_file_name);
	});

	$current_uri = $_SERVER['REQUEST_URI'];
	
	$router = new Router($current_uri);
	
	if(!$router->parse($current_uri))
	{
		throw new RouteException(Router::ERR_ROUTE_NOT_EXISTS);
	}	
		
	if(!$router->getController())
	{
		throw new RouteException(Router::ERR_CONTROLLER_NOT_EXISTS);
	}
	$controller_object = $router->getController();
	
	//$view = new View();
	
	//$controller_object->setView($view);		

	if(!$router->getAction())
	{
		throw new RouteException(Router::ERR_ACTION_NOT_EXISTS);
	}
	//echo 'hello';
	$db =  new Database('mysqli://root:root@localhost/prog_lang');
	$controller_object->setQuery($router->getQuery());
	$content = call_user_func(array($controller_object, $router->getAction()));
	
	if($controller_object->getTemplate() != false)
	{
		//$controller_object->getView()->render($content);
		$view = new View();
		$result = $view->inject($controller_object)->render();
	}		
		

}
catch(RouteException $e)
{
	echo $e->getMessage();
	die('Route not found.');
}	
catch(Exception $e)
{
	die('Server Error.');
}


	
?>
