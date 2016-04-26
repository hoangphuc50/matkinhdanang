<?php
function productImageFolder(){
    return 'uploads/product/';
} 
function productThumbImageFolder(){
    return 'uploads/product/thumb/';
}  
function categoryImageFolder(){
    return 'uploads/category/';
}
function blogImageFolder(){
    return 'uploads/blog/';
} 
function blockImageFolder(){
    return 'uploads/block_html/';
}
function kinhImageFolder(){
    return 'uploads/menu_kinh/';
}
function sliderImageFolder(){
    return 'uploads/slider/';
}
function checkAdmin(){
    if(Auth::user()->user_type=="admin"){
        return true;
    }else{
        return Redirect::to('admin/login')
                        ->with('message', 'Bạn không có quyền truy cập');
    }
}

/*
Sort by column
Use: adminSort("Name","name")
*/
function adminSort($text = "",$column = "",$sort = "desc"){
    $sort_by = empty($column) ? Input::get('sort') : $column;
    $sort_type = empty(Input::get('order')) ? $column : Input::get('order');

    if($sort_type == "asc"){
        $sort_type = "desc";
    }else{
        $sort_type = "asc";
    }
    echo '<a href="?sort=' . $sort_by . '&order=' . $sort_type . '">'. $text .'</a>';
}


/*
* Function to help upload photo
* 
* @param    string  destinationPath
* @param    string  input_name
*
* @return   string  image_url
*/
function uploadPhoto($destinationPath, $file,$width=1600,$height=null) {
    $image_url = '';
    //$file = Input::file($input_name);
    $extension = $file->getClientOriginalExtension();
    $filename  = strtolower(str_random(15)) . '.' .$extension;
    $uploadPath = $destinationPath.'/';

    $img = Image::make($file);

    $image_size = getimagesize($file);
    if($image_size[0] > $width){
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
    }

    $img->save($uploadPath.$filename);
    $image_url = $destinationPath.'/'.$filename;
    return $filename;
}

function uploadPhotoWithThumb($destinationPath, $file,$width=1600,$height=null) {
    $image_url = '';
    //$file = Input::file($input_name);
    $extension = $file->getClientOriginalExtension();
    $filename  = strtolower(str_random(15)) . '.' .$extension;
    $uploadPath = $destinationPath.'/';

    $img = Image::make($file);

    $image_size = getimagesize($file);
    if($image_size[0] > $width){
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
    }

    $img->save($uploadPath.$filename);
    $image_url = $destinationPath.'/'.$filename;

    //Create thumb
    $thumb_img = $img->resize(320, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
    $thumb_img->save($uploadPath.'/thumb/'.$filename);
    //End create thumb

    return $filename;
}

function uploadFile($destinationPath, $input_name) {
    $file_url = '';
    $file = Input::file($input_name);
    $extension = $file->getClientOriginalExtension();
    if (in_array($extension, ['jpg','png','gif','zip','rar','7z'])){
        $filename  = strtolower(str_random(15)) . '.' .$extension;
        $uploadPath = $destinationPath.'/';

        $file->move($destinationPath, $filename);
        $file_url = $destinationPath.'/'.$filename;
    }
    return $file_url;
}

function displayPrice($price=0){
    if(is_numeric($price)){
        return number_format($price , 0, ',', '.');
    }
    return 0;
}