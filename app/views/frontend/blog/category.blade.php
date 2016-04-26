<?php 
    $web_title = $chuyen_muc->name;
    $web_description = $chuyen_muc->description;
    $web_image = '';
?>
@extends('layouts.frontend.layout')

@section('content') 
<<<<<<< HEAD
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
                            @endif
                            <li>
                               <a href="{{URL::to($chuyen_muc->alias)}}">{{$chuyen_muc->name}}</a> 
                            </li>
                        </ul>
                    </div>
                    <h2 class="title-2">
                        {{$chuyen_muc->name}}
                    </h2>
                    <div class=" san-pham-noi-bat">
                        @foreach($bai_viet as $sp1)
                        <div class="blog-item">
                            <a href="{{URL::to('bai-viet/'.$sp1->alias)}}">
                                <h3>{{$sp1->title}} </h3>      
                            </a>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
=======
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
        <div class=" san-pham-noi-bat">
            @foreach($bai_viet as $sp1)
            <div class="blog-item">
                <a href="{{URL::to('bai-viet/'.$sp1->alias)}}">
                    <h3>{{$sp1->title}} </h3>      
                </a>
>>>>>>> 2edb44b0b68c847c9af9804e9245765302d73f8d
            </div>
        </div>
        <div class="product-paginate">
            <?php echo $bai_viet->appends(Input::only('search'))->links(); ?>
        </div>
    </div>
</section>
@stop