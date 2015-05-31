@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
        <h1>Quản lí block HTML                  
        <small>Danh sách block</small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Trang chính</a>
            </li>
            <li class="active">Danh sách block html</li>
        </ol>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{URL::to('/admin/block_htmls/add')}}" class="btn btn-success">Thêm mới</a></h3>
                        <div class="box-tools">
                            <form action="/admin/block_htmls" method="get">
                                <div class="input-group">

                                    <input type="text" id="search" name="search" placeholder="Nhập tên tiếng việt và nhấn Enter" value="" class="form-control input-sm pull-right" style="width: 200px;">
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
                                    <th>{{adminSort("Tên block","name")}}
                                    </th>
                                    <th>{{adminSort("Vị trí","position")}}
                                    </th>
                                    <th>Sắp xếp
                                    </th>
                                    <th>Link
                                    </th>
                                    <th style="width:85px">{{adminSort("Trạng thái","state")}}
                                    </th>
                                    <th style="width:85px">{{adminSort("Nổi bật","highlight")}}
                                    </th>
                                    <th style="width: 130px">Thao tác</th>
                                </tr>
                                @foreach($block_htmls as $block_html)
                                <tr>
                                    <td>
                                       {{$block_html->id}}

                                    </td>
                                    <td>{{$block_html->name}}
                                    </td>
                                     <td>{{$block_html->position}}
                                    </td>
                                     <td>{{$block_html->order}}
                                    </td>
                                     <td>{{$block_html->link}}
                                    </td>
                                    <td>
                                        @if($block_html->state == true)
                                        <span class="label label-success">Hiển thị</span>
                                        @else
                                        <span class="label label-default">Đang ẩn</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($block_html->highlight == true)
                                        <span class="label label-danger">Nổi bật</span>
                                        @endif
                                    </td>
                                    
                                    <td><a href="/admin/block_htmls/edit/{{$block_html->id}}" class="btn btn-primary">Sửa</a>

                                        <a href="/admin/block_htmls/delete/{{$block_html->id}}" onclick="return confirm('Bạn có chắc muốn xóa')" class="btn btn-default">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                       <?php echo $block_htmls->appends(Input::only('search','option','per_page','sort','order'))->links(); ?>
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