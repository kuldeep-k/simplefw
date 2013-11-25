<?php
/**
 * SimpleFw Framework
 *
 * @copyright Copyright (c) 2013 Kuldeep Kamboj
 * @license   New BSD License
 */

namespace SimpleFw\Core\Tools;

class Tool
{
	public static function returnFormattedDebugTrace($e)
	{
		
		$e_message = '<fieldset><div class="exception-block">';
		
		$e_message .= '<div class="main">Uncaught Exception : '.$e->getMessage().'</div>';
		
		$trace_array = explode('#', $e->getTraceAsString());

		foreach($trace_array as $trace_str)
		{
			$e_message .= '<div class="follow">#'.$trace_str.'</div>';
		}	
		$e_message .= '</div></fieldset>';
		return $e_message;
	}
	
}	

