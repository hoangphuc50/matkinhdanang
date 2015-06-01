@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí chuyên mục, menu
        @if(isset($category))
            <small>Chỉnh sửa thông tin</small>
        @else
            <small>Thêm mới</small>
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí chuyên mục</li>
    </ol>
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Nhập dữ liệu chính xác vào form bên dưới</h3>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                        Kiểm tra lại dữ liệu nhập vào
                    </div>
                @endif
                <!-- /.box-header -->
                <!-- form start -->
                @if(isset($category))
                    {{ Form::model($category, array('url'=>'admin/categories/edit','method' => 'POST', 'class'=>'form-horizontal','files'=>true))}}
                    {{Form::hidden('id', $category->id);}}
                @else
                    {{Form::open(array('url' => URL::to('/admin/categories/add'),'method' => 'POST','files' => true))}}
                @endif
                
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label>Tên chuyên mục</label>
                        {{Form::text('name',isset($category) ? $category->name : '', array('class' => 'form-control','placeholder' => 'Tên danh mục'))}}
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>

                    <div class="form-group">
                        <label>Chọn chuyên mục cha (nếu có)</label>
                        <select multiple="multiple" name="parent_id" class="form-control category-select">
                            <option value="" class="optionGroup">Không chọn</option>
                            @if(isset($category))
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}" <?php if($item->id == $category->parent_id) echo 'selected="selected"'?> class="optionGroup">{{$item->name}}</option>
                                    @foreach($item['children'] as $child)
                                        <option value="{{$child->id}}" <?php if($child->id == $category->parent_id) echo 'selected="selected"'?> class="optionChild">{{$child->name}}</option>

                                        @foreach($child['children'] as $child_2)
                                            <option value="{{$child_2->id}}" <?php if($category->parent_id == $child_2->id) echo 'selected="selected"'?> class="optionChild2">{{$child_2->name}}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @else
                                @foreach($categories as $item)
                                    <option value="{{$item->id}}" class="optionGroup">{{$item->name}}</option>
                                    @foreach($item['children'] as $child)
                                        <option value="{{$child->id}}" class="optionChild">{{$child->name}}</option>
                                        @foreach($child['children'] as $child_2)
                                            <option value="{{$child_2->id}}" class="optionChild2">{{$child_2->name}}</option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endif
                            
                        </select>
                    </div>
                    <div class="form-group {{{ $errors->has('image') ? 'has-error' : '' }}}">
                        <label>Hình đại diện</label>
                        @if(empty($category->image))
                            {{HTML::image('images/no_image.jpg','',array('class'=>'no-image'))}}
                        @else
                            {{HTML::image($category->image,'')}}
                        @endif
                        
                        {{ Form::file('image','',array('id'=>'','class'=>'')) }}
                        {{ $errors->first('image', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('short_description') ? 'has-error' : '' }}}">
                        <label>Giới thiệu ngắn</label>
                        {{Form::text('short_description',isset($category) ? $category->short_description : '', array('class' => 'form-control','placeholder' => 'Giới thiệu ngắn'))}}
                        {{ $errors->first('short_description', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('link') ? 'has-error' : '' }}}">
                        <label>Link</label>
                        {{Form::text('link',isset($category) ? $category->link : '', array('class' => 'form-control','placeholder' => 'Link khi click vô menu'))}}
                        {{ $errors->first('link', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
                        <label>Giới thiệu</label>
                        {{Form::textarea('description',isset($category) ? $category->description : '', array('class' => 'form-control','placeholder' => 'Giới thiệu'))}}
                        {{ $errors->first('description', '<span class="help-block">:message</span>') }}
                    </div>

                    <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                        <label>Nội dung</label>
                        {{Form::textarea('content',isset($category) ? $category->content : '', array('id'=>'editor', 'class' => 'form-control use_editor','placeholder' => 'Giới thiệu'))}}
                        {{ $errors->first('content', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('order') ? 'has-error' : '' }}}">
                        <label>Thứ tự sắp xếp (nếu có)</label>
                        {{Form::text('order',isset($category) ? $category->order : '', array('class' => 'form-control','placeholder' => 'Thứ tự sắp xếp'))}}
                        {{ $errors->first('order', '<span class="help-block">:message</span>') }}
                    </div>

                    <div class="form-group {{{ $errors->has('category_type') ? 'has-error' : '' }}}">
                        <label>Loại chuyên mục</label>       
                        {{ Form::select('category_type', array('' => 'Chọn loại danh mục', 'menu' => 'Menu', 'product' => 'Danh mục sản phẩm','blog' => 'Danh mục bài viết'), Input::old('category_type', isset($category) ? $category->category_type : ''), array('class' => 'form-control')) }}
                        {{ $errors->first('category_type', '<span class="help-block">:message</span>') }}
                    </div>

                    <div class="form-group">
                        <label>Hiển thị</label>
                        <br>
                        <div class="form-radio">
                            <label>
                            {{Form::radio('state',true,true,array())}}
                            Có&nbsp;&nbsp;&nbsp;
                            </label>
                            <label>
                                {{Form::radio('state',false,false,array())}}
                                Không
                            </label>       
                        </div>
                                  
                    </div>
                    <div class="form-group">
                        <label>Nổi bật</label>
                        <br>
                        <div class="form-radio">
                            <label>
                                {{Form::radio('highlight',true,false,array())}}
                                Có&nbsp;&nbsp;&nbsp;
                            </label>
                            <label>
                                {{Form::radio('highlight',false,true,array())}}
                                Không
                            </label>  
                        </div>               
                    </div>
                </div>
                <div class="box-footer">
                    {{Form::submit('Cập nhật', array('class' => 'btn btn-primary'))}}
                </div>
                {{Form::close()}}

         </div>
        </div>
    </section>
</section>
</aside>
@stop

@section('css')
    
@stop
@section('js')
    @include('layouts.backend._load_editor')
@stop
