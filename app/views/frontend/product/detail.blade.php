@extends('layouts.frontend.layout')

@section('content')
<div class="col-md-9 col-sm-8">
    <div class="main-wrapper">
        <div class="breakcrum">
            <ul>
                <li>
                    <a href="#">Trang chủ</a>
                </li>
                <li>
                    @foreach($san_pham->categories as $category)
                    <a href="{{URL::to('danh-muc/'.$category->id)}}">{{$category->name}}</a>
                    @endforeach
                    
                </li>
            </ul>
        </div>
        <div class="intro-panel">
            <div class="row">
                <div class="col-md-7">
                    <div class="product-img">
                        {{HTML::image(!empty($san_pham->image) ? productImageFolder().$san_pham->image : "/images/no_image.jpg",$san_pham->name)}}
                    </div>
                </div>
                <div class="col-md-5 product-info">
                    <h1>{{$san_pham->name}}</h1>
                    <p>
                        {{$san_pham->description}}
                    </p>
                    <div class="price-panel">
                        @if($san_pham->public_price == true and $san_pham->price > 0)
                        <span class="old-price">
                            @if(!empty($san_pham->old_price))
                            {{displayPrice($san_pham->old_price)}} đ
                            @endif
                        </span>
                        <span class="price">
                            {{displayPrice($san_pham->price)}} đ
                        </span>
                        @else
                        <span class="price">
                            Liên hệ shop
                        </span>
                        @endif
                        <div class="buy-panel">
                            <div class="add-cart">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="number">
                                Số lượng
                                <div class="up-down">
                                    <form action="{{URL::to('cart/add')}}" method="POST" class="add-cart-form"> 
                                    <div class="minus"></div>
                                    <input type="text" class="num" name="number_of_item" value="1">
                                    {{Form::hidden('product_id', $san_pham->id,array('class'=>"product_id"))}}
                                    <div class="plus"></div>
                                    </form>
                                </div>
                                <h3>Mua hàng</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h2 class="title">Chi tiết</h2>
            <div class="line"></div>
            <div class="product-content">
                <div class="product-images">
                    @foreach($san_pham->images as $image)
                    <a class="gallery-item" title="{{$image->name}}" href="{{URL::to(productImageFolder().$image->url)}}">
                        {{HTML::image(productImageFolder().'/thumb/'.$image->url,$image->name)}}
                    </a>
                    @endforeach                    
                </div>
                <h2 class="content-title">
                        Đặc trưng sản phẩm
                    </h2>
                {{$san_pham->feature}}
                <h2 class="content-title">
                        Thông tin chi tiết
                    </h2>
                {{$san_pham->content}}
                <h2 class="content-title">
                        Gửi nhận hàng
                    </h2>
                <p>
                    • Chúng tôi MIỄN PHÍ giao hàng toàn quốc ( Trong khi các Shop khác vẫn thu phí vận chuyển từ 20.000 – 50.000).
                    <br> • Được đổi trả sản phẩm trong vòng 7 ngày, quy định đổi trả hàng xem chi tiết TẠI ĐÂY.
                    <br> • GIẢM NGAY 5% - 10% khi khách hàng mua thành công từ sản phẩm thứ 2
                </p>
                <p>
                    Chủ Tài Khoản Nguyễn Hữu Minh ( Chi Nhánh Ngân Hàng Hồ Chí Minh )
                    <br> Techcombank ( gửi miễn phí ) : 1402 0154 4540 24
                    <br> Vietcombank ( gửi miễn phí ) : 0251 0026 7134 9
                    <br> Maritimebank ( gửi miễn phí ) : 0400 1010 9739 11
                </p>
                <p>
                    -Mình đã đăng kí SMS Banking ,các bạn vừa chuyển tiền là mình nhận được ngay tin nhắn của Ngân hàng .Nên mình sẽ gửi hàng ngay trong ngày .
                </p>
                <div href="#" id="dat_hang_ngay" class="dat-hang-ngay"><i class="fa fa-shopping-cart"></i> Đặt hàng ngay</div>
            </div>
            <div class="cam-ket">
                <h2>Cam kết của chúng tôi</h2>
                <p>
                    • Mắt Kính MINHRAYBAN cam kết không bán sản phẩm kém chất lượng, tất cả hình ảnh sản phẩm đều là do chúng tôi tự chụp từ chính sản phẩm thật, quý khách sẽ mua được chính xác những gì đang xem.
                    <br> • Quý khách được miễn phí vận chuyển và kiểm tra sản phẩm trước khi thanh toán.
                    <br> • Ngoài ra Mắt Kính MINHRAYBAN có chương trình ưu đãi đặc biệt ReBuying dành cho khách hàng thành viên. Quý khách có thể xem chi tiết tại đây
                    <br>
                </p>
            </div>
            <div class="related-product">
                <h2 class="title">Sản phẩm liên quan</h2>
                <div class="line"></div>
                <div class="row san-pham-noi-bat">
                    @foreach($san_pham_lien_quan as $sp1)
                    <div class="col-md-4 col-sm-6 ">
                        <div class="product-item">
                            <a href="{{URL::to('san-pham/'.$sp1->id)}}">
                                {{HTML::image(!empty($sp1->image) ? productImageFolder().$sp1->image : "/images/no_image.jpg",$sp1->name)}}
                                <h3>{{$sp1->name}} </h3>
                                <p class="price">
                                    @if($sp1->public_price == true and $sp1->price > 0)
                                        @if(!empty($sp1->old_price))
                                            <span>{{displayPrice($sp1->old_price)}} đ</span>
                                        @endif
                                    {{displayPrice($sp1->price)}} đ
                                    @else
                                        Liên hệ shop
                                    @endif
                                </p>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@stop