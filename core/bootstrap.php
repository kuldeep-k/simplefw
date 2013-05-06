<?php

namespace SimpleFw\Core;
use SimpleFw\Core\Mvc\View;
use SimpleFw\Core\Http\Request;
use SimpleFw\Core\Router\Router;
use SimpleFw\Core\Router\RouteException;

//require_once(DOC_ROOT.'/core/Controller.php');
//require_once(DOC_ROOT.'/core/Router.php');
//require_once(DOC_ROOT.'/core/Database.php');
//require_once(DOC_ROOT.'/core/View.php');

//use 

try
{
	set_exception_handler( function ($exception) {
		  echo "Uncaught exception: " , $exception->getMessage(), "\n";
		}
	);
	$registered_ns = array('SimpleFw\App\Controller' => 'app\controllers',
			'SimpleFw\App\Model'=> 'app\models');
	spl_autoload_register(function ($class_name) {
		//echo $class_name;
		//echo ' --- ';
		$class_name_path = str_replace("\\", "/", str_replace("SimpleFw\\", "", $class_name));
		//echo ' --- ';
		$class_name_path .= '.php';
		$class_file_dir = strtolower(dirname($class_name_path));
		//echo ' --- ';
		$class_file_name = basename($class_name_path);
		
		//echo $class_name.' - ';
		//echo $class_file_dir.'/'.$class_file_name;
		require_once('../'.$class_file_dir.'/'.$class_file_name);
	});

	//$current_uri = $_SERVER['REQUEST_URI'];
	
	//$router = new Router($current_uri);
	
	$request = Request::getInstance();
	
	$request->setRouter(new Router($_SERVER['REQUEST_URI']));
	
	if(!$request->getRouter()->parse())
	{
		throw new RouteException(Router::ERR_ROUTE_NOT_EXISTS);
	}	
		
	if(!$request->getController())
	{
		throw new RouteException(Router::ERR_CONTROLLER_NOT_EXISTS);
	}
	
	//$controller_object = $request->getRequest();
	
	$controller_object = $request->getController();
	
	//$view = new View();
	
	//$controller_object->setView($view);		

	if(!$request->getAction())
	{
		throw new RouteException(Router::ERR_ACTION_NOT_EXISTS);
	}
	
	//$controller_object->getRequest()->setQuery($router->getQuery());
	$content = call_user_func(array($controller_object, $request->getAction()));
	
	if($controller_object->getTemplate() != false)
	{
		//$controller_object->getView()->render($content);
		$view = new View();
		$view->inject($controller_object);
		$result = $view->render($content);
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
