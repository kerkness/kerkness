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
class Gui_Tabs extends Gui_Control
{
	
	public $attributes = array();

	/**
	 * Returns a new Tabs object.
	 *
	 * @param   object  Tabs object
	 * @param   array   array of values
	 * @return  Tabs
	 */
	public static function factory( $data = array(), $attributes = array() )
	{
		return new Gui_Tabs($data, $attributes);
	}


	// Array of local variables
	protected $_data = array();
	protected $_data_attributes = array();
	protected $_attributes = array();
	protected $_panels = array();
	
	/**
	 * Sets the initial Tabs filename and local data.
	 *
	 * @param   string  Tabs filename
	 * @param   array   array of values
	 * @return  void
	 */
	public function __construct( $data=array(), $attributes = array() )
	{		
		if ( $data !== NULL)
		{
			$this->_data = array_merge( $this->_data, $data );
		}
				
		$this->_attributes = $attributes;
	}

	/**
	 * @param   string   variable name or an array of variables
	 * @param   mixed    value
	 * @return  Tabs
	 */
	public function set($key, $value = NULL, $panel='', array $attributes = NULL )
	{
		$this->_data[$key] = $value;

		$this->_panels[$key] = $panel;
		
		if ( $attributes )
		{
			$this->_data_attributes[$key] = $attributes;
		}
		return $this;
	}

	/**
	 * Renders the Tabs object to a string. 
	 * 
	 * @return   string
	 */
	public function render()
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
			
			$key = str_replace('#','',$url);
			
			$option['gui_tab'] = true;
			$option['gui_key'] = $key;

			// Sanitize the option title
			$title = htmlspecialchars($label, ENT_NOQUOTES, Kohana::$charset, FALSE);

			// Change the option to the HTML string
			$items[$url] = '<li'.HTML::attributes($option).'>'.HTML::anchor($url, $title).'</li>';
			$response[] = Form::hidden($key.'_tabs_panel', $this->_panels[$url], array('gui_tabs_panel'=>$key));
		}
		
		// Compile the options into a single string
		$options = "\n".implode("\n", $items)."\n";
		
		// Add list to response
		$response[] = '<ul'.HTML::attributes($this->_attributes).'>'.$options.'</ul>';
		
		return "\n".implode("\n", $response)."\n";
		
	}

} // End Tabs
