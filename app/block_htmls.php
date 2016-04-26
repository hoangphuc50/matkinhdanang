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
		$all_blocks = BlockHtml::get();
		foreach ($all_blocks as $block) {
		    switch ($block->position) {
		        case "top_info":
		        	if($block->state == true)
		        	{
		        		$block_html['top_info'] = empty($block->content) ? '' : $block->content;
		        	}else{
		        		$block_html['top_info'] = '';
		        	}  
		            break;
		        case "footer_info":
		            if($block->state == true)
		        	{
		        		$block_html['footer_info'] = empty($block->content) ? '' : $block->content;
		        	}else{
		        		$block_html['footer_info'] = '';
		        	}
		            break;
		        case "cam_ket":
		            if($block->state == true)
		        	{
		        		$block_html['cam_ket'] = empty($block->content) ? '' : $block->content;
		        	}else{
		        		$block_html['cam_ket'] = '';
		        	}
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
