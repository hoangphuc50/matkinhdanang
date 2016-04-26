{{app('block_html')['top_info']}}
    <section class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo">
<<<<<<< HEAD
=======
                        <a href="/">
                            {{HTML::image('template/minhrayban/images/logo.png','Ptheme Solutions')}}    
                        </a>
>>>>>>> 2edb44b0b68c847c9af9804e9245765302d73f8d
                    </div>
                </div>
                <div class="col-md-6 header-right">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 top-search-panel">
<<<<<<< HEAD
                            <!-- <div class="top-search">
                                <form>
                                    <input type="text" class="text-input" name="" placeholder="Nhập từ khóa ...">
=======
                            <div class="top-search">
                                <form action="{{URL::to('tim-kiem')}}" method="GET">
                                    <input type="text" class="text-input" name="search" value="{{Input::get('search')}}" placeholder="Nhập từ khóa ...">
>>>>>>> 2edb44b0b68c847c9af9804e9245765302d73f8d
                                    <button type="submit" value="" class="search-btn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div> -->
                        </div>
                        <!-- <div class="col-md-6 col-sm-6 cart-panel">
                            @include('frontend.cart.list')
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>