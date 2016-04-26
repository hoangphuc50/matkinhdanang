<?php

class ManageBlockHtmlController extends \BaseController {
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

		$query = BlockHtml::query();

		//Sortting
		$allowed_columns = ['name', 'id','state','highlight','block_html_type']; 
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id'; 
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc'; 

		//Excute query
		if($query_string != '') {
			$query = $query->whereRaw($query_string, $query_params);
		}

		$query = $query->orderBy($sort, $order);
		$block_htmls = $query->paginate($per_page);

		return View::make('backend.block_html.index',compact('block_htmls'));

	}

	public function getAdd(){
		return View::make('backend.block_html.create_edit');
	}

	public function postAdd(){
		$rules = array(
		    'name' => 'required',
		    'image' => 'image',
		    'order' => 'numeric'
		);

		$validator = Validator::make(Input::all(), $rules);

		
		if ($validator->fails()) {
		    return Redirect::to('admin/block_htmls/add')
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {

			$block_html_ = new BlockHtml;
			$block_html_->name = Input::get('name');
			$block_html_->link = Input::get('link');
			$block_html_->order = Input::get('order');
			$block_html_->position = Input::get('position');
			$block_html_->state = Input::get('state');
			$block_html_->highlight = Input::get('highlight');
			$block_html_->content = Input::get('content');

			if(Input::hasFile('image')){
				$block_html_->image = uploadPhoto('uploads/block_html',Input::file('image'),800);
			}
			
			$block_html_->save();

			return Redirect::to('admin/block_htmls')->with('success_message', 'Đã tạo mới một block');
		}
	}

	public function getEdit($id){
		$block_html_ = BlockHtml::find($id);
		if(empty($block_html_)){return Redirect::to('admin/block_htmls')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.block_html.create_edit',compact('block_html_'));
	}

	public function postEdit(){
		$block_html_ = BlockHtml::find(Input::get('id'));

		$rules = array(
		    'name' => 'required',
		    'image' => 'image',
		    'order' => 'numeric'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('admin/block_htmls/edit/'.$block_html_->id)
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {
			$block_html_->name = Input::get('name');
			$block_html_->link = Input::get('link');
			$block_html_->order = Input::get('order');
			$block_html_->position = Input::get('position');
			$block_html_->state = Input::get('state');
			$block_html_->highlight = Input::get('highlight');
			$block_html_->content = Input::get('content');

			//Check delete image
			if(Input::hasFile('image')){
				if(!empty($block_html_->image))
				{
					File::delete(blockImageFolder().$block_html_->image);
				}
				$block_html_->image = uploadPhoto('uploads/block_html',Input::file('image'),800);
			}

			$block_html_->save();

			return Redirect::to('admin/block_htmls')->with('success_message', 'Thông tin danh mục đã được thay đổi');
		}
	}	

	public function getDetail($id){
		$block_html = BlockHtml::find($id);
		if(empty($block_html)){return Redirect::to('admin/block_htmls')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.block_html.detail',compact('block_html'));
	}

	public function getDelete($id){
		$block_html = BlockHtml::find($id);
		if(empty($block_html)){return Redirect::to('admin/block_htmls')->with('error_message', 'Dữ liệu không tồn tại');}
		if(!empty($block_html->image))
		{
			File::delete(blockImageFolder().$block_html->image);
		}
		$block_html->delete();
		return Redirect::to('admin/block_htmls')->with('success_message', 'Dữ liệu đã được xóa.');
	}

}
