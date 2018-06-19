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
                <a class="navbar-brand" href="/"><img src="@asset('img/logo.png')" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>

                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    @if (Theme::bind('menu'))
                    @foreach (Theme::bind('menu') as $option)
                    @if (!$option->sub)
                        <li class="nav-item"><a class="nav-link" href="{{$option->link}}">{{$option->name}}</a></li>
                    @else
                        <li class="nav-item dropdown submenu active">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{$option->name}} <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
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
                    <ul class="navbar-nav justify-content-end">
                        <li class="search_icon"><a href="{{route('frontend.search.show')}}"><i class="icon-magnifier icons"></i></a></li>
                        <!-- <li class="user_icon"><a href="#"><i class="icon-user icons"></i></a></li> -->
                        <?php
                            // $cart = Auth::check()?Cart::session(Auth::id())->getContent():Cart::getContent();
                            $cart = Cart::getContent();
                        ?>
                        <li class="cart_cart"><a href="{{ route('frontend.order.show') }}"><i class="icon-handbag icons"></i><span>{{$cart->count()>9?'9+':$cart->count()}}</span></a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>
<!--================End Menu Area =================-->