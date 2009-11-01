<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 */
class Gui
{
	public static function tabs($view = NULL, $data = array(), $attributes = array())
	{
		return Gui_Tabs::factory( $view, $data, $attributes );
	}
}