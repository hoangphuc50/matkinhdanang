{{app('block_html')['top_info']}}
    <section class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo">
                        <a href="#">
                            {{HTML::image('template/minhrayban/images/logo.png','Ptheme Solutions')}}    
                        </a>
                    </div>
                </div>
                <div class="col-md-6 header-right">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 top-search-panel">
                            <div class="top-search">
                                <form>
                                    <input type="text" class="text-input" name="" placeholder="Nhập từ khóa ...">
                                    <button type="submit" value="" class="search-btn">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 cart-panel">
                            @include('frontend.cart.list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>