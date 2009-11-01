<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Acts as an object wrapper for HTML pages with embedded PHP, called "views".
 * Variables can be assigned with the view object and referenced locally within
 * the view.
 *
 * @package    Kohana
 * @author     Kohana Team
 * @copyright  (c) 2008-2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class Gui_Tabs {
	
	public $attributes = array();

	/**
	 * Returns a new Tabs object.
	 *
	 * @param   object  Tabs object
	 * @param   array   array of values
	 * @return  Tabs
	 */
	public static function factory( $view = NULL, $data = array(), $attributes = array() )
	{
		return new Gui_Tabs($view, $data, $attributes);
	}


	// Array of local variables
	protected $_data = array();
	protected $_data_attributes = array();
	protected $_attributes = array();
	protected $_view = '';

	/**
	 * Sets the initial Tabs filename and local data.
	 *
	 * @param   string  Tabs filename
	 * @param   array   array of values
	 * @return  void
	 */
	public function __construct($view = NULL, $data = array(), $attributes = array())
	{		
		if ($view !== NULL)
		{
			$this->_view = $view;
		}

		if ( $data !== NULL)
		{
			$this->_data = array_merge( $this->_data, $data );
		}
		
		if( $attributes != NULL )
		{
			$this->_attributes = $attrbutes;
		}
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
	public function set($key, $value = NULL, array $attributes = NULL )
	{
		if (is_array($key))
		{
			foreach ($key as $name => $value)
			{
				$this->_data[$name] = $value;
			}
		}
		else
		{
			$this->_data[$key] = $value;
			
			if ( $attributes )
			{
				$this->_data_attributes[$key] = $attributes;
			}
		}

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
	 * Renders the Tabs object to a string. Global and local data are merged
	 * and extracted to create local variables within the Tabs file.
	 *
	 * Note: Global variables with the same key name as local variables will be
	 * overwritten by the local variable.
	 *
	 * @throws   Tabs_Exception
	 * @param    Tabs filename
	 * @return   string
	 */
	public function render($file = NULL)
	{
		$items = array();
		
		foreach( $this->_data as $url=>$label)
		{
			if( isset($this->_data_attributes[$url]) )
			{
				$option = $this->_data_attributes[$url];
			}
			else 
			{
				$option = array();
			}
			
			// Sanitize the option title
			$title = htmlspecialchars($label, ENT_NOQUOTES, Kohana::$charset, FALSE);

			// Change the option to the HTML string
			$items[$url] = '<li'.HTML::attributes($option).'>'.HTML::anchor($url, $title).'</li>';
		}
		
		// Compile the options into a single string
		$options = "\n".implode("\n", $items)."\n";
		
		return '<ul'.HTML::attributes($this->attributes).'>'.$options.'</ul>';
		
	}

} // End Tabs
