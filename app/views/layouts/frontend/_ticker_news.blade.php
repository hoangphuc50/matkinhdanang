<?php
$menu_kinh = MenuKinh::where('state','=',true)->orderBy('order','ASC')->get();
?>


    <div class="menu-kinh">
                <div class="row">
                    @foreach($menu_kinh as $kinh)
                    <div class="col-md-6">
                        <div class="item">
                            <a href="{{$kinh->link}}">
                                <h3>{{$kinh->name}}</h3>
                                {{HTML::image(kinhImageFolder().$kinh->image,$kinh->name)}}
                            </a>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>