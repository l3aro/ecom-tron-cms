@sections('header')
        
@sections('categories-banner', ['banner'=>$banner??'default', 'title'=>$title??'', 'type'=>'product'])

{{csrf_field()}}
        
        <!--================Product Details Area =================-->
        <section class="product_details_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="product_details_slider">
                            <div id="product_slider2" class="rev_slider" data-version="5.3.1.6">
                                <ul>
                                    @if ($product_image)
                                    @foreach ($product_image as $img)
                                	<!-- SLIDE  -->
                                    <li data-index="rs-{{$img->id}}" data-transition="scaledownfromleft" data-slotamount="default"  data-easein="default" data-easeout="default" data-masterspeed="1500"  data-thumb="{!! asset('media/product/'.$product->id.'/tb/'.$img->image) !!}"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="Umbrella" data-param1="Octorber 3, 1995" data-param2="Blackheart, The Still Alive" data-description="">
                                        <!-- MAIN IMAGE -->
                                        <img src="{!! asset('media/product/'.$product->id.'/'.$img->image) !!}"  alt=""  width="1920" height="1080" data-lazyload="{!! asset('media/product/'.$product->id.'/'.$img->image) !!}" data-bgposition="center center" data-bgfit="contain" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                                        <!-- LAYERS -->
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="product_details_text">
                            <h3>{{$product->name}}</h3>
                            <!-- <ul class="p_rating">
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                            <div class="add_review">
                                <a href="#">5 Reviews</a>
                                <a href="#">Add your review</a>
                            </div> -->
                            <!-- <h6>Available In <span>Stock</span></h6> -->
                            <h4>
                            @if ($product->discount>0)
                            <del style="font-size:20px">{{number_format($product->price)}} VNĐ</del>&nbsp;
                            {{number_format($product->price-($product->price*$product->discount/100))}} VNĐ
                            @else
                            {{number_format($product->price)}} VNĐ
                            @endif
                            </h4>
                            <p>{!! $product->des !!}</p>
                            {{--<div class="p_color">
                                <h4 class="p_d_title">size <span>*</span></h4>
                                <select class="selectpicker">
                                @if ($product->size)
                                    <option disabled>Select your size</option>
                                    @foreach (explode(',',$product->size) as $option)
                                    @if ($option !== '')
                                    <option>Select size {{$option}}</option>
                                    @endif
                                    @endforeach
                                @endif
                                </select>
                            </div>--}}
                            <div class="quantity">
                                <h4 class="p_d_title">số lượng <span>*</span></h4>
                                <div class="custom">
                                    <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 1 ) result.value--;return false;" class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                                    <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                                    <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;" class="increase items-count" type="button"><i class="icon_plus"></i></button>
                                </div>
                                <a class="add_cart_btn" product-id="{{$product->id}}" product-name="{{$product->name}}" product-price="{{$product->price}}" href="#">thêm vào giỏ</a>
                            </div>
                            <div class="shareing_icon">
                                <h5>share :</h5>
                                <ul>
                                    <li><a href="#"><i class="social_facebook"></i></a></li>
                                    <li><a href="#"><i class="social_twitter"></i></a></li>
                                    <li><a href="#"><i class="social_pinterest"></i></a></li>
                                    <li><a href="#"><i class="social_instagram"></i></a></li>
                                    <li><a href="#"><i class="social_youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Product Details Area =================-->
        
        <!--================Product Description Area =================-->
        <section class="product_description_area">
            <div class="container">
                <nav class="tab_menu">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Thông tin thêm</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bình luận</a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <p>{!!$product->detail!!}</p>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <h4>Rocky Ahmed</h4>
                        <ul>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                            <li><a href="#"><i class="fa fa-star"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Product Details Area =================-->
        
        <!--================End Related Product Area =================-->
        @if ($related_product->count()>0)
        <section class="related_product_area">
            <div class="container">
                <div class="related_product_inner">
                    <h2 class="single_c_title">Sản phẩm liên quan</h2>
                    <div class="row">
                    @foreach ($related_product as $product)
                        <div class="col-lg-3 col-sm-6">
                            <div class="l_product_item">
                                <div class="l_p_img">
                                    <img class="img-fluid" src="{{ asset('media/product/'.$product->image) }}" alt="">
                                    @if ($product->new == 1)
                                    <h5 class="new">New</h5>
                                    @endif
                                </div>
                                <div class="l_p_text">
                                   <ul>
                                        <li class="p_icon"><a href="/san-pham/{{$product->slug}}"><i class="icon_piechart"></i></a></li>
                                        <li><a class="add_cart_btn" href="#">Thêm vào giỏ</a></li>
                                        @if (Auth::check())
                                        <li class="p_icon"><a href="#"><i class="icon_heart_alt"></i></a></li>
                                        @endif
                                    </ul>
                                    <h4>{{$product->name}}</h4>
                                    <h5>
                                    @if ($product->discount>0)
                                    <del>${{round($product->price,2)}}</del>&nbsp;
                                    ${{round($product->price-($product->price*$product->discount/100),2)}}
                                    @else
                                    ${{round($product->price,2)}}
                                    @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!--================End Related Product Area =================-->
        
@sections('footer')

<script>
$(document).ready(function(){
    $(".add_cart_btn").click(function(e) {
        e.preventDefault();
        var postData = {
            _token: $('input[name="_token"').val(),
            id : $(this).attr('product-id'),
            name : $(this).attr('product-name'),
            price : $(this).attr('product-price'),
            qty : $('input[name="qty"').val(),
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
});
</script>