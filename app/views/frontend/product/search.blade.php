@extends('layouts.frontend.layout')

@section('content') 
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
    </div>
</div>
@stop