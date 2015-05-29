<meta property="og:title" content="@if(isset($web_title)){{$web_title}}@else Tải HTML miễn phí@endif" />
<meta property="og:description" content="@if(isset($web_description)){{$web_description}}@else Tải HTML miễn phí, cung cấp theme HTML.@endif" />
<meta property="og:site_name" content="Ptheme.net - Tải HTML miễn phí" />
@if(isset($web_image))
	<meta property="og:image" content="{{URL::to(themeImageFolder().$web_image)}}" />
@else
	<meta property="og:image" content="{{URL::to('template/images/og_image.png')}}" />
@endif