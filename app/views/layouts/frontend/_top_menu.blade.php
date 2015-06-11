<?php
    $main_menu = Category::tree("menu");
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
                            <a href="/" class="active">Trang chủ
                            </a>
                        </li>
                        @foreach($main_menu as $menu)
                            <li>
                                <a href="{{URL::to('danh-muc/'.$menu->alias)}}">{{$menu->name}}
                                </a>
                                @if(count($menu['children'])>0)
                                <ul>
                                    @foreach($menu['children'] as $menu_child)
                                        <li>
                                            <a href="{{URL::to('danh-muc/'.$menu_child->alias)}}" class="active">{{$menu_child->name}}
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
                    <a href="{{URL::to('danh-muc/'.$menu->alias)}}">{{$menu->name}}
                    </a>
                    @if(count($menu['children'])>0)
                    <ul>
                        @foreach($menu['children'] as $menu_child)
                            <li>
                                <a href="{{URL::to('danh-muc/'.$menu_child->alias)}}" class="active">{{$menu_child->name}}
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