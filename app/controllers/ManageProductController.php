<?php

class ManageProductController extends \BaseController {
	public function __construct()
    {
    	$this->beforeFilter('auth', array('except'=>array('')));
        $this->beforeFilter('auth.admin', array('except'=>array('')));
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

		$query = Product::query();

		//Sortting
		$allowed_columns = ['name', 'id','state','highlight',]; 
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id'; 
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc'; 

		//Excute query
		if($query_string != '') {
			$query = $query->whereRaw($query_string, $query_params);
		}

		$query = $query->orderBy($sort, $order);
		$products = $query->paginate($per_page);

		return View::make('backend.product.index',compact('products'));

	}

	public function getAdd(){
		$categories = Category::tree();
		return View::make('backend.product.create_edit',compact('categories'));
	}

	public function postAdd(){
		$rules = array(
		    'name' => 'required',
		    'image' => 'image',
		    'category_id' => 'required',
		    'price' => 'numeric',
		    'old_price' => 'numeric',
		);

		$validator = Validator::make(Input::all(), $rules);

		
		if ($validator->fails()) {
		    return Redirect::to('admin/products/add')
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {

			$product = new Product;

			$product->name = Input::get('name');
			$product->description = Input::get('description');
			$product->state = Input::get('state');
			$product->highlight = Input::get('highlight');
			$product->content = Input::get('content');			
			$product->alias = Input::get('alias');

			$product->price = Input::get('price');
			$product->old_price = Input::get('old_price');
			$product->public_price = Input::get('public_price');

			$product->feature = Input::get('feature');
			$product->product_id = Input::get('product_id');
			if(Input::hasFile('image')){
				$product->image = uploadPhotoWithThumb('uploads/product',Input::file('image'),800);				
			}
			$product->save();
			
			//save hình ảnh
			$images = array_filter(Input::file('images'));
			if(count($images)>0){
				foreach($images as $image){
					//Save Image
					$image_ = new Picture;
					$image_->name =  $product->name;
					$image_->url = uploadPhotoWithThumb('uploads/product', $image,1000);
					$image_->save();

					//Save Product Image
					$product_image = new ProductImage;
					$product_image->product_id = $product->id;
					$product_image->image_id = $image_->id;
					$product_image->save();
				}
			}

			//save product category
			$category_id= Input::get('category_id');
			if(!empty($category_id)){
				$product_category = new ProductCategory;
				$product_category->product_id = $product->id;
				$product_category->category_id = $category_id;
				$product_category->save();
			}
			return Redirect::to('admin/products')->with('success_message', 'Đã tạo mới một sản phẩm');
		}
	}

	public function getEdit($id){
		$product = Product::find($id);
		$categories = Category::tree();
		if(empty($product)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.product.create_edit',compact('product','categories'));
	}

	public function postEdit(){
		$product = Product::find(Input::get('id'));

		$rules = array(
		    'name' => 'required',
		    'image' => 'image',
		    'category_id' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('admin/products/edit/'.$product->id)
		        ->withErrors($validator)
		        ->withInput();
		} 
		else {
			$product->name = Input::get('name');
			$product->description = Input::get('description');
			$product->state = Input::get('state');
			$product->highlight = Input::get('highlight');
			$product->content = Input::get('content');			
			$product->alias = Input::get('alias');

			$product->price = Input::get('price');
			$product->old_price = Input::get('old_price');
			$product->public_price = Input::get('public_price');

			$product->feature = Input::get('feature');
			$product->product_id = Input::get('product_id');

			//Check delete image
			if(Input::hasFile('image')){
				if(!empty($product->image))
				{
					File::delete(productImageFolder().$product->image);
					File::delete(productImageFolder().'/thumb/'.$product->image);
				}
				$product->image = uploadPhotoWithThumb('uploads/product',Input::file('image'),800);	
			}		
			$product->save();

			//save product category
			$category_id= Input::get('category_id');
			if(!empty($category_id)){
				$product_category = ProductCategory::where('product_id','=',$product->id)->first();
				$product_category->category_id = $category_id;
				$product_category->save();
			}
			
			return Redirect::to('admin/products')->with('success_message', 'Thông tin sản phẩm đã được thay đổi');
		}
	}	

	public function getDetail($id){
		$product = Product::find($id);
		if(empty($product)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.product.detail',compact('product'));
	}

	public function getDelete($id){
		$product = Product::find($id);
		if(empty($product)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}
		//Delete hình minh họa
		if(!empty($product->image))
		{
			File::delete(productImageFolder().$product->image);
			File::delete(productImageFolder().'/thumb/'.$product->image);
		}
		//Delete hình sản phẩm
		foreach ($product->images as $image) {
			if(!empty($image->url))
			{
				File::delete(productImageFolder().$image->url);
				File::delete(productImageFolder().'/thumb/'.$image->url);
			}
			$image_ = Picture::find($image->id);
			$image_->delete();
		}

		$product->delete();
		return Redirect::to('admin/products')->with('success_message', 'Dữ liệu đã được xóa.');
	}

	public function getImages($id){
		$product = Product::find($id);
		if(empty($product)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.product.images',compact('product'));
	}

	public function getAddImage($id){
		$product = Product::find($id);
		if(empty($product)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.product.image_add',compact('product'));
	}

	public function postAddImage(){
		$product = Product::find(Input::get('product_id'));
		if(empty($product)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}
		
		//save hình ảnh
		$images = array_filter(Input::file('images'));
		if(count($images)>0){
			foreach($images as $image){
				//Save Image
				$image_ = new Picture;
				$image_->name =  $product->name;
				$image_->url = uploadPhotoWithThumb('uploads/product', $image,1000);
				$image_->save();

				//Save Product Image
				$product_image = new ProductImage;
				$product_image->product_id = $product->id;
				$product_image->image_id = $image_->id;
				$product_image->save();
			}
		}
		return Redirect::to('/admin/products/images/'.$product->id)->with('success_message', 'Hình ảnh đã được thêm');
	}

	public function getDetailImage($id){
		$image = Picture::find($id);
		if(empty($image)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}
		return View::make('backend.product.image_detail',compact('image'));
	}

	public function getEditImage($id){
		$image = Picture::find($id);
		if(empty($image)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}
		$product_id = ProductImage::where('image_id','=',$id)->first()->product_id;
		$product = Product::find($product_id);
		return View::make('backend.product.image_edit',compact('image','product'));
	}

	public function postEditImage(){
		$image = Picture::find(Input::get('id'));
		$product = Product::find(Input::get('product_id'));
		if(empty($image)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}
		
		$image->name = Input::get('name');
		$image->order = Input::get('order');
		if(Input::hasFile('image')){
			if(!empty($image->url))
			{
				File::delete(productImageFolder().$image->url);
				File::delete(productImageFolder().'/thumb/'.$image->url);
			}
			$image->url = uploadPhotoWithThumb('uploads/product',Input::file('image'),800);	
		}
		$image->save();

		return Redirect::to('/admin/products/images/'.$product->id)->with('success_message', 'Hình ảnh đã được đổi thông tin');
	}

	public function getDeleteImage($id){
		$image = Picture::find($id);	
		if(empty($image)){return Redirect::to('admin/products')->with('error_message', 'Dữ liệu không tồn tại');}

		if(!empty($image->url))
		{
			File::delete(productImageFolder().$image->url);
			File::delete(productImageFolder().'/thumb/'.$image->url);
		}
		$image->delete();

		$product_image = ProductImage::where('image_id','=',$id);
		$product_id = $product_image->first()->product_id;
		$product_image->delete();

		return Redirect::to('admin/products/images/'.$product_id)->with('success_message', 'Dữ liệu đã được xóa.');
	}


}
