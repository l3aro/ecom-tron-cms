@sections('header')
        
@sections('categories-solid', ['title' => $title?$title:''])

{{ csrf_field() }}
        <!--================Shopping Cart Area =================-->
        @if (Cart::getContent()->count() === 0)
        <section class="emty_cart_area p_100">
            <div class="container">
                <div class="emty_cart_inner">
                    <i class="icon-handbag icons"></i>
                    <h3>Giỏ hàng trống</h3>
                    <h4>Quay lại <a href="/">mua hàng</a></h4>
                </div>
            </div>
        </section>
        @else
        <section class="shopping_cart_area p_100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="cart_items">
                            <h3>Giỏ hàng</h3>
                            <div class="table-responsive-md">
                                <table class="table">
                                    <tbody>
                                        @if ($items)
                                        @foreach ($items as $item)
                                        <tr>
                                            <th scope="row">
                                                <img src="@asset('img/icon/close-icon.png')" alt="" class="delete_cart_btn" delete-id="{{$item->id}}">
                                            </th>
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <img src="{{ asset('media/product/'.$images[$item->id]) }}" alt="" width="102" height="123">
                                                    </div>
                                                    <div class="media-body">
                                                        <h4>{{$item->name}} </h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><p class="red">{{number_format($item->price,0)}} VNĐ</p></td>
                                            <td>
                                                <div class="quantity">
                                                    <h6>Số lượng</h6>
                                                    <div class="custom">
                                                        <button onclick="decQuantity({{$item->id}}, {{$item->price}})" class="reduced items-count" type="button"><i class="icon_minus-06"></i></button>
                                                        <input type="text" name="qty" id="sst{{$item->id}}" maxlength="12" value="{{$item->quantity}}" title="Quantity:" class="input-text qty">
                                                        <button onclick="incQuantity({{$item->id}}, {{$item->price}})" class="increase items-count" type="button"><i class="icon_plus"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><p id="total{{$item->id}}">{{ number_format($item->price * $item->quantity,0) }} VNĐ</p></td>
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr>
                                            <th scope="row">
                                            </th>
                                        </tr>
                                        <tr class="last">
                                            <th scope="row">
                                                <img src="@asset('img/icon/cart-icon.png')" alt="">
                                            </th>
                                            <td>
                                                <div class="media">
                                                    <div class="d-flex">
                                                        <h5>Mã giảm giá</h5>
                                                    </div>
                                                    <div class="media-body">
                                                        <input type="text" placeholder="">
                                                    </div>
                                                </div>
                                            </td>
                                            <td><p class="red"></p></td>
                                            <td>
                                                <h3>Sử dụng</h3>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div id="cart_details_area">
                            <div class="cart_totals_area" id="cart_totals_area">
                                <h4>Hóa đơn</h4>
                                <div class="cart_t_list">
                                    <div class="media">
                                        <div class="d-flex">
                                            <h5>Tạm tính</h5>
                                        </div>
                                        <div class="media-body">
                                            <h6>{{Cart::getSubTotal()}} VNĐ</h6>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="d-flex">
                                            <h5>GTGT</h5>
                                        </div>
                                        <div class="media-body">
                                            <h6>{{Cart::getCondition('VAT')->getValue()}}</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="total_amount row m0 row_disable">
                                    <div class="float-left">
                                        Tổng
                                    </div>
                                    <div class="float-right">
                                        {{Cart::getTotal()}} VNĐ
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" value="submit" class="btn subs_btn form-control" id="checkout">Tiến hành đặt hàng</button>
                    </div>
                </div>
            </div>
        </section>
        @endif
        <!--================End Shopping Cart Area =================-->
        
@sections('footer')

<script>

Number.prototype.formatMoney = function(c, d, t){
    var n = this, 
    c = isNaN(c = Math.abs(c)) ? 2 : c, 
    d = d == undefined ? "." : d, 
    t = t == undefined ? "," : t, 
    s = n < 0 ? "-" : "", 
    i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
    j = (j = i.length) > 3 ? j % 3 : 0;
   return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
 };

function decQuantity(id, price) {
    var quantity = document.getElementById('sst'+id); 
    var sst = quantity.value; 
    if( !isNaN( sst ) && sst > 0 ) 
        quantity.value--;
    $("#total"+id).text((price*quantity.value).formatMoney(0)+' VNĐ');
    var postData = {
            _token: $('input[name="_token"').val(),
            id : id,
            qty : -1,
        };
    $.ajax({
        url: '{{route("frontend.order.update")}}',
        data: postData,
        method: 'POST',
        success: function(data) {
            $("#cart_details_area").load(" #cart_totals_area");
        }
    });
    return false;
}

function incQuantity(id, price) {
    var quantity = document.getElementById('sst'+id); 
    var sst = quantity.value; 
    var postData = {
            _token: $('input[name="_token"').val(),
            id : id,
            qty : 1,
        };
    $.ajax({
        url: '{{route("frontend.order.update")}}',
        data: postData,
        method: 'POST',
        success: function(data) {
            if (data.data == 'out_of_stock') {
                alert('Đã đạt số lượng tối đa có thể mua!');
            }
            else {
                if( !isNaN( sst )) 
                    quantity.value++;
                $("#total"+id).text((price*quantity.value).formatMoney(0)+' VNĐ');
                $("#cart_details_area").load(" #cart_totals_area");
            }
        }
    });
    return false;
}

$(document).ready(function(){
    $(".delete_cart_btn").click(function(e) {
        e.preventDefault();
        var postData = {
            _token: $('input[name="_token"').val(),
            id : $(this).attr('delete-id'),
        };
        $.ajax({
            url: '{{ route("frontend.order.delete") }}',
            data: postData,
            method: "POST",
            success: function(data) {
                window.location.reload();
            }
        })
    });

    $("#checkout").click(function(e) {
        e.preventDefault();
        window.location.href = '{{ route("frontend.order.checkout") }}';
    })
});

</script>