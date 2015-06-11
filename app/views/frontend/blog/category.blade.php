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
            </div>
            @endforeach
            
        </div>
        <div class="product-paginate">
            <?php echo $bai_viet->appends(Input::only('search'))->links(); ?>
        </div>
    </div>
</div>
@stop