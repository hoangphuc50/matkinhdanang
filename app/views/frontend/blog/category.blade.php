<?php 
    $web_title = $chuyen_muc->name;
    $web_description = $chuyen_muc->description;
    $web_image = '';
?>
@extends('layouts.frontend.layout')

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
            </div>
        </div>
    </div>
</section>
@stop