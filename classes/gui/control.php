<?php 

class Gui_Control
{
	protected $_data = array();
	protected $_options = array();

	public $name = '';
	public $attributes = array();
	
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
	
	public function get_option($key=NULL, $default=NULL)
	{
		return Arr::get($this->_options, $key, $default);
	}
	
}

