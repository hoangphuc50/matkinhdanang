<?php

class ManageBlogController extends \BaseController {

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

		$query = Blog::query();

		//Sortting
		$allowed_columns = ['name', 'id','state','highlight','blog_id']; 
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id'; 
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc'; 

		//Excute query
		if($query_string != '') {
			$query = $query->whereRaw($query_string, $query_params);
		}

		$query = $query->orderBy($sort, $order);
		$blogs = $query->paginate($per_page);

		return View::make('backend.blog.index',compact('blogs'));

	}

	public function getAdd(){
		$categories = Category::tree("menu");
		return View::make('backend.blog.create_edit',compact('categories'));
	}

	public function postAdd(){
		$rules = array(
		    'title' => 'required',
		    'image' => 'image',
		    'category_id' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		
		if ($validator->fails()) {
		    return Redirect::to('admin/blogs/add')
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {

			$blog = new Blog;
			$blog->title = Input::get('title');
			$blog->description = Input::get('description');
			//$blog->user_id = Auth::user()->id();
			$blog->state = Input::get('state');
			$blog->highlight = Input::get('highlight');
			$blog->content = Input::get('content');
			if(Input::hasFile('image')){
				$blog->image = uploadPhoto('uploads/blog',Input::file('image'),800);				
			}
			$blog->save();

			//save blog category
			$category_id = Input::get('category_id');
			if(!empty($category_id)){
				$blog_category = new BlogCategory;
				$blog_category->blog_id = $blog->id;
				$blog_category->category_id = $category_id;
				$blog_category->save();
			}
			return Redirect::to('admin/blogs')->with('success_message', 'Đã tạo mới một bài viết');
		}
	}

	public function getEdit($id){
		$blog = Blog::find($id);
		$categories = Category::where('state','=',1)->orderBy('id','DESC')->lists('name','id');
		$selected_categories = BlogCategory::where('blog_id','=',$id)->lists('category_id');
		if(empty($blog)){return Redirect::to('admin/blogs')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.blog.create_edit',compact('blog','categories','selected_categories'));
	}

	public function postEdit(){
		$blog = Blog::find(Input::get('id'));

		$rules = array(
		    'title' => 'required',
		    'image' => 'image',
		    'category_id' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('admin/blogs/edit/'.$blog->id)
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {
			$blog->title = Input::get('title');
			$blog->description = Input::get('description');
			//$blog->user_id = Auth::user()->id();
			$blog->state = Input::get('state');
			$blog->highlight = Input::get('highlight');
			$blog->content = Input::get('content');

			//Check delete image
			if(Input::hasFile('image')){
				if(!empty($blog->image))
				{
					File::delete($blog->image);
				}
				$blog->image = uploadPhoto('uploads/blog',Input::file('image'),800);
			}
			$blog->save();

			//save blog category
			$category_ids = array_filter(Input::get('category_id'));
			if(count($category_ids)>0){
				$old_categories = BlogCategory::where('blog_id','=',$blog->id);
				$old_categories->delete();

				foreach($category_ids as $category_id){
					$blog_category = new BlogCategory;
					$blog_category->blog_id = $blog->id;
					$blog_category->category_id = $category_id;
					$blog_category->save();
				}
			}
			
			return Redirect::to('admin/blogs')->with('success_message', 'Thông tin bài viết đã được thay đổi');
		}
	}	

	public function getDetail($id){
		$blog = Blog::find($id);
		if(empty($blog)){return Redirect::to('admin/blogs')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.blog.detail',compact('blog'));
	}

	public function getDelete($id){
		$blog = Blog::find($id);
		if(empty($blog)){return Redirect::to('admin/blogs')->with('error_message', 'Dữ liệu không tồn tại');}
		if(!empty($blog->image))
		{
			File::delete($blog->image);
		}
		$blog->delete();
		return Redirect::to('admin/blogs')->with('success_message', 'Dữ liệu đã được xóa.');
	}

}
