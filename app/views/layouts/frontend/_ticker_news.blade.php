<?php
$menu_kinh = MenuKinh::where('state','=',true)->orderBy('order','ASC')->get();
?>

<section class="thong-bao">
        <div class="container">
            <div class="thong-bao-panel">
                <div class="row">
                    <div class="col-md-2 ten">
                        {{HTML::image('/template/minhrayban/images/thong_bao.png','Ptheme Solutions')}} 
                    </div>
                    <div class="col-md-10">
                        <div class="text marquee">
                            <p>
                                {{app('block_html')['chu_chay']}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu-kinh">
                <div class="row">
                    @foreach($menu_kinh as $kinh)
                    <div class="col-md-2 col-sm-3 col-xs-6">
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
        </div>
    </section>