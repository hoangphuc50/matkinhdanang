@extends('layouts.frontend.layout')

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
                       <a href="#">{{$chuyen_muc->parent->name}}</a> 
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
            @foreach($bai_viet as $sp1)
            <div class="col-md-6 col-sm-6 ">
                <div class="product-item">
                    <a href="{{URL::to('bai-viet/'.$sp1->id)}}">
                        {{HTML::image(!empty($sp1->image) ? blogImageFolder().$sp1->image : "/images/no_image.jpg",$sp1->title)}}
                        <h3>{{$sp1->title}} </h3>
                        
                    </a>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</div>
@stop