@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
        <h1>Quản lí sản phẩm                     
        <small>Danh sách tất cả</small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Trang chính</a>
            </li>
            <li class="active">Danh sách sản phẩm</li>
        </ol>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{URL::to('/admin/products/add')}}" class="btn btn-success">Thêm mới</a></h3>
                        <div class="box-tools">
                            <form action="/admin/products" method="get">
                                <div class="input-group">

                                    <input type="text" id="search" name="search" placeholder="Nhập tiếng việt và nhấn Enter" value="{{Input::get('search')}}" class="form-control input-sm pull-right" style="width: 200px;">
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i>
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                                Kiểm tra lại dữ liệu nhập vào
                            </div>
                        @endif

                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> Lỗi!</h4>
                                {{Session::get('error_message')}}
                            </div>
                        @endif

                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4>    <i class="icon fa fa-check"></i> Thành công!</h4>
                            {{Session::get('success_message')}}
                        </div>
                        @endif
                        
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <th style="width:3%">{{adminSort("ID","id")}}
                                    </th>
                                    <th style="width:3%">Mã
                                    </th>
                                    <th>{{adminSort("Tiêu đề","name")}}
                                    </th>
                                    <th>{{adminSort("Giá","price")}}
                                    </th>
                                    <th style="width:20%">
                                        {{adminSort("Chuyên mục","id")}}
                                    </th>
                                    <th style="width:85px">{{adminSort("Trạng thái","state")}}
                                    </th>
                                    <th style="width:85px">{{adminSort("Nổi bật","highlight")}}
                                    </th>
                                    <th style="width: 175px">Thao tác</th>
                                </tr>
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                       {{$product->id}}

                                    </td>
                                    <td>
                                       {{$product->product_id}}

                                    </td>
                                    <td><a href="/admin/products/edit/{{$product->id}}">{{$product->name}}</a>
                                    </td>
                                    <td><span class="price">{{$product->price}} đ</span> <span class="old-price">{{$product->old_price}} đ</span>
                                    </td>
                                    <td>
                                        <?php
                                        $category = ProductCategory::where('product_id','=',$product->id)->get();
                                        ?>
                                        @foreach($category as $row)
                                            <span>{{$row->category->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($product->state == true)
                                        <span class="label label-success">Hiển thị</span>
                                        @else
                                        <span class="label label-default">Đang ẩn</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($product->highlight == true)
                                        <span class="label label-danger">Nổi bật</span>
                                        @endif
                                    </td>
                                    
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default" data-toggle="dropdown">Mở rộng</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu">
                                                
                                                <li><a href="/admin/products/edit/{{$product->id}}">Sửa thông tin</a></li>
                                                <li class="divider"></li>
                                                <li><a href="/admin/products/images/{{$product->id}}">Hình sản phẩm</a></li>
                                                
                                            </ul>
                                        </div>

                                        <a href="/admin/products/delete/{{$product->id}}" onclick="return confirm('Bạn có chắc muốn xóa')" class="btn btn-default">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                       <?php echo $products->appends(Input::only('search','option','per_page','sort','order'))->links(); ?>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">


    </section>
    <!-- /.content -->
</aside>

@stop