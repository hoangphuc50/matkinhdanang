<?php 
    $web_title = "Chuyên cung cấp kính mát, kính râm, kính phi công, Rayban loại 1 tại Đà Nẵng";
    $web_description = "Đảm bảo hàng tốt mới thanh toán, hình ảnh thật được shop tự chụp, đền bù 100% nếu hàng kém chất lượng. Miễn phí giao hàng khu vực Đà Nẵng và toàn quốc";
    $web_image = '';
?>
@extends('layouts.frontend.layout')

@section('content') 
<<<<<<< HEAD
@include('layouts.frontend._slider')
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="main-wrapper">
                    <div class="row">
                        <div class="col-md-3">
                            @include('layouts.frontend._ticker_news')
                        </div>
                        <div class="col-md-9">
                            <h2 class="title-2 " style="padding-top:0">Mắt kính Bán chạy <span>trong tháng 4</span>
                            </h2>
                            <div class="row san-pham-noi-bat">
                                @foreach($san_pham_khuyen_mai as $sp1)
                                <div class="col-md-4 col-sm-4 ">
                                    <div class="product-item">
                                        <a href="{{URL::to('mat-kinh/'.$sp1->alias)}}">
                                            {{HTML::image(!empty($sp1->image) ? productThumbImageFolder().$sp1->image : "/images/no_image.jpg",$sp1->name)}}
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
                        </div>
                    </div>
                    
                    <h2 class="title-2">Mắt kính <span>Mới về (đang cập nhật)</span>
                    </h2>
                    <div class="row san-pham-moi">
                        @foreach($san_pham_moi as $sp1)
                        <div class="col-md-4 col-sm-4 ">
                            <div class="product-item">
                                <a href="{{URL::to('mat-kinh/'.$sp1->alias)}}">
                                    {{HTML::image(!empty($sp1->image) ? productThumbImageFolder().$sp1->image : "/images/no_image.jpg",$sp1->name)}}
                                    <h3>{{$sp1->name}} </h3>
                                    <p class="price">
                                        @if($sp1->public_price == true and $sp1->price > 0 )
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
                </div>
            </div>               
=======
<div class="col-md-9 col-sm-8">
    <div class="main-wrapper">
        <h2 class="title-2">Khuyến mãi <span>Hôm nay</span>
        </h2>
        <div class="row san-pham-noi-bat">
            @foreach($san_pham_khuyen_mai as $sp1)
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
        <div class="border-line"></div>
        <h2 class="title-2">Sản phẩm <span>Mới nhất</span>
        </h2>
        <div class="row san-pham-noi-bat">
            @foreach($san_pham_moi as $sp1)
            <div class="col-md-4 col-sm-6 ">
                <div class="product-item">
                    <a href="{{URL::to('san-pham/'.$sp1->alias)}}">
                        {{HTML::image(!empty($sp1->image) ? productImageFolder().$sp1->image : "/images/no_image.jpg",$sp1->name)}}
                        <h3>{{$sp1->name}} </h3>
                        <p class="price">
                            @if($sp1->public_price == true and $sp1->price > 0 )
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
>>>>>>> 2edb44b0b68c847c9af9804e9245765302d73f8d
        </div>
    </div>
</section>

@stop