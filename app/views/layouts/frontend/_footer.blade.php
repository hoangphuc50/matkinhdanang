<section class="footer">
        <div class="container">
            <div class="cua-hang">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-info">
                            {{HTML::image('template/minhrayban/images/footer_logo.png','Ptheme Solutions')}} 
                            {{app('block_html')['footer_info']}}
                        </div>
                        
                    </div>
                    <div class="col-md-4">
                        {{app('block_html')['danh_cho_nguoi_mua']}}
                    </div>
                    <div class="col-md-2">
                        {{app('block_html')['gioi_thieu']}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{app('block_html')['copyright']}}