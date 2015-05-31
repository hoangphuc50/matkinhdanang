<?php

class ManageMenuKinhController extends \BaseController {

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

		$query = MenuKinh::query();

		//Sortting
		$allowed_columns = ['name', 'id','state','highlight','menu_kinh_type']; 
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id'; 
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc'; 

		//Excute query
		if($query_string != '') {
			$query = $query->whereRaw($query_string, $query_params);
		}

		$query = $query->orderBy($sort, $order);
		$menu_kinhs = $query->paginate($per_page);

		return View::make('backend.menu_kinh.index',compact('menu_kinhs'));

	}

	public function getAdd(){
		return View::make('backend.menu_kinh.create_edit');
	}

	public function postAdd(){
		$rules = array(
		    'name' => 'required',
		    'image' => 'image',
		    'order' => 'numeric'
		);

		$validator = Validator::make(Input::all(), $rules);

		
		if ($validator->fails()) {
		    return Redirect::to('admin/menu_kinhs/add')
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {

			$menu_kinh = new MenuKinh;
			$menu_kinh->name = Input::get('name');
			$menu_kinh->link = Input::get('link');
			$menu_kinh->order = Input::get('order');
			$menu_kinh->state = Input::get('state');
			$menu_kinh->highlight = Input::get('highlight');

			if(Input::hasFile('image')){
				$menu_kinh->image = uploadPhoto('uploads/menu_kinh',Input::file('image'),800);
			}
			
			$menu_kinh->save();

			return Redirect::to('admin/menu_kinhs')->with('success_message', 'Đã tạo mới một menu');
		}
	}

	public function getEdit($id){
		$menu_kinh = MenuKinh::find($id);
		if(empty($menu_kinh)){return Redirect::to('admin/menu_kinhs')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.menu_kinh.create_edit',compact('menu_kinh'));
	}

	public function postEdit(){
		$menu_kinh = MenuKinh::find(Input::get('id'));

		$rules = array(
		    'name' => 'required',
		    'image' => 'image',
		    'order' => 'numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('admin/menu_kinhs/edit/'.$menu_kinh->id)
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {
			$menu_kinh->name = Input::get('name');
			$menu_kinh->link = Input::get('link');
			$menu_kinh->order = Input::get('order');
			$menu_kinh->state = Input::get('state');
			$menu_kinh->highlight = Input::get('highlight');


			//Check delete image
			if(Input::hasFile('image')){
				if(!empty($menu_kinh->image))
				{
					File::delete(kinhImageFolder().$menu_kinh->image);
				}
				$menu_kinh->image = uploadPhoto('uploads/menu_kinh',Input::file('image'),800);
			}

			$menu_kinh->save();

			return Redirect::to('admin/menu_kinhs')->with('success_message', 'Thông tin danh mục đã được thay đổi');
		}
	}	

	public function getDetail($id){
		$menu_kinh = MenuKinh::find($id);
		if(empty($menu_kinh)){return Redirect::to('admin/menu_kinhs')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.menu_kinh.detail',compact('menu_kinh'));
	}

	public function getDelete($id){
		$menu_kinh = MenuKinh::find($id);
		if(empty($menu_kinh)){return Redirect::to('admin/menu_kinhs')->with('error_message', 'Dữ liệu không tồn tại');}
		if(!empty($menu_kinh->image))
		{
			File::delete(kinhImageFolder().$menu_kinh->image);
		}
		$menu_kinh->delete();
		return Redirect::to('admin/menu_kinhs')->with('success_message', 'Dữ liệu đã được xóa.');
	}

}
