<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Mvc;
use SimpleFw\Core;

use SimpleFw\Core\Database\Database;

class Model
{
	public $db;
	
	public function __construct()
	{
		//require_once(DOC_ROOT.'/config/app.php');
		$app_conf = parse_ini_file(DOC_ROOT.'/config/app.ini', true);
		$db_info = $app_conf['DB'];
		$this->db =  new Database($db_info['driver'].'://'.$db_info['username'].':'.$db_info['password'].'@'.$db_info['host'].'/'.$db_info['database']);
	}
	
}	
