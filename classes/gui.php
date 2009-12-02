<?php defined('SYSPATH') or die('No direct script access.');
/**
 * 
 */
class Gui
{
	public static function tabs($data = array(), $attributes = array())
	{
		return Gui_Tabs::factory($data, $attributes);
	}
	
	public static function listbox($name, $data=array(), $selected=NULL, $attributes = array())
	{
		return Gui_Listbox::factory($name, $data, $selected, $attributes);
	}

	public static function searchbox( $name, $model, array $search_fields = NULL, array $options = NULL)
	{
		return Gui_Searchbox::factory($name, $model, $search_fields, $options);
	}
	
	public static function tiles($name, array $data = NULL, $renderer = NULL)
	{
		return Gui_Tiles::factory($name, $data, $renderer);
	}
}