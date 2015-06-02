<section class="top-menu">
        <div class="container">
            <div class="row">
            <div class="col-md-3 text-left">
                <a href="#">
                <i class="fa fa-facebook"></i> Kết nối mạng xã hội
                </a>
            </div>
            <div class="col-md-6 text-center">
                <i class="fa fa-truck"></i> <b>Miễn phí </b>vận chuyển trong nội thành Hồ Chí Minh & toàn quốc
            </div>
            <div class="col-md-3 text-right">
                <i class="fa fa-phone"></i> (+84)907 72 75 99</div>
            </div>
        </div>
    </section>
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