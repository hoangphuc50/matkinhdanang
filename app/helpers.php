<?php
/*
* Function to help upload photo
* 
* @param    string  destinationPath
* @param    string  input_name
*
* @return   string  image_url
*/
function uploadPhoto($destinationPath, $input_name) {
    $image_url = '';
    $file = Input::file($input_name);
    $extension = $file->getClientOriginalExtension();
    $filename        = str_random(10) . '.' .$extension;
    $uploadPath = public_path().'/'.$destinationPath;
    $uploadSuccess   = Image::make($file)->save($uploadPath.$filename);

    $image_url = $destinationPath.$filename;

    $result = uploadAmazonS3($filename, $image_url);
    if($result != false) {
        $image_url = getAmazonS3Link($filename);
        File::delete($destinationPath.$filename);
    }
    return $image_url;
}

/*
* Function to help upload photo
* 
* @param    string  destinationPath
* @param    string  input_name
*
* @return   string  image_url
*/
function uploadPhotoResize($destinationPath, $input_name,$width=320,$height=null) {
    $image_url = '';
    $file = Input::file($input_name);
    $extension = $file->getClientOriginalExtension();
    $filename  = str_random(10) . '.' .$extension;
    $uploadPath = public_path().'/'.$destinationPath;

    $img = Image::make($file);
    $img->resize($width, $height, function ($constraint) {
        $constraint->aspectRatio();
    });
    $img->save($uploadPath.$filename);

    $image_url = $destinationPath.$filename;
    $result = uploadAmazonS3($filename, $image_url);
    if($result != false) {
        $image_url = getAmazonS3Link($filename);
        File::delete($destinationPath.$filename);
    }  
    return $image_url;
}

/*
* Function to get province in ThaiLand
*/
function getProvinceOptions() {
    $province = Province::orderBy('name_en', 'asc')->get();
    $result_array = array('' => trans('message.province_option'));
    foreach ($province as $p) {
        $result_array[$p->id] = $p->name;
    }
    return $result_array;
}

/*
* Function to get line type option
*/
function getLineOptions() {
    $line = Line::orderBy('name_en', 'asc')->get();
    $result_array = array('' => trans('message.line_option'));
    foreach($line as $l) {
        $result_array[$l->id] = $l->name;
    }
    return $result_array;
}

/*
* Function get type building option
*/
function getTypeBuildingOptions() {
	$type = ApartmentType::all();
	$result_array = array('' => trans('message.type_apartment_option'));
	foreach($type as $t) {
		$result_array[$t->id] = $t->name;
 	}
 	return $result_array;
}

/*
* Function to get bedtrooms options
*/
function getBedroomsOptions() {
    $result_array = array( 0 => 'Studio');
    for($i=1; $i<=10; $i++){
        $result_array[$i] = ($i == 1) ? "{$i} Bedroom" : "{$i} Bedrooms";
    }
    return $result_array;
}

/*
* Function create random string
*/
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/*
* Function to display feature
*/
function displayFeature($value) {
    if($value == 1) {
        echo '<span class="ed-selected"></span>';
    }

    if($value == -1) {
        echo '<span class="ed-update-later"></span>';
    }

    return false;
}


/*
* Function to check back-end active menu
*/
function checkBackendMenu($value = 'dashboard') {
    $current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (strpos($current_url,$value) !== false) {
        echo 'active';
    }
}

/*
* Function get and display newest building in header
*/
function displayNewestBuilding() {
    $apartment = Apartment::where('state', '=', 1)->where('image', '!=', '')->orderBy('created_at', 'desc')->first();

    if(!empty($apartment)) {
        echo '<div class="img-circle">';
        echo '<a href="'.URL::to(Session::get('lang').'/building/detail/'.$apartment->id).'">';
        if($apartment->image != ''){
            echo HTML::image($apartment->image, '', array('width' => '253px', 'height' => '190px'));
        }
        else {
            echo HTML::image('uploads/building/no_photo_253x190.jpg');
        }
        echo '<div id="icon-cirle">';
        echo HTML::image('images/newicon-10.png');
        echo '</div>';
        echo '<div id="icon2-cirle">';
        if($apartment->public_price_sell){
            echo number_format($apartment->price_sell) . '฿';
        }
        else if($apartment->public_price_rent) {
            echo number_format($apartment->price_rent) . '฿';
        }
        else {
            echo 'Neogation';
        }
        echo '</div>';
        echo '<div id="info-cirle">';
        echo '<p>'. substr($apartment->name, 0, 16) .'</p>';
        echo "Area: {$apartment->size} m² <br>";
        echo "Year Built: {$apartment->years}";
        echo '</div>';
        echo '</a>';
        echo '</div>';
    }
}


/*
* Function get and display string in profile user
*/
function displayStringByExplode($string="",$key=0,$split_char='-'){
    $this_array = explode($split_char,$string);
    if(count($this_array) > 1){
        return trim($this_array[$key]);
    }else{
        return trim($string);
    }
}

function displayWorkingTime($string="",$key=0,$split_char='-'){
    if (preg_match('/time/',$string)) {
        return '';
    }else{
        $this_array = explode($split_char,$string);
        if(count($this_array) > 1){
            return trim($this_array[$key]);
        }else{
            return trim($string);
        }
    }
}

/*
* Function to get Google Map API
*/
function getGoogleMapKey() {
    $key = 'AIzaSyBZFPUN-KRPAbqSrNqploSsFwlN8-Wao0s';
    return $key;
}

/*
* Function to make address in google
* @param    string   address
* @param    string   district
* @param    string   province
*
* @return   string  result
*/
function getMapAddress($address, $district, $province) {
    $result = '';
    $address_result = str_replace(' ', '+', $address);
    $district_result = str_replace(' ', '+', $district);
    $province_result = str_replace(' ', '+', $province);
    $result = $address_result . ',' . $district_result . ',' . $province_result . ',' . 'ThaiLand';

    return $result;
}

/*
* Function to get options listing for
*/
function getListingForOption() {
    $result = array(
        trans('errors.search.list_for.sale'),
        trans('errors.search.list_for.rent'),
        trans('errors.search.list_for.option')
        );
    return $result;
}

/*
* Function to generate url search
* @param    string   redirect_url
* @param    array   param
*
* @return   string  url 
*/
function generateSearchURL($redirect_url, $param_array) {
    $url = '#';
    $qs = http_build_query($param_array);
    $url = URL::to($redirect_url.$qs);
    return $url;
}

/*
* Function to display test result
*/
function displayTestResult($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    exit();
}

/*
* Function to display gender
*/
function displayGender($value) {
    if($value == 1) { return "Men"; }
    if($value == 2) { return "Woman"; }
    return "";
}

/*
* Function help to display room request at detail user page
*/
function displayGenderFemale($value) {
    switch ($value) {
    case 1:
        return "No Preference";
        break;
    case 2:
        return "Straight";
        break;
    case 3:
        return "Lesbian";
        break;
    case 4:
        return "No female";
        break;
    default:
        return "";
    }
}
function displayOccupation($value) {
    switch ($value) {
    case 1:
        return "I'd rather no say";
        break;
    case 2:
        return "Professtional";
        break;
    case 3:
        return "Student";
        break;
    case 4:
        return "Military";
        break;
    case 5:
        return "Unemployed";
        break;
    case 6:
        return "Retired";
        break;
    default:
        return "";
    }
}
function displayCleanliness($value) {
    switch ($value) {
    case 1:
        return "Clean";
        break;
    case 2:
        return "Average";
        break;
    case 3:
        return "Messy";
        break;
    default:
        return "";
    }
}
function displayWorkingType($value) {
    switch ($value) {
    case 1:
        return "Full time";
        break;
    case 2:
        return "Part time";
        break;
    case 3:
        return "No job";
        break;
    case 4:
        return "Others";
        break;
    default:
        return "";
    }
}
function displayLanguageRequirement($value) {
    switch ($value) {
    case 1:
        return "Beginner";
        break;
    case 2:
        return "Elementary";
        break;
    case 3:
        return "Intermediate";
        break;
    case 4:
        return "Advance";
        break;
    default:
        return "";
    }
}

/*
* Function to get category
*/
function getCategoryOptions() {
    $category = Category::orderBy('name_en', 'asc')->get();
    $result_array = array('' => trans('message.category_option'));
    foreach ($category as $p) {
        $result_array[$p->id] = $p->name;
    }
    return $result_array;
}

function xss_clean($data)
{
    // Fix &entity\n;
    $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
    $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
    $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
    $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

    // Remove any attribute starting with "on" or xmlns
    $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

    // Remove javascript: and vbscript: protocols
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
    $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

    // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
    $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

    // Remove namespaced elements (we do not need them)
    $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

    do
    {
        // Remove really unwanted tags
        $old_data = $data;
        $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
    }
    while ($old_data !== $data);

    // we are done...
    return $data;
}

/*
* Function to Limiting the string displayChar(this_string,string_length_default_is_60)
*/
function displayChar($str,$maxlen=60){
    if (strlen($str) <= $maxlen) return $str;
    $newstr = substr($str, 0, $maxlen);
    if (substr($newstr, -1, 1) != ' ') $newstr = substr($newstr, 0, strrpos($newstr, " "));
    return $newstr.'...';
}

/*
* Function to get search option apartment
*/
function getSearchApartmentArray() {
    return array('business_center', 'pet_allow', 'terrace_balcony', 'kitchen', 'maid_cleaning', 'diswasher');
}

/*
* Function to check input search
*/
function checkInputSearch($data) {
    if(!is_numeric($data) AND strtolower($data) != 'all') {
        return false;
    }

    return true;
}

/*
*   Function check account_level of POSTER
*/
function checkLevelAccount(){
    // if(Auth::poster()->user()->type_id != 1){           
    //     $account_level = AccountLevel::where('id', '=', Auth::poster()->user()->level_id)->first();
    //     if($account_level->company_profile != 0){
    //         return true;
    //     }
    // }else{
    //     return false;
    // }
    $account_level = AccountLevel::where('id', '=', Auth::poster()->user()->level_id)->first();
    if($account_level->company_profile != 0){
        return true;
    }
    return false;
}

/*
* Get array to search apartment feature
*/
function getCheckingApartmentFeatureArray() {
    $result_array = array('business_center', 'pet_allow', 'air_conditioner', 'terrace_balcony', 'kitchen', 'maid_cleaning', 'diswasher');
    return $result_array;
}

/*
* Get array to search community feature
*/
function getCheckingCommunityFeatureArray() {
    $result_array = array('elevator', 'car_parking', 'internet_service', 'swimming_pool', 'fitness_center', 'coffee_shop', 'restaurant');
    return $result_array;
}

/*
* Get array to search safety feature
*/
function getCheckingSafetyFeatureArray() {
    $result_array = array('security_24h', 'cctv');
    return $result_array;
}

/*
*   Function check account_level of POSTER
*/
function checkPosterAccount($poster_id_input){
    if(Auth::poster()->id() == $poster_id_input){           
        return true;
    }else{
        return false;
    }
}

/*
* Function to remove / in file name
*/
function removeFirstName($file_url) {
    $result = $file_url;
    if(strpos($file_url, '/') == 0) {
        $result = substr($file_url, 1, strlen($file_url));
    }
    return $result;
}

/*
* Function to upload file to Amazon S3
*/
function uploadAmazonS3($filename, $file_path) {
    $s3 = AWS::get('s3');

    $file = File::get($file_path);

    $result = $s3->putObject(array(
        'Bucket'     => 'nayoo',
        'Key'        => $filename,
        'Body' =>  $file,
        'ACL'         => 'public-read',
        ));

    return (isset($result['ObjectURL'])) ? $result['ObjectURL'] : false;
}

/*
* Function to delete file in Amazon S3
*/
function deleteAmazonS3($bucket, $file_link) {
    $s3 = AWS::get('s3');
    $file_path = explode('/', $file_link);
    $filename = end($file_path);
    $result = $s3->deleteMatchingObjects($bucket, $filename);
    return ($result == 0) ? false : true;
}

/*
* Function to get Amazon S3 Link
*/
function getAmazonS3Link($filename) {
    $result = "https://nayoo.s3-ap-southeast-1.amazonaws.com/" . $filename;
    return $result;
}

/*
* Function to get Amazon S3 Bucket
*/
function getAmazonS3Bucket() {
    $result = 'nayoo';
    return $result;
}


/*
* Function to Display Slide Show
*/
function displaySlideShowHome(){
    echo '<div class="wrapper">' .
            '<div class="jcarousel-wrapper">'.
                '<div class="jcarousel">'.
                    '<ul>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') .  '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') .  '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li> ' .                      
                    '</ul>'.
                '</div>'.

                '<a href="#" class="jcarousel-control-prev">&lsaquo;</a>'.
                '<a href="#" class="jcarousel-control-next">&rsaquo;</a>'.

                '<p class="jcarousel-pagination"></p>'.
            '</div>'.
        '</div>';
}


/*
* Function to Display Slide Show
*/
function displaySlideShow(){
    echo '<div class="wrapper">' .
            '<div class="jcarousel-wrapper jcarousel-wrapper-margin-left">'.
                '<div class="jcarousel">'.
                    '<ul>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') .  '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') .  '</a></li>'.
                        '<li><a href="#">' . HTML::image('images/bannerimg-14.png') . '</a></li> ' .                      
                    '</ul>'.
                '</div>'.

                '<a href="#" class="jcarousel-control-prev">&lsaquo;</a>'.
                '<a href="#" class="jcarousel-control-next">&rsaquo;</a>'.

                '<p class="jcarousel-pagination"></p>'.
            '</div>'.
        '</div>';
}




///////////////////////////////////
function checkAdmin(){
    if(Auth::user()->user_type=="admin"){
        return true;
    }else{
        return Redirect::to('admin/login')
                        ->with('message', 'Bạn không có quyền truy cập')
    }
}
