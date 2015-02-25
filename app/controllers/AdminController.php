<?php

class AdminController extends \BaseController {
	public function __construct()
    {
        $this->beforeFilter('auth', array('except'=>array('getLogin','postLogin')));
        $this->beforeFilter('auth.admin', array('except'=>array('getLogin','postLogin')));
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		return View::make('backend.index');
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('admin/login')
				->with('message', 'Bạn đã đăng xuất thành công');
	}

	public function getLogin()
	{
		return View::make('backend.account.login');
	}

	public function postLogin()
	{
		$rules = array(
		    'email'=>'required',
		    'password'=>'required|alphaNum|min:3'
		);

		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return Redirect::to('admin/login')
		        ->withErrors($validator)
		        ->withInput(Input::except('password'));
		} else {
			if (Auth::attempt(array('email'=>Input::get('email'), 'password'=>Input::get('password')),$remember = Input::get('remember') )) {		    		    
			    // Check if active account
			    if(Auth::user()->state != 1 or Auth::user()->user_type != "admin"){
			    	Auth::logout();
			    	return Redirect::to('admin/login')
				        ->with('error_message', 'Your account was disabled')
				        ->withInput();
			    }  

			    return Redirect::to('admin')->with('message', 'You are now logged in!');
			} 
			else {
			    return Redirect::to('admin/login')
			        ->with('message', 'Your email/password combination was incorrect')
			        ->withInput();
			}
		}
	}

}
