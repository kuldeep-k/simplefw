<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core;

return array (
	'default' => array(
		'pattern' => '([a-zA-Z]+)\/([a-zA-Z]+)(\/)?',
		'controller' => '$1',
		'action' => '$2',
	),
	/*'pretty' => array(
		'pattern' => '([a-zA-Z]+)\/([a-zA-Z]+)\.html',
		'controller' => '$1',
		'action' => '$2',
	),*/
);

?>
