<?php

class ManageUserController extends \BaseController {

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

		$query = User::query();

		//Sortting
		$allowed_columns = ['name', 'id','email','state']; 
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id'; 
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc'; 

		//Excute query
		if($query_string != '') {
			$query = $query->whereRaw($query_string, $query_params);
		}

		$query = $query->where('user_type','!=','admin')->orderBy($sort, $order);
		$users = $query->paginate($per_page);

		return View::make('backend.user.index',compact('users'));

	}

	public function getAdd(){
		return View::make('backend.user.create_edit');
	}

	public function postAdd(){
		$rules = array(
		    'username'=>'required|unique:users',
		    'email'=>'required|email|unique:users',
			'password' => 'required|min:6|confirmed',
			'password_confirmation'=>'required|min:6|same:password',
		);

		$validator = Validator::make(Input::all(), $rules);

		
		if ($validator->fails()) {
		    return Redirect::to('admin/users/add')
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {

			$user = new User;
			$user->username = Input::get('username');
			$user->email = Input::get('email');
			$user->name = Input::get('name');
			$user->password = Hash::make(Input::get('password'));
			$user->state = Input::get('state');
			$user->user_type = 'manager';
			$user->save();

			return Redirect::to('admin/users')->with('success_message', 'Đã tạo mới một người dùng');
		}
	}

	public function getEdit($id){
		$user = User::find($id);
		if(empty($user)){return Redirect::to('admin/users')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.user.create_edit',compact('user'));
	}

	public function postEdit(){
		$user = User::find(Input::get('id'));

		$rules = array(
		    'username'=>'required|unique:users,username,'.$user->id,
		    'email'=>'required|email|unique:users,email,'.$user->id,
			'password' => 'min:6|confirmed',
			'password_confirmation'=>'min:6|same:password',
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('admin/users/edit/'.$user->id)
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {
			$user->username = Input::get('username');
			$user->email = Input::get('email');
			$user->name = Input::get('name');
			$user->password = Hash::make(Input::get('password'));
			$user->state = Input::get('state');
			$user->save();

			return Redirect::to('admin/users')->with('success_message', 'Thông tin người dùng đã được thay đổi');
		}
	}	

	public function getDetail($id){
		$user = User::find($id);
		if(empty($user)){return Redirect::to('admin/users')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.user.detail',compact('user'));
	}

	public function getDelete($id){
		$user = User::find($id);
		if(empty($user)){return Redirect::to('admin/users')->with('error_message', 'Dữ liệu không tồn tại');}
		if(!empty($user->image))
		{
			File::delete($user->image);
		}
		$user->delete();
		return Redirect::to('admin/users')->with('success_message', 'Dữ liệu đã được xóa.');
	}

}
