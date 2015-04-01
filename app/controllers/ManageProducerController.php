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
		    'image' => 'image'
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
			$producer->image = uploadPhoto('uploads/producer','image',800);
			$producer->save();

			return Redirect::to('admin/producers')->with('success_message', 'Đã tạo mới một nhà sản xuất');
		}
	}

	public function getEdit($id){
		$producer = Producer::find($id);
		if(empty($producer)){return Redirect::to('admin/producers')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.producer.create_edit',compact('producer'));
	}

	public function postEdit(){
		$producer = Producer::find(Input::get('id'));

		$rules = array(
		    'name' => 'required',
		    'image' => 'image'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('admin/producers/edit/'.$producer->id)
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {
			$producer->name = Input::get('name');
			$producer->description = Input::get('description');
			$producer->content = Input::get('content');

			//Check delete image
			if(Input::hasFile('image')){
				if(!empty($producer->image))
				{
					File::delete($producer->image);
				}
				$producer->image = uploadPhoto('uploads/producer','image',800);
			}

			$producer->save();

			return Redirect::to('admin/producers')->with('success_message', 'Thông tin nhà sản xuất đã được thay đổi');
		}
	}	

	public function getDetail($id){
		$producer = Producer::find($id);
		if(empty($producer)){return Redirect::to('admin/producers')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.producer.detail',compact('producer'));
	}

	public function getDelete($id){
		$producer = Producer::find($id);
		if(empty($producer)){return Redirect::to('admin/producers')->with('error_message', 'Dữ liệu không tồn tại');}
		if(!empty($producer->image))
		{
			File::delete($producer->image);
		}
		$producer->delete();
		return Redirect::to('admin/producers')->with('success_message', 'Dữ liệu đã được xóa.');
	}

}
