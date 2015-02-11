            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            {{HTML::image('backend/template/AdminLTE/img/avatar3.png','',array("class"=>"img-circle"))}}
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Admin</p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="../index.html">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('/admin/categories')}}">
                                <i class="fa fa-university"></i>
                                <span>Chuyên mục - menu</span>
                               
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('/admin/blogs')}}">
                                <i class="fa fa-newspaper-o"></i> <span>Bài viết</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('/admin/products')}}">
                                <i class="fa fa-coffee"></i>
                                <span>Sản phẩm</span>
                               
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('/admin/orders')}}">
                               <i class="fa fa-car"></i>
                                <span>Đơn hàng</span>
                               
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('/admin/members')}}">
                                <i class="fa fa-cubes"></i>
                                <span>Người dùng</span>
                               
                            </a>
                        </li>

                        <li>
                            <a href="{{URL::to('/admin/photos')}}">
                                <i class="fa fa-picture-o"></i>
                                <span>Hình ảnh</span>
                               
                            </a>
                        </li>
                        <li>
                            <a href="{{URL::to('/admin/blocks')}}">
                                <i class="fa fa-file-code-o"></i>
                                <span>Block HTML</span>
                               
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i> <span>Tài khoản</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Đổi mật khẩu</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Đổi thông tin</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> Thoát</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>