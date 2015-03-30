<?php

class ManageProducerController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		//Declare query and params
		$search = Input::get('search');
		$option = Input::get('option');
		$per_page = Input::get('per_page') > 15 ? Input::get('per_page') : 15;

		$query_string = "";
		$query_params = array();

		//Search with option
		if(!empty($search)){
			switch ($option) {
			    case "name":
			        $query_string .= ($query_string == '') ? " name LIKE ? " : " AND name LIKE ?";
					$query_params[] = '%'.$search.'%';
			        break;
			    default:
			        $query_string .= ($query_string == '') ? " name LIKE ? " : " AND name LIKE ?";
					$query_params[] = '%'.$search.'%';
			}
		}

		$query = Producer::query();

		//Sortting
		$allowed_columns = ['name', 'id']; 
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id'; 
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc'; 

		//Excute query
		if($query_string != '') {
			$query = $query->whereRaw($query_string, $query_params);
		}

		$query = $query->orderBy($sort, $order);
		$producers = $query->paginate($per_page);

		return View::make('backend.producer.index',compact('producers'));

	}

	public function getAdd(){
		return View::make('backend.producer.create_edit');
	}

	public function postAdd(){
		$rules = array(
		    'name' => 'required',
		);

		$validator = Validator::make(Input::all(), $rules);

		
		if ($validator->fails()) {
		    return Redirect::to('admin/producers/add')
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {
			$producer = new Producer;
			$producer->name = Input::get('name');
			$producer->description = Input::get('description');
			$producer->content = Input::get('content');

			$producer->content = uploadPhoto('uploads/producer','image',800);

			$producer->save();

			return Redirect::to('admin/producers')->with('message', 'Đã tạo mới một nhà sản xuất');
		}
	}

}
