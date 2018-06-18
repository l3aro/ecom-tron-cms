@sections('header')
        
@sections('categories-solid')
        
        <!--================Register Area =================-->
        <section class="register_area p_100">
            <div class="container">
                <div class="register_inner">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="billing_details">
                                <h2 class="reg_title">Billing Detail</h2>
                                <form class="billing_inner row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="name">Full Name <span>*</span></label>
                                            <input type="text" class="form-control" id="name" aria-describedby="name" placeholder="" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="address">Address <span>*</span></label>
                                            <input type="text" class="form-control" id="address" aria-describedby="address" required>
                                            <input type="text" class="form-control" id="address2" aria-describedby="address">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Email <span>*</span></label>
                                            <input type="email" class="form-control" id="email" aria-describedby="email" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="phone">Phone <span>*</span></label>
                                            <input type="text" class="form-control" id="phone" aria-describedby="phone" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
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
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="order">Order Notes <span>*</span></label>
                                            <textarea class="form-control" id="order" rows="3"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="order_box_price">
                                <h2 class="reg_title">Your Order</h2>
                                <div class="payment_list">
                                    <div class="price_single_cost">
                                    @foreach (Cart::getContent() as $item)
                                        <h5>{{$item->name}} <span>{{number_format($item->price,0)}} VNĐ</span></h5>
                                    @endforeach
                                        <h4>Cart Subtotal <span>{{Cart::getSubTotal()}} VNĐ</span></h4>
                                        <h3><span class="normal_text">Order Totals</span> <span>{{Cart::getTotal()}} VNĐ</span></h3>
                                    </div>
                                    <div id="accordion" role="tablist" class="price_method">
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingOne">
                                                <h5 class="mb-0">
                                                    <a data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="true" aria-controls="collapseOne">
                                                    cash on delivery
                                                    </a>
                                                </h5>
                                            </div>

                                            <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    Lorem Ipsum is simply dummy text of the print-ing and typesetting industry. Lorem Ipsum has been the industry's. 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingTwo">
                                                <h5 class="mb-0 disable-link">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapseTwo" role="button" aria-expanded="false" aria-controls="collapseTwo">
                                                    cheque payment
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                                <div class="card-body">
                                                    Lorem Ipsum is simply dummy text of the print-ing and typesetting industry. Lorem Ipsum has been the industry's. 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingThree">
                                                <h5 class="mb-0 disable-link">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapseThree" role="button" aria-expanded="false" aria-controls="collapseThree">
                                                    direct bank transfer
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                                <div class="card-body">
                                                    Lorem Ipsum is simply dummy text of the print-ing and typesetting industry. Lorem Ipsum has been the industry's. 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header" role="tab" id="headingfour">
                                                <h5 class="mb-0 disable-link">
                                                    <a class="collapsed" data-toggle="collapse" href="#collapsefour" role="button" aria-expanded="false" aria-controls="collapsefour">
                                                    paypal
                                                    </a>
                                                </h5>
                                            </div>
                                            <div id="collapsefour" class="collapse" role="tabpanel" aria-labelledby="headingfour" data-parent="#accordion">
                                                <div class="card-body">
                                                    Lorem Ipsum is simply dummy text of the print-ing and typesetting industry. Lorem Ipsum has been the industry's. 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" value="submit" class="btn subs_btn form-control">place order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--================End Register Area =================-->
        
@sections('footer')

<script>
$(document).ready(function(){
    $('#f-option').click(function(e){
        if ($('#f-option').is(":checked")) {
            $('#addition-address').removeClass('d-none').addClass('d-block');
        }
        else {
            $('#addition-address').removeClass('d-block').addClass('d-none');
        }
        
    });
});
</script>