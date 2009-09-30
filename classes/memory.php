<?php defined('SYSPATH') or die('No direct script access.');

class Memory
{
	public static function key( $key, $default=NULL )
	{
		$uri = Request::instance()->uri();
		
		// check $_GET array for key set 
		if ( isset($_GET[$key]) )
		{
			$value = $_GET[$key];
		}
		// check $_POST array for key set
		if ( isset($_POST[$key]) )
		{
			$value = $_POST[$key];
		}
		// if not set in _GET or _POST
		if( ! isset($_GET[$key]) AND ! isset($_POST[$key]))
		{
			// check if set in _SESSION
			if( Session::instance()->get($uri.'-'.$key) )
			{
				$value = Session::instance()->get($uri.'-'.$key);
			}
			else // Set default value
			{
				$value = $default;
			}
		}
		// Set _SESSION
		Session::instance()->set($uri.'-'.$key, $value);
		
		// Return Value
		return $value;
	}
}
