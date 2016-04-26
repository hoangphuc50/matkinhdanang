<?php
    $bai_viet_moi = Blog::where('state','=',1)->orderBy('id','DESC')->take(10)->get();
?>
<ul class="catpost" style="margin: 0 0 20px 0;padding: 0;list-style: none;padding-right: 10px;">
    <h3 style="border-bottom: 3px solid #CCC;padding-bottom: 5px;display: inline-block;width: 100%;font-size: 16px;font-weight: bold;line-height: 30px;">Tư vấn chọn kính</h3>
    @foreach( $bai_viet_moi as $sp1)
    <li style="padding: 5px 0;width: 300px;border-bottom: 1px solid #ccc;" class="toppost" id="post-6743">
        <a style="font-weight: none;" class="toptitle" href="{{URL::to('bai-viet/'.$sp1->alias)}}" rel="bookmark" title="{{$sp1->name}}">
            <span style="width: 85px;height: 85px;overflow: hidden;display: block;float: left;margin-right: 10px;">
			<img width="85" height="57" src="{{!empty($sp1->image) ? URL::to(blogImageFolder().$sp1->image) : '/images/no_image.jpg'}}" class="attachment-thumbnail wp-post-image" alt="2_ODXJ" />
			</span>
			{{$sp1->title}}
		</a>
		<div class="clearfix"> </div>
    </li>
    @endforeach

    
</ul>
<div class="clearfix"> </div>
