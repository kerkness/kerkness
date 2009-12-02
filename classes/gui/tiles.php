<?php 

class Gui_Tiles extends Gui_Control
{

	public static function factory($name, array $data = NULL, $renderer = NULL, $cols = 5, $options = array() )
	{
		return new Gui_Tiles($name, $data, $renderer, $cols, $options);
	}
	
	protected $_renderer;
	public $columns;
	
	public function __construct($name, array $data = NULL, $renderer = NULL, $cols = 5, $options = array() ) 
	{
		$this->_data = $data;
		$this->_renderer = $renderer;	
		$this->name = $name;
		$this->cols = $cols;
		$this->_options = $options;
	}
	
	public function render()
	{
		$elements[] = '<div '.Html::attributes($this->get_option('attributes')).'>';
		
		$col_count = 0;
		foreach($this->_data AS $key=>$item)
		{
			$col_count++;
			
			$elements[] = View::factory($this->_renderer, $item)->render();
			
			if( $col_count == $this->cols )
			{
				$elements[] = '<div style="clear:both;"></div>';
				$col_count = 0;
			}
		}
		
		$elements[] = '</div>';
		$elements[] = '<div style="clear:both;"></div>';
		
		return "\n".implode("\n", $elements)."\n";
	}
}