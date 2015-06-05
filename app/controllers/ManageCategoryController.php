<?php

class ManageCategoryController extends \BaseController {
	public function __construct()
    {
        $this->beforeFilter('auth', array('except'=>''));
    }
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

		$query = Category::query();

		//Sortting
		$allowed_columns = ['name', 'id','state','highlight','category_type']; 
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id'; 
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc'; 

		//Excute query
		if($query_string != '') {
			$query = $query->whereRaw($query_string, $query_params);
		}

		$query = $query->orderBy($sort, $order);
		$categories = $query->paginate($per_page);

		return View::make('backend.category.index',compact('categories'));

	}

	public function getAdd(){
		$categories = Category::tree('all');
		return View::make('backend.category.create_edit',compact('categories'));
	}

	public function postAdd(){
		$rules = array(
		    'name' => 'required',
		    'image' => 'image',
		    'order' => 'numeric'
		);

		$validator = Validator::make(Input::all(), $rules);

		
		if ($validator->fails()) {
		    return Redirect::to('admin/categories/add')
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {

			$category = new Category;
			$category->name = Input::get('name');
			$category->description = Input::get('description');
			$category->short_description = Input::get('short_description');

			$category->state = Input::get('state');
			$category->highlight = Input::get('highlight');
			$category->link = Input::get('link');
			$category->order = Input::get('order');
			$category->category_type = Input::get('category_type');
			$category->parent_id = Input::get('parent_id');

			$category->content = Input::get('content');
			if(Input::hasFile('image')){
				$category->image = uploadPhoto('uploads/category',Input::file('image'),800);
			}
			
			$category->save();

			return Redirect::to('admin/categories')->with('success_message', 'Đã tạo mới một chuyên mục');
		}
	}

	public function getEdit($id){
		$category = Category::find($id);
		$categories = Category::tree();
		if(empty($category)){return Redirect::to('admin/categories')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.category.create_edit',compact('category','categories'));
	}

	public function postEdit(){
		$category = Category::find(Input::get('id'));

		$rules = array(
		    'name' => 'required',
		    'image' => 'image',
		    'order' => 'numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('admin/categories/edit/'.$category->id)
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {
			$category->name = Input::get('name');
			$category->description = Input::get('description');
			$category->short_description = Input::get('short_description');
			$category->order = Input::get('order');
			$category->state = Input::get('state');
			$category->highlight = Input::get('highlight');
			$category->link = Input::get('link');
			$category->category_type = Input::get('category_type');
			$category->parent_id = Input::get('parent_id');
			$category->content = Input::get('content');

			//Check delete image
			if(Input::hasFile('image')){
				if(!empty($category->image))
				{
					File::delete(categoryImageFolder().$category->image);
				}
				$category->image = uploadPhoto('uploads/category',Input::file('image'),800);
			}

			$category->save();

			return Redirect::to('admin/categories')->with('success_message', 'Thông tin danh mục đã được thay đổi');
		}
	}	

	public function getDetail($id){
		$category = Category::find($id);
		if(empty($category)){return Redirect::to('admin/categories')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.category.detail',compact('category'));
	}

	public function getDelete($id){
		$category = Category::find($id);
		if(empty($category)){return Redirect::to('admin/categories')->with('error_message', 'Dữ liệu không tồn tại');}
		if(!empty($category->image))
		{
			File::delete(categoryImageFolder().$category->image);
		}
		$category->delete();
		return Redirect::to('admin/categories')->with('success_message', 'Dữ liệu đã được xóa.');
	}

}
