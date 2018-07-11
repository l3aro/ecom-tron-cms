<div class="categories_product_area">
@if ($products->count()>0)
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
@else
    <h4>Không tìm thấy sản phẩm!</h4>
@endif
</div>