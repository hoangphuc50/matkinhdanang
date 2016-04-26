@extends('layouts.frontend.layout')

@section('content') 
<<<<<<< HEAD
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
=======
<div class="col-md-9 col-sm-8">
    <div class="main-wrapper">
        <div class="breakcrum">
            <ul>
                <li>
                    <a href="#">Trang chủ</a>
                </li> 
                <li>
                   <a href="#">Kết quả tìm kiếm</a> 
                </li>
            </ul>
        </div>
        <h2 class="title-2">
            Kết quả tìm kiếm với từ khóa "{{Input::get('search')}}"
        </h2>
        <div class="row san-pham-noi-bat">
            @foreach($san_pham as $sp1)
            <div class="col-md-4 col-sm-6 ">
                <div class="product-item">
                    <a href="{{URL::to('san-pham/'.$sp1->alias)}}">
                        {{HTML::image(!empty($sp1->image) ? productImageFolder().$sp1->image : "/images/no_image.jpg",$sp1->name)}}
                        <h3>{{$sp1->name}} </h3>
                        <p class="price">
                            @if($sp1->public_price == true and $sp1->price > 0)
                                @if(!empty($sp1->old_price))
                                    <span>{{displayPrice($sp1->old_price)}} đ</span>
                                @endif
                            {{displayPrice($sp1->price)}} đ
                            @else
                                Liên hệ shop
                            @endif
                        </p>
                    </a>
                </div>
            </div>
            @endforeach
            
        </div>
        <div class="product-paginate">
            <?php echo $san_pham->appends(Input::only('search'))->links(); ?>
        </div>
>>>>>>> 2edb44b0b68c847c9af9804e9245765302d73f8d
    </div>
</div>
@stop