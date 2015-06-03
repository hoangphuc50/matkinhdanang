<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function displayIndexPage()
	{
		$san_pham_khuyen_mai = Product::where('state','=',true)->where('old_price','>',0)->orderBy('id','DESC')->take(3)->get();
		$data['san_pham_moi'] = Product::where('state','=',1)->whereNotIn('id',$san_pham_khuyen_mai->lists('id'))->orderBy('id','DESC')->take(12)->get();
		$data['san_pham_khuyen_mai'] = $san_pham_khuyen_mai;
		return View::make('frontend.index',$data);
	}

	public function displayCategoryPage($id)
	{
		$chuyen_muc = Category::find($id);
		if(empty($chuyen_muc)){ return View::make('frontend.errors.404'); }
		if(!empty($chuyen_muc->link)){
			return Redirect::to($chuyen_muc->link);
		}
		if($chuyen_muc->category_type == "product"){
			return $this->displayProductCategoryPage($chuyen_muc);
		}elseif($chuyen_muc->category_type == "menu"){
			return $this->displayBlogCategoryPage($chuyen_muc);
		}
	}

	public function displayProductCategoryPage($chuyen_muc){
		$san_pham = $chuyen_muc->products()->paginate(15);

		$data['chuyen_muc'] = $chuyen_muc;
		$data['san_pham'] = $san_pham;
		return View::make('frontend.product.category',$data);
	}

	public function displayDetailProductPage($id){
		$san_pham = Product::find($id);
		if(empty($san_pham)){ return View::make('frontend.errors.404'); }
		$san_pham_lien_quan = Product::where('state','=',true)->where('id','!=',$id)->orderByRaw("RAND()")->take(3)->get();
		$data['san_pham'] = $san_pham;
		$data['san_pham_lien_quan'] = $san_pham_lien_quan;
		return View::make('frontend.product.detail',$data);
	}

	public function displayBlogCategoryPage($chuyen_muc){
		$bai_viet_ = $chuyen_muc->blogs()->get();
		$bai_viet = $chuyen_muc->blogs()->paginate(15);

		if(count($bai_viet) < 2){
			$id = '';
			foreach ($bai_viet as $row) {
				$id = $row->id;
				break;
			}
			return $this->displayDetailBlogPage($id);
		}

		$data['chuyen_muc'] = $chuyen_muc;
		$data['bai_viet'] = $bai_viet;
		return View::make('frontend.blog.category',$data);
	}

	public function displayDetailBlogPage($id){
		$bai_viet = Blog::find($id);
		if(empty($bai_viet)){ return View::make('frontend.errors.404'); }
		$data['bai_viet'] = $bai_viet;
		return View::make('frontend.blog.detail',$data);
	}
}
