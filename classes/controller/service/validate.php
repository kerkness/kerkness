<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Service_Validate extends Controller_Service
{
	public $model;
	
	public function __construct(Request $request)
	{
		parent::__construct($request);
		$this->model = Sprig::factory($this->model);
	}
	
	public function action_validate()
	{
		$response = array('error'=>FALSE);
		$arr = array();
		
		try 
		{
			$this->model->values($_POST)->check( $_POST );
		}
		catch ( Validate_Exception $e )
		{
			$arr = $e->array->errors($this->model.'/crud');	
		}
		
		if( $arr )
		{
			$response = array(
				'error' => TRUE,
				'message' => __("Invalid $this->model"),
				'errors' => $arr,
			);
		}
		
		$this->request->response = json_encode($response);
	}
}