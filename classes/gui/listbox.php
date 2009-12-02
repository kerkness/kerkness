<?php defined('SYSPATH') or die('No direct script access.');
/**
 */
class Gui_Listbox extends Gui_Control 
{
	
	/**
	 */
	public static function factory( $name, $data=array(), $selected=NULL, $attributes = array() )
	{
		return new Gui_Listbox($name, $data, $selected, $attributes);
	}


	// Array of local variables
	//protected $_data = array();
	public $attributes = array();
	public $name;
	public $selected;

	/**
	 */
	public function __construct( $name, $data=array(), $selected=NULL, $attributes = array() )
	{		
		if ( $data !== NULL)
		{
			$this->_data = array_merge( $this->_data, $data );
		}
				
		$this->attributes = $attributes;
		$this->name = $name;
		$this->selected = $selected;
	}

	/**
	 * Magic method, returns the output of render(). If any exceptions are
	 * thrown, the exception output will be returned instead.
	 *
	 * @return  string
	 */
	public function __toString()
	{
		try
		{
			return $this->render();
		}
		catch (Exception $e)
		{
			// Display the exception message
			Kohana::exception_handler($e);

			return '';
		}
	}

	/**
	 * @param   string   variable name or an array of variables
	 * @param   mixed    value
	 * @return  Tabs
	 */
	public function set($key, $value = NULL)
	{
		$this->_data[$key] = $value;
		return $this;
	}

	/**
	 * Assigns a value by reference. The benefit of binding is that values can
	 * be altered without re-setting them. It is also possible to bind variables
	 * before they have values. Assigned values will be available as a
	 * variable within the Tabs file:
	 *
	 *     // This reference can be accessed as $ref within the Tabs
	 *     $Tabs->bind('ref', $bar);
	 *
	 * @param   string   variable name
	 * @param   mixed    referenced variable
	 * @return  Tabs
	 */
	public function bind($key, & $value)
	{
		$this->_data[$key] =& $value;

		return $this;
	}

	/**
	 * Renders the Tabs object to a string. 
	 * 
	 * @return   string
	 */
	public function render()
	{
		if( ! isset($this->attributes['size']))
		{
			$this->attributes['size'] = count( $this->_data );
		}
		if( ! isset($this->attributes['id']))
		{
			$this->attributes['id'] = $this->name;
		}
		
		return Form::select($this->name, $this->_data, $this->selected, $this->attributes);
	}

} // End Tabs
