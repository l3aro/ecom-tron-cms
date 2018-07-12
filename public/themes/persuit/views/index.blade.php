<!--================Home Left Menu Area =================-->
<div class="home_left_main_area">
    <div class="left_menu">
        <div class="offcanvas_fixed_menu">
            <a class="logo_offcanvas" href="#"><img src="@asset('img/logo-white.png')" alt=""></a>
            <div class="input-group search_form">
                <input type="text" class="form-control" placeholder="Tìm kiếm" aria-label="Search" name="keyword">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="button"><i class="icon-magnifier icons"></i></button>
                </span>
            </div>
            <div class="offcanvas_menu">
                <ul class="nav flex-column">
                @if (Theme::bind('menu'))
                @foreach (Theme::bind('menu') as $option)
                @if (!$option->sub)
                    <li class="nav-item"><a class="nav-link" href="{{$option->link}}">{{$option->name}}</a></li>
                @else
                    <li class="dropdown side_menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{$option->name}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                            <ul class="dropdown-menu">
                            @foreach($option->sub as $sub_option)
                                <li class="nav-item"><a class="nav-link" href="{{$sub_option->link}}">{{$sub_option->name}}</a></li>
                            @endforeach
                            </ul>
                        </li>
                @endif
                @endforeach
                @endif
                </ul>
            </div>
            <div class="cart_list">
                <ul>
                    <li class="cart_icon">
                        <?php
                            // $cart = Auth::check()?Cart::session(Auth::id())->getContent():Cart::getContent();
                            $cart = Cart::getContent();
                        ?>
                        <a href="{{ route('frontend.order.show') }}"><i class="icon-handbag icons"></i><span>{{$cart->count()>9?'9+':$cart->count()}}</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="right_body">
        <div class="best_summer_banner">
            <img class="img-fluid" src="@asset('img/banner/summer-banner.jpg')" alt="">
            <div class="summer_text">
                <h3>Sữa rửa mặt </h3>
                <p>Làn da mịn màng - Căng tràn sức sống</p>
                <a class="add_cart_btn" href="#">Tìm hiểu ngay</a>
            </div>
        </div>
        <div class="latest_product_3steps">
            <div class="s_m_title">
                <h2>Sản phẩm mới nhất</h2>
            </div>
            <div class="l_product_slider owl-carousel">
                @if ($products)
                @foreach ($products as $product_key=>$product)
                @if ($product_key%3===0)
                <div class="item">
                @endif
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="{{ asset('media/product/'.$product->image) }}" alt="">
                            @if ($product->new == 1)
                            <h5 class="new">New</h5>
                            @endif
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="/san-pham/{{$product->slug}}"><i class="icon_piechart"></i></a></li>
                                <li>
                                    <a class="add_cart_btn" product-id="{{$product->id}}" product-name="{{$product->name}}" product-price="{{$product->price}}" href="{{ route('frontend.order.add') }}">Thêm vào giỏ</a>
                                </li>
                                @if (Auth::check())
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                                @endif
                            </ul>
                            <h4>{{$product->name}}</h4>
                            <h5>
                            @if ($product->discount>0)
                            <del>{{number_format($product->price)}} VNĐ</del>&nbsp;
                            {{number_format($product->price-($product->price*$product->discount/100))}} VNĐ
                            @else
                            {{number_format($product->price)}} VNĐ
                            @endif
                            </h5>
                        </div>
                    </div>
                @if ($product_key%3===2)
                </div>
                @endif
                @endforeach
                @endif

            </div>
        </div>

        <div class="feature_box_area">
            <div class="row m0">
                <div class="col-lg-6">
                    <div class="f_add_item white_add">
                        <div class="f_add_img"><img class="img-fluid" src="@asset('img/feature-add/f-add-8.jpg')" alt=""></div>
                        <div class="f_add_hover">
                            <h4>SON MÔI</h4>
                            <h6>Vũ khí bí mật cho sự rạng rỡ</h6>
                            <br>
                            <a class="add_btn" href="#">Xem ngay <i class="arrow_right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="f_add_item white_add">
                        <div class="f_add_img"><img class="img-fluid" src="@asset('img/feature-add/f-add-9.jpg')" alt=""></div>
                        <div class="f_add_hover">
                            <h4>LỚP NỀN</h4>
                            <h6>Má ửng hồng xinh</h6>
                            <br>
                            <a class="add_btn" href="#">Xem ngay <i class="arrow_right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--================Footer Area =================-->
        <footer class="footer_area box_footer">
            <div class="container">
                <div class="footer_widgets">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-6">
                            <aside class="f_widget f_about_widget">
                                <img src="@asset('img/logo.png')" alt="">
                                <p>Chất lượng cho tất cả</p>
                                <h6>Social:</h6>
                                <ul>
                                    <li><a href="#"><i class="social_facebook"></i></a></li>
                                    <li><a href="#"><i class="social_twitter"></i></a></li>
                                    <li><a href="#"><i class="social_pinterest"></i></a></li>
                                    <li><a href="#"><i class="social_instagram"></i></a></li>
                                    <li><a href="#"><i class="social_youtube"></i></a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_info_widget">
                                <div class="f_w_title">
                                    <h3>Hỗ trợ</h3>
                                </div>
                                <ul>
                                    <li><a href="#">HOTLINE: 1900 1009</a></li>
                                    <li><a href="/cam-nang/huong-dan-dat-hang">Hướng dẫn đặt hàng</a></li>
                                    <li><a href="/lien-he">Liên hệ</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_service_widget">
                                <div class="f_w_title">
                                    <h3>Thông tin</h3>
                                </div>
                                <ul>
                                    <li><a href="/cam-nang/ve-chung-toi">Về chúng tôi</a></li>
                                    <li><a href="/cam-nang/phi-van-chuyen">Phí vận chuyển</a></li>
                                    <li><a href="/cam-nang/quy-trinh-giao-hang">Quy trình giao hàng</a></li>
                                    <li><a href="/cam-nang/dieu-khoan-su-dung">Điều khoản sử dụng</a></li>
                                    <li><a href="/cam-nang/chinh-sach-doi-tra">Chính sách đổi trả</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_extra_widget">
                                <div class="f_w_title">
                                    <h3>Tính năng</h3>
                                </div>
                                <ul>
                                    <li><a href="#">Nhãn hiệu</a></li>
                                    <li><a href="#">Quà giảm giá</a></li>
                                    <li><a href="#">Đại lý</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_account_widget">
                                <div class="f_w_title">
                                    <h3>Hợp tác &amp; liên kết</h3>
                                </div>
                                <ul>
                                    <li><a href="#">www.facebook.com</a></li>
                                    <li><a href="#">www.youtube.com</a></li>
                                    <li><a href="#">www.google.com</a></li>
                                    <li><a href="#">www.twitter.com</a></li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--================End Footer Area =================-->

    </div>
</div>
<!--================End Home Left Menu Area =================-->
{{csrf_field()}}
<script>
$(document).ready(function(){
    $(".add_cart_btn").click(function(e) {
        e.preventDefault();
        var postData = {
            _token: $('input[name="_token"').val(),
            id : $(this).attr('product-id'),
            name : $(this).attr('product-name'),
            price : $(this).attr('product-price'),
            qty : 1,
            size : null,
        };
        $.ajax({
            url: '{{ route("frontend.order.add") }}',
            data: postData,
            method: "POST",
            success: function(data) {
                window.location.reload();
            }
        })
    });

    $('input[name="keyword"').keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
            var keyword = $('input[name="keyword"').val();
            if (keyword !== '') {
                window.location.href = "{{route('frontend.search.show')}}/"+keyword;    
            }
        }
    });  
});
</script>