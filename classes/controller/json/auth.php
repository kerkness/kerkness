<?php 

/**
 * Controller for providing authenticated web service 
 * requests that are expecting a JSON response.
 * 
 * I use a Sprig model ( github.com/shadowhand/sprig )
 * for authentication. The 'user' cookie is not set
 * by this class.
 * 
 */

class Controller_Json_Auth extends Controller 
{
	public function __construct(Request $request)
	{
		parent::__construct($request);

		if ($id = Cookie::get('user'))
		{
			$user = Sprig::factory('user')
				->values(array('id' => $id))
				->load();

			if ($user->loaded())
			{
				// User is logged in
				$this->user = $user;
			}
		}

		if (! $this->user OR ! Request::$is_ajax )
		{
			// Redirect to the login page
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