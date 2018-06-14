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
                        <a href="{{ route('frontend.order.show') }}"><i class="icon-handbag icons"></i><span>{{Cart::getContent()->count()>9?'9+':Cart::getContent()->count()}}</span></a>
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
                <div class="item">
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-9.jpg')" alt="">
                            <h5 class="sale">Sale</h5>
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Womens Libero</h4>
                            <h5><del>$45.50</del> $40</h5>
                        </div>
                    </div>
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-10.jpg')" alt="">
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Oxford Shirt</h4>
                            <h5>$85.50</h5>
                        </div>
                    </div>
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-11.jpg')" alt="">
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Oxford Shirt</h4>
                            <h5>$85.50</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-12.jpg')" alt="">
                            <h5 class="new">New</h5>
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Travel Bags</h4>
                            <h5><del>$45.50</del> $40</h5>
                        </div>
                    </div>
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-13.jpg')" alt="">
                            <h5 class="sale">Sale</h5>
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>High Heel</h4>
                            <h5><del>$130.50</del> $110</h5>
                        </div>
                    </div>
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-14.jpg')" alt="">
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>High Heel</h4>
                            <h5><del>$130.50</del> $110</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-15.jpg')" alt="">
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Summer Dress</h4>
                            <h5>$45.05</h5>
                        </div>
                    </div>
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-16.jpg')" alt="">
                            <h5 class="sale">Sale</h5>
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Fossil Watch</h4>
                            <h5>$250.00</h5>
                        </div>
                    </div>
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-17.jpg')" alt="">
                            <h5 class="sale">Sale</h5>
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Fossil Watch</h4>
                            <h5>$250.00</h5>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-18.jpg')" alt="">
                            <h5 class="sale">Sale</h5>
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Nike Shoes</h4>
                            <h5><del>$130</del> $110</h5>
                        </div>
                    </div>
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-19.jpg')" alt="">
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Ricky Shirt</h4>
                            <h5>$45.05</h5>
                        </div>
                    </div>
                    <div class="l_product_item">
                        <div class="l_p_img">
                            <img src="@asset('img/product/l-product-20.jpg')" alt="">
                        </div>
                        <div class="l_p_text">
                            <ul>
                                <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                            </ul>
                            <h4>Ricky Shirt</h4>
                            <h5>$45.05</h5>
                        </div>
                    </div>
                </div>
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