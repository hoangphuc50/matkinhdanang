<?php
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
function uploadPhoto($destinationPath, $input_name,$width=1600,$height=null) {
    $image_url = '';
    $file = Input::file($input_name);
    $extension = $file->getClientOriginalExtension();
    $filename  = strtolower(str_random(10)) . '.' .$extension;
    $uploadPath = public_path().'/'.$destinationPath.'/';

    $img = Image::make($file);

    $image_size = getimagesize($file);
    if($image_size[0] > $width){
        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
    }

    $img->save($uploadPath.$filename);
    $image_url = $destinationPath.'/'.$filename;
    return $image_url;
}