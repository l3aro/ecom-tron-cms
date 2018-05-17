<!--================Menu Area =================-->
<header class="shop_header_area carousel_menu_area">
    <div class="carousel_top_header row m0">
        <div class="container">
            <div class="carousel_top_h_inner">
                <div class="float-md-right">
                    <div class="top_header_middle">
                        <a href="#"><i class="fa fa-phone"></i> Call Us: <span>+84 987 654 321</span></a>
                        <a href="#"><i class="fa fa-envelope"></i> Email: <span>support@yourdomain.com</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="carousel_menu_inner">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href=""><img src="@asset('img/logo.png')" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                        <li class="nav-item dropdown submenu active">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pages <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="#">Compare</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Checkout Method</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Checkout Register</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Track</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">Login</a></li>
                                <li class="nav-item"><a class="nav-link" href="#">404</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown submenu">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Shop <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="{{ route('frontend.productcat.show') }}">Product Category</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('frontend.product.show') }}">Product</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Blog</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">lookbook</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('frontend.contact.show') }}">Contact</a></li>
                    </ul>
                    <ul class="navbar-nav justify-content-end">
                        <li class="search_icon"><a href="#"><i class="icon-magnifier icons"></i></a></li>
                        <li class="user_icon"><a href="#"><i class="icon-user icons"></i></a></li>
                        <li class="cart_cart"><a href="#"><i class="icon-handbag icons"></i><span>9+</span></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!--================End Menu Area =================-->