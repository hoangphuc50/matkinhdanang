<?php

class ManageOrderController extends \BaseController {
	public function __construct()
    {
    	$this->beforeFilter('auth', array('except'=>array('')));
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
			    case "email":
			        $query_string .= ($query_string == '') ? " email LIKE ? " : " AND email LIKE ?";
					$query_params[] = '%'.$search.'%';
			        break;
			    default:
			        $query_string .= ($query_string == '') ? " name LIKE ? " : " AND name LIKE ?";
					$query_params[] = '%'.$search.'%';
			}
		}

		$query = Order::query();

		//Sortting
		$allowed_columns = ['name', 'id','state','highlight','created_at']; 
		$sort = in_array(Input::get('sort'), $allowed_columns) ? Input::get('sort') : 'id'; 
		$order = Input::get('order') === 'asc' ? 'asc' : 'desc'; 

		//Excute query
		if($query_string != '') {
			$query = $query->whereRaw($query_string, $query_params);
		}

		$query = $query->orderBy($sort, $order);
		$orders = $query->paginate($per_page);

		return View::make('backend.order.index',compact('orders'));

	}
	public function getDetail($id){
		$order = Order::find($id);

		if(empty($order)){return Redirect::to('admin/orders')->with('error_message', 'Dữ liệu không tồn tại');}
		$order->state = true;
		$order->save();
		return View::make('backend.order.detail',compact('order'));
	}

	public function getDelete($id){
		$order = Order::find($id);
		if(empty($order)){return Redirect::to('admin/orders')->with('error_message', 'Dữ liệu không tồn tại');}
		$order->delete();

		$product_order = ProductOrder::where('order_id','=',$id);
		$product_order->delete();

		return Redirect::to('admin/orders')->with('success_message', 'Dữ liệu đã được xóa.');
	}

}
