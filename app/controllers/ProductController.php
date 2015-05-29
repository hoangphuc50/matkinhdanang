<?php

class ProductController extends BaseController {
	public function displayDetailProductPage()
	{
		return View::make('frontend.product.detail');
	}
}