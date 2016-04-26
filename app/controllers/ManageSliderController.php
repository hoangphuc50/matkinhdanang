<?php

class ManageSliderController extends \BaseController {
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

		$query = Slider::query();

		//Sortting
		$allowed_columns = ['name', 'id','state','highlight','position']; 
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id'; 
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc'; 

		//Excute query
		if($query_string != '') {
			$query = $query->whereRaw($query_string, $query_params);
		}

		$query = $query->orderBy($sort, $order);
		$sliders = $query->paginate($per_page);

		return View::make('backend.slider.index',compact('sliders'));

	}

	public function getAdd(){
		return View::make('backend.slider.create_edit');
	}

	public function postAdd(){
		$rules = array(
		    'image' => 'image',
		    'order' => 'numeric'
		);

		$validator = Validator::make(Input::all(), $rules);

		
		if ($validator->fails()) {
		    return Redirect::to('admin/sliders/add')
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {

			$slider = new Slider;
			$slider->name = Input::get('name');
			$slider->link = Input::get('link');
			$slider->order = Input::get('order');
			$slider->state = Input::get('state');
			$slider->highlight = Input::get('highlight');

			$slider->description = Input::get('description');
			$slider->position = Input::get('position');

			if(Input::hasFile('image')){
				$slider->image = uploadPhoto('uploads/slider',Input::file('image'),1200);
			}
			
			$slider->save();

			return Redirect::to('admin/sliders')->with('success_message', 'Đã tạo mới một menu');
		}
	}

	public function getEdit($id){
		$slider = Slider::find($id);
		if(empty($slider)){return Redirect::to('admin/sliders')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.slider.create_edit',compact('slider'));
	}

	public function postEdit(){
		$slider = Slider::find(Input::get('id'));

		$rules = array(
		    'name' => 'required',
		    'image' => 'image',
		    'order' => 'numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('admin/sliders/edit/'.$slider->id)
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {
			$slider->name = Input::get('name');
			$slider->link = Input::get('link');
			$slider->order = Input::get('order');
			$slider->state = Input::get('state');
			$slider->highlight = Input::get('highlight');

			$slider->description = Input::get('description');
			$slider->position = Input::get('position');
			//Check delete image
			if(Input::hasFile('image')){
				if(!empty($slider->image))
				{
					File::delete(kinhImageFolder().$slider->image);
				}
				$slider->image = uploadPhoto('uploads/slider',Input::file('image'),800);
			}

			$slider->save();

			return Redirect::to('admin/sliders')->with('success_message', 'Thông tin danh mục đã được thay đổi');
		}
	}	

	public function getDetail($id){
		$slider = Slider::find($id);
		if(empty($slider)){return Redirect::to('admin/sliders')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.slider.detail',compact('slider'));
	}

	public function getDelete($id){
		$slider = Slider::find($id);
		if(empty($slider)){return Redirect::to('admin/sliders')->with('error_message', 'Dữ liệu không tồn tại');}
		if(!empty($slider->image))
		{
			File::delete(kinhImageFolder().$slider->image);
		}
		$slider->delete();
		return Redirect::to('admin/sliders')->with('success_message', 'Dữ liệu đã được xóa.');
	}

}
