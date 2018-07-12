@sections('header')
        
@sections('categories-solid', ['title' => $title])
        
        <!--================Register Area =================-->
        <section class="register_area p_100">
            <div class="container">
                <div class="register_inner">
                    <form method="POST" id="form">
                    {{csrf_field()}}
                        <div class="row">                     
                            <div class="col-lg-7">
                                <div class="billing_details">
                                    <h2 class="reg_title">Thông tin giao hàng</h2>
                                    <div class="billing_inner row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name">Họ tên <span>*</span></label>
                                                <input type="text" class="form-control" id="name" aria-describedby="name" placeholder="" name="name" equired>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="address">Địa chỉ <span>*</span></label>
                                                <input type="text" class="form-control" id="address" aria-describedby="address" name="address" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="email">Email <span>*</span></label>
                                                <input type="email" class="form-control" id="email" aria-describedby="email" name="email" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="phone">Số điện thoại <span>*</span></label>
                                                <input type="text" class="form-control" id="phone" aria-describedby="phone" name="phone" required>
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="creat_account">
                                                    <input type="checkbox" id="f-option" name="selector">
                                                    <label for="f-option">Ship to a different address?</label>
                                                    <div class="check"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 d-none" id="addition-address">
                                            <div class="form-group">
                                                <label for="address">Address <span>*</span></label>
                                                <input type="text" class="form-control" id="address" aria-describedby="address" name="addition-address" required>
                                                <input type="text" class="form-control" id="address2" aria-describedby="address" name="addition-address2">
                                            </div>
                                        </div> -->
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="order">Ghi chú</label>
                                                <textarea class="form-control" id="order" rows="3" name="note"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="order_box_price">
                                    <h2 class="reg_title">Đơn hàng</h2>
                                    <div class="payment_list">
                                        <div class="price_single_cost">
                                        @foreach (Cart::getContent() as $item)
                                            <h5>{{$item->name}} <span>{{number_format($item->price,0)}} VNĐ</span></h5>
                                        @endforeach
                                            <h4>Tạm tính <span>{{Cart::getSubTotal()}} VNĐ</span></h4>
                                            <h3><span class="normal_text">Tổng</span> <span>{{Cart::getTotal()}} VNĐ</span></h3>
                                        </div>
                                        <div id="accordion" role="tablist" class="price_method">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                                                        Thanh toán khi nhận hàng
                                                        </a>
                                                    </h5>
                                                </div>

                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Thanh toán đơn hàng của bạn tại thời điểm nhận hàng 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingTwo">
                                                    <h5 class="mb-0 disable-link">
                                                        <a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                                        Chuyển khoản qua ngân hàng
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                                    <div class="card-body">
                                                        Lorem Ipsum is simply dummy text of the print-ing and typesetting industry. Lorem Ipsum has been the industry's. 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" value="submit" class="btn subs_btn form-control">Đặt hàng</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!--================End Register Area =================-->
        
@sections('footer')

<script>
$(document).ready(function(){
    // $('#f-option').click(function(e){
    //     if ($('#f-option').is(":checked")) {
    //         $('#addition-address').removeClass('d-none').addClass('d-block');
    //     }
    //     else {
    //         $('#addition-address').removeClass('d-block').addClass('d-none');
    //     }
        
    // });

    $('#form').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: '{{route("frontend.order.store")}}',
            data: $('#form').serialize(),
            success: function(res) {
                if(res.success == true) {
                    alert('Đặt hàng thành công!');
                    window.location.href = '/';
                }
            }

        });
    })

});
</script>