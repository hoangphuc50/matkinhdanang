@extends('layouts.backend.layout')

@section('content')
<aside class="right-side">
    <!-- Content Header (Page header) -->


    <section class="content-header">
        <h1>Quản lí bài viết                     
        <small>Danh sách tất cả</small>
    </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i>Trang chính</a>
            </li>
            <li class="active">Danh sách bài viết</li>
        </ol>
        <br>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="{{URL::to('/admin/blogs/add')}}" class="btn btn-success">Thêm mới</a></h3>
                        <div class="box-tools">
                            <form action="/admin/blogs" method="get">
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
                                    <th>{{adminSort("Tiêu đề","title")}}
                                    </th>
                                    <th style="width:43%">
                                        {{adminSort("Chuyên mục","title")}}
                                    </th>
                                    <th style="width:85px">{{adminSort("Trạng thái","state")}}
                                    </th>
                                    <th style="width:85px">{{adminSort("Nổi bật","highlight")}}
                                    </th>
                                    <th style="width: 130px">Thao tác</th>
                                </tr>
                                @foreach($blogs as $blog)
                                <tr>
                                    <td>
                                       {{$blog->id}}

                                    </td>
                                    <td><a href="/admin/blogs/detail/{{$blog->id}}">{{$blog->title}}</a>
                                    </td>
                                    <td>
                                        <?php
                                        $category = BlogCategory::where('blog_id','=',$blog->id)->get();
                                        ?>
                                        @foreach($category as $row)
                                            <span>{{$row->category->name}}, </span>
                                        @endforeach
                                    </td>
                                    <td>
                                        @if($blog->state == true)
                                        <span class="label label-success">Hiển thị</span>
                                        @else
                                        <span class="label label-default">Đang ẩn</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if($blog->highlight == true)
                                        <span class="label label-danger">Nổi bật</span>
                                        @endif
                                    </td>
                                    
                                    <td><a href="/admin/blogs/edit/{{$blog->id}}" class="btn btn-primary">Sửa</a>

                                        <a href="/admin/blogs/delete/{{$blog->id}}" onclick="return confirm('Bạn có chắc muốn xóa')" class="btn btn-default">Xóa</a>
                                    </td>
                                </tr>
                                @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix">
                       <?php echo $blogs->appends(Input::only('search','option','per_page','sort','order'))->links(); ?>
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