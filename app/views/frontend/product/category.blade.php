<?php 
    $web_title = $chuyen_muc->name;
    $web_description = $chuyen_muc->description;
    $web_image = '';
?>
@extends('layouts.frontend.layout')

<<<<<<< HEAD
@section('content')
<section class="main">
    <div class="container">
        <div class="row">
            @include('layouts.frontend._sidebar')
            <div class="col-md-9 col-sm-8">
                <div class="main-wrapper">
                    <div class="breakcrum">
                        <ul>
                            <li>
                                <a href="#">Trang chủ</a>
                            </li>
                            @if(!empty($chuyen_muc->parent->name))
                                <li>
                                   <a href="{{URL::to($chuyen_muc->parent->alias)}}">{{$chuyen_muc->parent->name}}</a> 
                                </li>
=======
@section('content') 
<div class="col-md-9 col-sm-8">
    <div class="main-wrapper">
        <div class="breakcrum">
            <ul>
                <li>
                    <a href="#">Trang chủ</a>
                </li>
                @if(!empty($chuyen_muc->parent->name))
                    <li>
                       <a href="{{URL::to('danh-muc/'.$chuyen_muc->parent->alias)}}">{{$chuyen_muc->parent->name}}</a> 
                    </li>
                @endif
                <li>
                   <a href="#">{{$chuyen_muc->name}}</a> 
                </li>
            </ul>
        </div>
        <h2 class="title-2">
            {{$chuyen_muc->name}}
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
>>>>>>> 2edb44b0b68c847c9af9804e9245765302d73f8d
                            @endif
                            <li>
                               <a href="{{URL::to($chuyen_muc->alias)}}">{{$chuyen_muc->name}}</a> 
                            </li>
                        </ul>
                    </div>
                    <h2 class="title-2">
                        {{$chuyen_muc->name}}
                    </h2>
                    <div class="row san-pham-noi-bat">
                        @foreach($san_pham as $sp1)
                        <div class="col-md-4 col-sm-6 ">
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
        </div>
        <div class="product-paginate">
            <?php echo $san_pham->links(); ?>
        </div>
    </div>
</section>

@stop