<?php

namespace SimpleFw\Core;
use SimpleFw\Core\Mvc\View;
use SimpleFw\Core\Http\Request;
use SimpleFw\Core\Router\Router;
use SimpleFw\Core\Router\RouteException;
use SimpleFw\Core\Tools\Tool;


try
{
	set_exception_handler( function ($exception) {
			if(APP_ENV == 'dev')
			{
				echo Tool::returnFormattedDebugTrace($exception);
			}
			else if(APP_ENV == 'prod')
			{
				echo "Uncaught exception: " , $exception->getMessage(), "\n";
			}	
				
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
		//echo $class_file_dir.'/'.$class_file_name.'<br/>';
		require_once('../'.$class_file_dir.'/'.$class_file_name);
	});

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
	
	$controller_object = $request->getController();
	
	if(!$request->getAction())
	{
		throw new RouteException(Router::ERR_ACTION_NOT_EXISTS);
	}
	
	$content = call_user_func(array($controller_object, $request->getAction()));
	
	if($controller_object->getTemplate() != false)
	{
		$view = new View();
		$view->inject($controller_object);
		$result = $view->render($content);
	}		
}
catch(Exception $e)
{
	die('Server Error.');
}


	
?>
