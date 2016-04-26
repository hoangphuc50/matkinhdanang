<?php
    $main_menu = Category::tree("menu");
     $categories = Category::tree("product");
?>
<section class="main-menu">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mobile-btn">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="navigation">
                    <ul>
                        <li>
                            
                                <div class="dn-logo">
                                    <a href="/">
                                    {{HTML::image('template/minhrayban/images/logo.png','Ptheme Solutions')}}  
                                    </a>
                                </div>
                            
                        </li>
                        <li>
                            <a href="/" class="active">Trang chủ
                            </a>
                        </li>
                        <li><a href="/">Chọn Mắt kính</a>
                            <ul>
                                @foreach($categories as $category)
                                <li>

                                <a href="{{URL::to($category->alias)}}" class="active">{{$category->name}}
                                </a>

                                <ul>
                                    @foreach($category['children'] as $category_child)
                                    <li>
                                        <a href="{{URL::to($category_child->alias)}}">{{$category_child->name}}
                                        </a>
                                        @if(count($category_child['children'])>0)
                                            <ul>
                                                @foreach($category_child['children'] as $category_child_2)
                                                <li>
                                                    <a href="{{URL::to($category_child_2->alias)}}">{{$category_child_2->name}}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                                </li>
                            @endforeach
                            </ul>

                        </li>

                        @foreach($main_menu as $menu)
                            <li>
                                <a href="{{URL::to($menu->alias)}}">{{$menu->name}}
                                </a>
                                @if(count($menu['children'])>0)
                                <ul>
                                    @foreach($menu['children'] as $menu_child)
                                        <li>
                                            <a href="{{URL::to($menu_child->alias)}}" class="active">{{$menu_child->name}}
                                            </a>
                                        </li>  
                                    @endforeach
                                </ul>
                                @endif
                            </li>  
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mobile-menu">
    <div class="container">
        <ul>
            <li>
                <a href="/" class="active">Trang chủ
                </a>
            </li>
            @foreach($main_menu as $menu)
                <li>
                    <a href="{{URL::to($menu->alias)}}">{{$menu->name}}
                    </a>
                    @if(count($menu['children'])>0)
                    <ul>
                        @foreach($menu['children'] as $menu_child)
                            <li>
                                <a href="{{URL::to($menu_child->alias)}}" class="active">{{$menu_child->name}}
                                </a>
                            </li>  
                        @endforeach
                    </ul>
                    @endif
                </li>  
            @endforeach
        </ul>
    </div>
</section>