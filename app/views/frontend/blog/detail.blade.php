@extends('layouts.frontend.layout')

@section('content')
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
            <h1>
                {{$bai_viet->title}}
            </h1>
            {{$bai_viet->content}}
        </div>
    </div>
</div>
@stop