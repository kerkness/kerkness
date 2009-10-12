<?php defined('SYSPATH') or die('No direct script access.');

class Kerk
{
	public static function error($message='', $class='field_error', array $attributes = NULL )
	{
		if( empty($attributes['class']) )
		{
			$attributes['class'] = $class;
		}
		return '<span'.HTML::attributes($attributes).'>'.$message.'</span>';
		
	}
}