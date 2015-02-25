<?php

class ManageProducerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$producers = Producer::orderBy('id', 'DESC')->paginate(15);
		return View::make('backend.producer.index',compact('producers'));
	}

}
