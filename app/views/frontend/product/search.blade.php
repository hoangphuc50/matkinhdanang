@extends('layouts.frontend.layout')

@section('content') 
<div id="content" role="main">
    <div class="contentarc">
        @foreach($san_pham as $sp1)
            <div class="postcontent">
                <a href="{{URL::to('san-pham/'.$sp1->alias)}}" title="photo">
                    <span class="entry-thumb"> 
                        {{HTML::image(!empty($sp1->image) ? productImageFolder().$sp1->image : "/images/no_image.jpg",$sp1->name)}}
                        </span>
                    <span class="entry-title">{{$sp1->name}}<br/>
                        @if($sp1->public_price == true and $sp1->price > 0)
                            @if(!empty($sp1->old_price))
                                <span class="old-price">{{displayPrice($sp1->old_price)}} đ</span>
                            @endif
                            <span class="price">{{displayPrice($sp1->price)}} đ</span>
                        @else
                            <span class="price">Liên hệ shop</span>
                        @endif
                    </span>
                </a>
            </div>
        @endforeach   
        <div class="clearfix"></div>
        <div class="product-paginate">
            <?php echo $san_pham->appends(Input::only('search'))->links(); ?>
        </div>
        <div class="pagenav clearfix"><span>Trang 1 / 2</span><a href='http://kinh365.com/' class='current'>1</a><a href='http://kinh365.com/page/2/'>2</a><a href="page/2/">Tiếp &raquo;</a></div>
    </div>
</div>
@stop