<?php
    $san_pham_moi = Product::where('state','=',1)->orderBy('id','DESC')->take(10)->get();
 ?>
<ul class="catpost" style="margin:  0 0 20px 0;padding: 0;list-style: none;padding-right: 10px;">
    <h3 style="border-bottom: 3px solid #CCC;padding-bottom: 5px;display: inline-block;width: 100%;font-size: 16px;font-weight: bold;line-height: 30px;">Mắt kính mới về</h3>
    @foreach($san_pham_moi  as $sp1)
        <li style="padding: 5px 0;width: 300px;border-bottom: 1px solid #ccc;" class="toppost">
            <a style="font-weight: none;" class="toptitle" href="{{URL::to('san-pham/'.$sp1->alias)}}" rel="bookmark" title="{{$sp1->name}}">
                <span style="width: 85px;height: 85px;overflow: hidden;display: block;float: left;margin-right: 10px;">
                    {{HTML::image(!empty($sp1->image) ? productImageFolder().$sp1->image : "/images/no_image.jpg",$sp1->name , array('width'=>"85",'height'=>"56",'class'=>"attachment-thumbnail wp-post-image" ))}}
                </span>{{$sp1->name}}
                <br/> Giá bán:<span style="color: #EC0000;">    {{displayPrice($sp1->price)}} VND</span>
            </a>
            <div class="clearfix"> </div>
        </li>
    @endforeach
    
</ul>