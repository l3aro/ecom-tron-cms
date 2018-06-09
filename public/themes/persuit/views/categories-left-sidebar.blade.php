@sections('header')
        
@sections('categories-banner', ['banner'=>$banner??'default', 'title'=>$title??''])
        
        <!--================Categories Product Area =================-->
        <section class="categories_product_main p_80">
            <div class="container">
                <div class="categories_main_inner">
                    <div class="row row_disable">
                        <div class="col-lg-9 float-md-right">
                        @if ($products->count()>0)
                            <div class="showing_fillter">
                                <div class="row m0">
                                    <div class="first_fillter">
                                        <h4>Showing {{$products->firstItem()}} to {{$products->lastItem()}} of {{$products->total()}} total</h4>
                                    </div>
                                    <div class="secand_fillter">
                                        <h4>SORT BY :</h4>
                                        <select class="selectpicker">
                                            <option>Name</option>
                                            <option>Latest</option>
                                            <option>Oldest</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="categories_product_area">
                                <div class="row">
                                
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="l_product_item">
                                            <div class="l_p_img">
                                                <img src="{{ asset('media/product/'.$product->image) }}" alt="">
                                                @if ($product->new == 1)
                                                <h5 class="new">New</h5>
                                                @endif
                                            </div>
                                            <div class="l_p_text">
                                               <ul>
                                                    <li class="p_icon"><a href="#"><i class="icon_piechart"></i></a></li>
                                                    <li><a class="add_cart_btn" href="#">Add To Cart</a></li>
                                                    <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                                                </ul>
                                                <h4>{{$product->name}}</h4>
                                                <h5>
                                                @if ($product->discount>0)
                                                <del>${{$product->price}}</del>&nbsp;
                                                ${{$product->price-($product->price*$product->discount/100)}}
                                                @else
                                                ${{$product->price}}
                                                @endif
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </div>
                                <nav aria-label="Page navigation example" class="">
                                  <!-- <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                    <li class="page-item next"><a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                  </ul> -->
                                  {{$products->links()}}
                                </nav>
                            </div>
                        @else
                            <div class="categories_product_area">
                                <h4>No items found</h4>
                            </div>
                        @endif
                        </div>
                        <div class="col-lg-3 float-md-right">
                            <div class="categories_sidebar">
                                <aside class="l_widgest l_p_categories_widget">
                                    <div class="l_w_title">
                                        <h3>Categories</h3>
                                    </div>
                                    <ul class="navbar-nav">
                                    @if ($left_menu)
                                    @foreach ($left_menu as $option)
                                        @if (!$option->sub)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{$option->link}}">{{$option->name}}
                                            </a>
                                        </li>
                                        @else
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$option->name}}
                                            <i class="icon_plus" aria-hidden="true"></i>
                                            <i class="icon_minus-06" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @foreach ($option->sub as $sub_option)
                                                <li class="nav-item"><a class="nav-link" href="{{$sub_option->link}}">{{$sub_option->name}}</a></li>
                                            @endforeach
                                            </ul>
                                        </li>
                                        @endif
                                    @endforeach
                                    @endif
                                    </ul>
                                </aside>
                                <aside class="l_widgest l_fillter_widget">
                                    <div class="l_w_title">
                                        <h3>Filter section</h3>
                                    </div>
                                    <div id="slider-range" class="ui_slider"></div>
                                    <label for="amount">Price:</label>
                                    <input type="text" id="amount" readonly>
                                </aside>
                                <aside class="l_widgest l_color_widget">
                                    <div class="l_w_title">
                                        <h3>Color</h3>
                                    </div>
                                    <ul>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                        <li><a href="#"></a></li>
                                    </ul>
                                </aside>
                                @if ($featured_product->count()>0)
                                <aside class="l_widgest l_feature_widget">
                                    <div class="l_w_title">
                                        <h3>Featured Products</h3>
                                    </div>
                                    @foreach ($featured_product as $product)
                                    <div class="media">
                                        <div class="d-flex">
                                            <img src="{{ asset('media/product/'.$product->image) }}" width="80" height="100" alt="">
                                        </div>
                                        <div class="media-body">
                                            <h4>{{$product->name}}</h4>
                                            <h5>
                                            @if ($product->discount>0)
                                            ${{$product->price-($product->price*$product->discount/100)}}
                                            @else
                                            ${{$product->price}}
                                            @endif
                                            </h5>
                                        </div>
                                    </div>
                                    @endforeach
                                </aside>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Categories Product Area =================-->
        
@sections('footer')