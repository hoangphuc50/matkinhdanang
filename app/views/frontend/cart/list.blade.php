<?php
    $cart = Cart::instance('shopping')->content();
?>
@if(count($cart) > 0)
    <div class="cart pull-left">
        <h2>Giỏ hàng</h2>
        <a href="#" class="open-shopping-cart" id="open-shopping-cart">
            <i class="fa fa-shopping-cart"></i>
            <span class="text">
                <span id="cart-total">{{count($cart)}} sản phẩm</span>
            </span>
        </a>
        <div class="wow fadeIn popup-shopping-cart" id="popup-shopping-cart">
            <div class="shopping-cart-list-product">
                <table>
                    @foreach($cart as $row)
                    <tbody>
                        <tr>
                            <td class="product-name">{{$row->name}}</td>
                            <td class="product-qty">{{$row->qty}}</td>
                            <td class="product-total-price">{{$row->price}} đ</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>

            <div class="shopping-cart-total">
                <p class="total">Tổng cộng: {{Cart::instance('shopping')->total();}} đ</p>
                <div class="wrap-btn">
                    <a href="/cart" class="btn">Đặt hàng ngay</a>
                    <a href="/cart/destroy" class="btn" style="background:#F4A137">Hủy giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
    <div class="tong-cong  pull-left">
        <h2>Tổng cộng</h2>
        <h3>{{Cart::instance('shopping')->total();}} đ</h3>
    </div>
@else
    <div class="cart pull-left">
        <h2>Giỏ hàng</h2>
        <a href="#" class="open-shopping-cart" id="open-shopping-cart">
            <i class="fa fa-shopping-cart"></i>
            <span class="text">
                <span id="cart-total">0 sản phẩm</span>
            </span>
        </a>
    </div>
    <div class="tong-cong  pull-left">
        <h2>Tổng cộng</h2>
        <h3>0.000.000 đ</h3>
    </div>
@endif
