<?php defined('SYSPATH') or die('No direct script access.');
/**
 */
class Gui_Searchbox extends Gui_Control 
{
	
	/**
	 */
	public static function factory( $name, $model, array $search_fields = NULL, array $options = NULL )
	{
		return new Gui_Searchbox($name, $model, $search_fields, $options);
	}

	// Array of local variables
	protected $_name;
	protected $_model;	// expects a Sprig model
	protected $_search_fields = array();
	protected $_search_string;
	protected $_results = array();

	/**
	 */
	public function __construct($name, $model, array $search_fields = NULL, array $options = NULL)
	{	
		$this->_name = $name;
		$this->_model = $model;
		$this->_search_fields = $search_fields;
		$this->_options = $options;
		
		if( ! isset($this->_options['attributes']) OR ! isset($this->_options['attributes']['id']) )
		{
			$this->_options['attributes']['id'] = $name;
		}
		if( ! isset($this->_options['result_box_attributes']) 
			OR ! isset($this->_options['result_box_attributes']['id']))
		{
			$this->_options['result_box_attributes']['id'] = $name.'_result_box';
		}
		if( ! isset($this->_options['search_field_attributes']) 
			OR ! isset($this->_options['search_field_attributes']['id']))
		{
			$this->_options['search_field_attributes']['id'] = $name.'_search_field';
		}
		if( ! isset($this->_options['search_button_attributes']) 
			OR ! isset($this->_options['search_button_attributes']['id']))
		{
			$this->_options['search_button_attributes']['id'] = $name.'_search_button';
		}
	}
	
	public function search($search_string=NULL, $as_object = NULL)
	{
		
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
	 * Renders the Searchbox object to a string. 
	 * 
	 * @return   string
	 */
	public function render()
	{
		$elements[] = '<div '.Html::attributes($this->get_option('attributes')).'>';
		$elements[] = Form::input($this->_name.'_searchbox_string', $this->_search_string, $this->get_option('search_field_attributes') );
		$elements[] = Form::button($this->_name.'_searchbox_string', $this->get_option('search_button_label', __('Search')), $this->get_option('search_button_attributes') );
		$elements[] = '<div '.Html::attributes($this->get_option('result_box_attributes')).'>';
		$elements[] = '</div>';
		
		return "\n".implode("\n", $elements)."\n";
	}

} // End Tabs
