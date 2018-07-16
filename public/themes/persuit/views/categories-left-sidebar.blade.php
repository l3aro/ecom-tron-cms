@sections('header')
        
@sections('categories-banner', ['banner'=>$banner??'default', 'title'=>$title??'', 'type'=>'product-cat'])

{{ csrf_field() }}
        
        <!--================Categories Product Area =================-->
        <section class="categories_product_main p_80">
            <div class="container">
                <div class="categories_main_inner">
                    <div class="row row_disable">
                        <div class="col-lg-9 float-md-right">
                            <div class="showing_fillter">
                                <div class="row m0">
                                    <div class="first_fillter">
                                        <h4>Hiển thị {{$products->firstItem()}} tới {{$products->lastItem()}} trong {{$products->total()}} sản phẩm</h4>
                                    </div>
                                    <div class="secand_fillter">
                                        <h4>LỌC :</h4>
                                        <select class="selectpicker">
                                            <option value="name">Tên</option>
                                            <option value="newest">Mới nhất</option>
                                            <option value="oldest">Cũ nhất</option>
                                            <option value="highest">Giá giảm dần</option>
                                            <option value="lowest">Giá tăng dần</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div id="list-product">
                            {!! Theme::scope('list-product', ['products' => $products])->content() !!}
                            </div>
                        </div>
                        <div class="col-lg-3 float-md-right">
                            <div class="categories_sidebar">
                                <aside class="l_widgest l_p_categories_widget">
                                    <div class="l_w_title">
                                        <h3>Mục sản phẩm</h3>
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
                                        <h3>Lọc theo giá</h3>
                                    </div>
                                    <div id="slider-range" class="ui_slider"></div>
                                    <label for="amount">Giá:</label>
                                    <input type="text" id="amount" name="amount" readonly>
                                    <input type="text" id="minPrice" class="d-none" value="1000" readonly>
                                    <input type="text" id="maxPrice" class="d-none" value="10000000" readonly>
                                </aside>
                                <!-- <aside class="l_widgest l_color_widget">
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
                                </aside> -->
                                @if ($featured_product->count()>0)
                                <aside class="l_widgest l_feature_widget">
                                    <div class="l_w_title">
                                        <h3>Featured Products</h3>
                                    </div>
                                    @foreach ($featured_product as $product)
                                    <a href="/san-pham/{{$product->slug}}">
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset('media/product/'.$product->image) }}" width="80" height="100" alt="">
                                            </div>
                                            <div class="media-body">
                                                <h4>{{$product->name}}</h4>
                                                <h5>
                                                @if ($product->discount>0)
                                                {{number_format($product->price-($product->price*$product->discount/100))}} VNĐ
                                                @else
                                                {{number_format($product->price)}} VNĐ
                                                @endif
                                                </h5>
                                            </div>
                                        </div>
                                    </a>
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
<script>

var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();

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

    $('.selectpicker').change(function(){
        delay(function(){
            run_search();
        }, 130 );
    });

    $("#slider-range").change(function(){
        alert('lol');
        delay(function(){
            run_search();
        }, 130 );
    });

    $( "#slider-range" ).slider({
      range: true,
      min: 1000,
      max: 10000000,
      values: [ 10000, 10000000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.values[ 0 ].formatMoney(0) + " VNĐ - " + ui.values[ 1 ].formatMoney(0) + " VNĐ" );
        $( "#minPrice" ).val( ui.values[0] );
        $( "#maxPrice" ).val( ui.values[1] ); 
        delay(function(){
            run_search();
        }, 130 );
      }
    });
    $( "#amount" ).val( "1,000 VNĐ - 10,000,000 VNĐ" );

    init_element();
});

function init_element(){
    $('.pagination li a').click(function(e){
        e.preventDefault();
        run_search($(this).attr('href').split('page=')[1]);
    });
}

function run_search(page){
    var valueSelected = $('.selectpicker').val();
    var minPrice = $('#minPrice').val();
    var maxPrice = $('#maxPrice').val();
    var currentPath = window.location.href;
    $.ajax({
        url: currentPath + '?min=' + minPrice + '&&max=' + maxPrice + '&&filter=' + valueSelected + '&page=' + page,
        type: 'GET',
        success: function(data) {
            $('#list-product').html(data);
            init_element();
        }
    });
}
</script>