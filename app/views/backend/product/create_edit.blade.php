@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
    <h1>Quản lí sản phẩm
        @if(isset($product))
            <small>Chỉnh sửa thông tin</small>
        @else
            <small>Thêm mới</small>
        @endif
    </h1>
    <ol class="breadcrumb">
        <li><a href="/admin"><i class="fa fa-dashboard"></i>Trang chính</a></li>
        <li class="active">Quản lí sản phẩm</li>
    </ol>
    <section class="content">
        <div class="row">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-name">Nhập dữ liệu chính xác vào form bên dưới</h3>
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
                @if(isset($product))
                    {{ Form::model($product, array('url'=>'admin/products/edit','method' => 'POST', 'class'=>'form-horizontal','files'=>true))}}
                    {{Form::hidden('id', $product->id);}}
                @else
                    {{Form::open(array('url' => URL::to('/admin/products/add'),'method' => 'POST','files' => true))}}
                @endif
                
                <div class="box-body">
                    <div class="form-group {{{ $errors->has('name') ? 'has-error' : '' }}}">
                        <label>Tên sản phẩm</label>
                        {{Form::text('name',isset($product) ? $product->name : '', array('class' => 'form-control','placeholder' => 'Nhập tiêu đề cho sản phẩm'))}}
                        {{ $errors->first('name', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="form-group {{{ $errors->has('alias') ? 'has-error' : '' }}}">
                        <label>Alias</label>
                        {{Form::text('alias',isset($product) ? $product->alias : '', array('class' => 'form-control','placeholder' => 'Nhập alias (dùng cho seo)'))}}
                        {{ $errors->first('alias', '<span class="help-block">:message</span>') }}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{{ $errors->has('image') ? 'has-error' : '' }}}">
                                <label>Hình đại diện</label>
                                @if(empty($product->image))
                                    {{HTML::image('images/no_image.jpg','',array('class'=>'no-image'))}}
                                @else
                                    {{HTML::image(productImageFolder().$product->image,'')}}
                                @endif
                                
                                {{ Form::file('image','',array('id'=>'','class'=>'')) }}
                                {{ $errors->first('image', '<span class="help-block">:message</span>') }}
                            </div>
                            

                            <div class="form-group {{{ $errors->has('images') ? 'has-error' : '' }}}">
                                @if(!isset($product))
                                <label>Hình sản phẩm (có thể upload nhiều hình)</label>                
                                {{ Form::file('images[]',array('multiple'=>true)) }}
                                {{ $errors->first('images', '<span class="help-block">:message</span>') }}

                                @else
                                <div class="form-group {{{ $errors->has('images') ? 'has-error' : '' }}}">
                                    <label>Hình sản phẩm (có thể upload nhiều hình)</label>   
                                    <div style="padding-bottom:15px">
                                        @foreach($product->images as $item)
                                            <div class="product-images">
                                                {{HTML::image(productImageFolder().'/thumb/'.$item->url,'')}}
                                            </div>
                                        @endforeach 
                                    </div>
                                    <a class="btn btn-success" href="/admin/products/images/{{$product->id}}">Thay đổi hình sản phẩm</a>        
                                    
                                </div>
                                @endif
                            </div>
                            <div class="form-group {{{ $errors->has('price') ? 'has-error' : '' }}}">
                                <label>Giá hiện tại</label>
                                {{Form::text('price',isset($product) ? $product->price : '', array('class' => 'form-control','placeholder' => 'Nhập giá cho sản phẩm'))}}
                                {{ $errors->first('price', '<span class="help-block">:message</span>') }}
                            </div>

                            <div class="form-group {{{ $errors->has('old_price') ? 'has-error' : '' }}}">
                                <label>Giá cũ</label>
                                {{Form::text('old_price',isset($product) ? $product->old_price : '', array('class' => 'form-control','placeholder' => 'Nhập giá cũ cho sản phẩm'))}}
                                {{ $errors->first('ũ', '<span class="help-block">:message</span>') }}
                            </div>
                            <div class="form-group">
                                <label>Hiển thị giá</label>
                                <br>
                                <div class="form-radio">
                                    <label>
                                    {{Form::radio('public_price',true,true,array())}}
                                    Có&nbsp;&nbsp;&nbsp;
                                    </label>
                                    <label>
                                        {{Form::radio('public_price',false,false,array())}}
                                        Không
                                    </label>       
                                </div>
                                          
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{{ $errors->has('product_id') ? 'has-error' : '' }}}">
                                <label>Mã sản phẩm</label>
                                {{Form::text('product_id',isset($product) ? $product->product_id : '', array('class' => 'form-control','placeholder' => 'Nhập mã cho sản phẩm'))}}
                                {{ $errors->first('product_id', '<span class="help-block">:message</span>') }}
                            </div>

                             <div class="form-group {{{ $errors->has('category_id') ? 'has-error' : '' }}}">
                                <label>Thuộc chuyên mục</label>
                                    <select multiple="multiple" name="category_id" class="form-control category-select">
                                        <option value="" class="optionGroup">Không chọn</option>
                                        @if(isset($product))
                                            <?php
                                                $category = ProductCategory::where('product_id','=',$product->id)->first();
                                                if(empty($category)){
                                                    $category_id = "";
                                                }else{
                                                    $category_id = $category->category_id;
                                                }
                                            ?>
                                            @foreach($categories as $item)
                                                <option value="{{$item->id}}" <?php if($category_id == $item->id) echo 'selected="selected"'?> class="optionGroup">{{$item->name}}</option>
                                                @foreach($item['children'] as $child)
                                                    <option value="{{$child->id}}" <?php if($category_id == $child->id) echo 'selected="selected"'?> class="optionChild">{{$child->name}}</option>
                                                    @foreach($child['children'] as $child_2)
                                                        <option value="{{$child_2->id}}" <?php if($category_id == $child_2->id) echo 'selected="selected"'?> class="optionChild2">{{$child_2->name}}</option>
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
                                  {{ $errors->first('category_id', '<span class="help-block">Bài viết phải thuộc ít nhất 1 chuyên mục. Vui lòng chọn chuyên mục.</span>') }}  

                            </div>
                            <div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
                                <label>Giới thiệu ngắn</label>
                                {{Form::textarea('description',Input::old('description'), array('class' => 'form-control','placeholder' => 'Giới thiệu nên ngắn gọn xúc tích tạo cảm hứng cho người đọc'))}}
                                {{ $errors->first('description', '<span class="help-block">:message</span>') }}
                            </div>
                        </div>
                    </div>
            
                    <div class="form-group {{{ $errors->has('feature') ? 'has-error' : '' }}}">
                        <label>Đặc trưng sản phẩm</label>
                        <?php
                            $feature = '<table class="format_table" style="border-collapse:collapse; border-spacing:0px; color:rgb(68, 68, 68) !important; font-family:segoe ui,tahoma,arial,helvetica,sans-serif !important; font-size:15px !important; line-height:20px; margin-bottom:10px !important; margin-top:10px !important; max-width:100%; width:852px">
                                <tbody>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Loại sản phẩm</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">Kính mắt</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Nhãn hiệu</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">Thương hiệu nổi tiếng nước Ý&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Model</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">RB01</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Đối tượng</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">Nam, Nữ</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Chất liệu</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">Mắt kính tráng gương cao cấp chống xước tốt. Gọng kim loại mạ vàng bọc inon sáng bóng.</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Màu gọng kính</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">Màu vàng sang trọng bọc mắt kính phản chiếu bền đẹp</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Màu mắt kính</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">Xanh lá, Xanh lam, Da cam</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Thiết kế</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">Mới lạ, độc đáo, thời trang, và sang trọng</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Kiểu dáng</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">Mắt kính aviator thời trang ôm sát khôn mặt</td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align:text-top !important; width:120px !important">&nbsp;Sản phẩm gồm</td>
                                        <td style="vertical-align:text-top !important; width:15px">:</td>
                                        <td style="text-align:justify !important; vertical-align:text-top !important">01 Kính mắt thời trang cao cấp RB01 + 01 hộp đựng sản phẩm + bộ phụ kiện</td>
                                    </tr>
                                </tbody>
                            </table>';
                            if(isset($product)){
                                $feature = $product->feature;
                            }
                        ?>
                        {{Form::textarea('feature',empty(Input::old('feature')) ? $feature : Input::old('feature'), array('id'=>'editor', 'class' => 'form-control use_editor','placeholder' => 'Nội dung'))}}
                        {{ $errors->first('feature', '<span class="help-block">:message</span>') }}
                    </div>

                    <div class="form-group {{{ $errors->has('content') ? 'has-error' : '' }}}">
                        <label>Sản phẩm chi tiết</label>
                        <?php
                            $content = '';
                            if(isset($product)){
                                $content = $product->content;
                            }
                        ?>
                        {{Form::textarea('content',empty(Input::old('content')) ? $content : Input::old('content'), array('id'=>'editor_2', 'class' => 'form-control use_editor','placeholder' => 'Nội dung'))}}
                        {{ $errors->first('content', '<span class="help-block">:message</span>') }}
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

@section('js')
    @include('layouts.backend._load_editor')
@stop
