<?php 
    $web_title = $bai_viet->title;
    $web_description = $bai_viet->description;
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
                            @foreach($bai_viet->categories()->get() as $category)
                            <li>
                               <a href="#">{{$category->name}}</a> 
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="intro-panel blog-detail">
                        <h2 class="title-2">
                            {{$bai_viet->title}}
                        </h2>
                        {{$bai_viet->content}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop