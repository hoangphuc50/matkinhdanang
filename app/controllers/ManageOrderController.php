<?php

class ManageOrderController extends \BaseController {
	public function __construct()
    {
        $this->beforeFilter('auth', array('except'=>''));
    }
	public function getIndex()
	{
		return View::make('backend.index');
	}

}
