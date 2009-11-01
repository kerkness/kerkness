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
	
	
	/**
	 * Creates a select form input.
	 *
	 * @param   string   list id
	 * @param   array    available list items
	 * @param   string   current item
	 * @param   array    html attributes
	 * @return  string
	 */
	public static function ul($id, array $items = NULL, $current = NULL, array $attributes = NULL)
	{
		// Set the input name
		$attributes['id'] = $id;

		if (empty($items))
		{
			// There are no options
			$options = '';
		}
		else
		{
			foreach ($items as $value => $name)
			{
				if (is_array($name))
				{
					// Create a new optgroup
					$group = array('id' => $id.'-'.$value);

					// Create a new list of options
					$_options = array();

					foreach ($name as $_value => $_name)
					{
						$option = array();
						
						if ($_value == $current)
						{
							// This option is selected
							if( isset($option['class']) )
							{
								$option['class'] .= ' current-tab';
							}
							else 
							{
								$option['class'] = 'current-tab';	
							}
						}

						// Sanitize the option title
						$title = htmlspecialchars($_name, ENT_NOQUOTES, Kohana::$charset, FALSE);

						// Change the option to the HTML string
						$_options[] = '<li'.HTML::attributes($option).'>'.HTML::anchor($_value,$title).'</li>';
					}

					// Compile the options into a string
					$_options = "\n".implode("\n", $_options)."\n";

					$options[] = '<ul'.HTML::attributes($group).'>'.$_options.'</ul>';
				}
				else
				{
					$option = array();
					
					if ($value == $current)
					{
						// This option is selected
						if( isset($option['class']) )
						{
							$option['class'] .= ' current-tab';
						}
						else 
						{
							$option['class'] = 'current-tab';	
						}
					}

					// Sanitize the option title
					$title = htmlspecialchars($name, ENT_NOQUOTES, Kohana::$charset, FALSE);

					// Change the option to the HTML string
					$options[$value] = '<li'.HTML::attributes($option).'>'.HTML::anchor($value, $title).'</li>';
				}
			}

			// Compile the options into a single string
			$options = "\n".implode("\n", $options)."\n";
		}

		return '<ul'.HTML::attributes($attributes).'>'.$options.'</ul>';
	}
	
}