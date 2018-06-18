<!--================Home Left Menu Area =================-->
<div class="home_left_main_area">
    <div class="left_menu">
        <div class="offcanvas_fixed_menu">
            <a class="logo_offcanvas" href="#"><img src="@asset('img/logo-white.png')" alt=""></a>
            <div class="input-group search_form">
                <input type="text" class="form-control" placeholder="Search" aria-label="Search">
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
                <h3>Best Summer Collection </h3>
                <p>There is no one who loves to be bread, who looks after it and wants to have it, simply because it is pain.</p>
                <a class="add_cart_btn" href="#">shop now</a>
            </div>
        </div>
        <div class="latest_product_3steps">
            <div class="s_m_title">
                <h2>Our Latest Product</h2>
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
                                <li class="p_icon"><a href="/product/{{$product->slug}}"><i class="icon_piechart"></i></a></li>
                                <li>
                                    <a class="add_cart_btn" product-id="{{$product->id}}" product-name="{{$product->name}}" product-price="{{$product->price}}" href="{{ route('frontend.order.add') }}">Add To Cart</a>
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
                            <h4>Best Summer <br>Collection</h4>
                            <a class="add_btn" href="#">Shop Now <i class="arrow_right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="f_add_item white_add">
                        <div class="f_add_img"><img class="img-fluid" src="@asset('img/feature-add/f-add-9.jpg')" alt=""></div>
                        <div class="f_add_hover">
                            <h4>Best Summer <br>Collection</h4>
                            <a class="add_btn" href="#">Shop Now <i class="arrow_right"></i></a>
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
                                <p>Persuit is a Premium PSD Template. Best choice for your online store. Let purchase it to enjoy now</p>
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
                                    <h3>Information</h3>
                                </div>
                                <ul>
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Delivery information</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Help Center</a></li>
                                    <li><a href="#">Returns & Refunds</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_service_widget">
                                <div class="f_w_title">
                                    <h3>Customer Service</h3>
                                </div>
                                <ul>
                                    <li><a href="#">My account</a></li>
                                    <li><a href="#">Ordr History</a></li>
                                    <li><a href="#">Wish List</a></li>
                                    <li><a href="#">Newsletter</a></li>
                                    <li><a href="#">Contact Us</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_extra_widget">
                                <div class="f_w_title">
                                    <h3>Extras</h3>
                                </div>
                                <ul>
                                    <li><a href="#">Brands</a></li>
                                    <li><a href="#">Gift Vouchers</a></li>
                                    <li><a href="#">Affiliates</a></li>
                                    <li><a href="#">Specials</a></li>
                                </ul>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6">
                            <aside class="f_widget link_widget f_account_widget">
                                <div class="f_w_title">
                                    <h3>My Account</h3>
                                </div>
                                <ul>
                                    <li><a href="#">My account</a></li>
                                    <li><a href="#">Ordr History</a></li>
                                    <li><a href="#">Wish List</a></li>
                                    <li><a href="#">Newsletter</a></li>
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