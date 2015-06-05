<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	App::singleton('block_html', function(){
		$block_html = [];
		$all_blocks = BlockHtml::where('state','=',true)->get();
		foreach ($all_blocks as $block) {
		    switch ($block->position) {
		        case "top_info":
		            $block_html['top_info'] = $block->content;
		            break;
		        case "chu_chay":
		            $block_html['chu_chay'] = $block->content;
		            break;
		        case "ho_tro_truc_tuyen":
		            $block_html['ho_tro_truc_tuyen'] = $block->content;
		            break;
		        case "footer_info":
		            $block_html['footer_info'] = $block->content;
		            break;
		        case "danh_cho_nguoi_mua":
		            $block_html['danh_cho_nguoi_mua'] = $block->content;
		            break;
		        case "gioi_thieu":
		            $block_html['gioi_thieu'] = $block->content;
		            break; 
		        case "copyright":
		            $block_html['copyright'] = $block->content;
		            break;  
		        default:
		            break;
		    }
		}
		return $block_html;
    });
    // If you use this line of code then it'll be available in any view
    // as $site_settings but you may also use app('site_settings') as well
    View::share('block_html', app('block_html'));

});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return Response::make('Unauthorized', 401);
		}
		else
		{
			return Redirect::guest('admin/login')->with('error_message', 'Bạn phải đăng nhập để tiếp tục');
		}
	}
});

Route::filter('auth.admin', function()
{
    if(Auth::user()->user_type != "admin" or Auth::guest()){
        return Redirect::to('admin/login')->with('error_message', 'Bạn không có quyền truy cập');
    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
