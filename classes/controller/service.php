<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Service extends Controller 
{
	public function __construct(Request $request)
	{
		parent::__construct($request);

		if ( ! Request::$is_ajax )
		{
			$this->request->action = 'invalid';
		}
	}
	
	public function action_invalid()
	{
		$this->request->response = json_encode(array(
			'error'=>TRUE,
			'message'=>__('Invalid Request')
		));
	}
	
}