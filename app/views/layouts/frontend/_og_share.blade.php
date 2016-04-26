<meta property="og:title" content="@if(isset($web_title)){{$web_title}}@else Mắt kính Đà Nẵng @endif" />
<meta property="og:description" content="@if(isset($web_description)){{$web_description}}@else Mắt kính Đà Nẵng, chuyên sỉ lẻ mắt kính thời trang, kính râm, kính RayBan chất lượng đảm bảo, giá rẻ nhất Đà Nẵng @endif" />
<meta property="og:site_name" content="MatKinhDaNang.Com - Đà Nẵng" />
@if(isset($web_image) and !empty($web_image))
	<meta property="og:image" content="{{URL::to(productImageFolder().$web_image)}}" />
@else
	<meta property="og:image" content="{{URL::to('template/minhrayban/images/og.jpg')}}" />
@endif