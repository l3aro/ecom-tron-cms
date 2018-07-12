<!--header start-->
@partial('header')
<!--header end-->
<!--sidebar start-->
@partial('sidebar')
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		<div class="typo-agile">
            <h2 class="w3ls_head">Order Detail</h2>
            <div class="grid_3 grid_5 w3ls">
            <form method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="save-group-buttons">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <legend>Order infomation</legend>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label" for="disabledInput">ID</label>
                                <input class="form-control" name="id" type="text" value="{{ isset($order)?$order->id:'' }}" readonly="readonly">
                                <small class="form-text text-muted">ID is the code of the order</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="focusedInput">Full Name</label>
                                <input class="form-control" name="name" type="text" readonly value="{{ isset($order)?$order->name:'' }}">
                                <small class="form-text text-muted">Name of placer</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="focusedInput">Email</label>
                                <input class="form-control" name="email" type="email" readonly value="{{ isset($order)?$order->email:'' }}">
                                <small class="form-text text-muted">Email of placer</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="focusedInput">Address</label>
                                <input class="form-control" name="address" type="text" readonly value="{{ isset($order)?$order->address:'' }}">
                                <small class="form-text text-muted">Addrress to delivery to</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="focusedInput">Phone number</label>
                                <input class="form-control" name="phone" type="text" readonly value="{{ isset($order)?$order->phone:'' }}" placeholder="Tối ưu URL" pattern="[a-z0-9/-]{5,}">
                                <small class="form-text text-muted">Phone number of placer</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="focusedInput">Notes</label>
                                <textarea class="form-control" name="content" row="7" readonly >{{ isset($order)?$order->content:'' }}</textarea>
                                <small class="form-text text-muted">Addrress to delivery to</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label">Status</label><br>
                            <input type="radio" id="statusChoice1" class="changestatus" name="status" value="unhandle" {{$order->status==='unhandle'?'checked':''}} {{$order->status==='success'||$order->status==='error'?'disabled':''}} >
                            <small>&nbsp;Unhandle</small><br>
                            <input type="radio" id="statusChoice2" class="changestatus" name="status" value="proceed" {{$order->status==='proceed'?'checked':''}} {{$order->status==='success'||$order->status==='error'?'disabled':''}} >
                            <small>&nbsp;Proceeding</small><br>
                            <input type="radio" id="statusChoice3" class="changestatus" name="status" value="success" {{$order->status==='success'?'checked':''}} {{$order->status==='error'?'disabled':''}} >
                            <small>&nbsp;Success</small><br>
                            <input type="radio" id="statusChoice4" class="changestatus" name="status" value="error" {{$order->status==='error'?'checked':''}} {{$order->status==='success'?'disabled':''}} >
                            <small>&nbsp;Error</small><br>
                        </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <legend>Order Items</legend>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sum = 0;
                                ?>
                                @foreach ($order_items as $key=>$item)
                                <?php
                                $sum += $item->price*$item->quantity
                                ?>
                                    <tr>
                                        <td>{{$key}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{number_format($item->price)}} VNĐ</td>
                                        <td>{{number_format($item->price*$item->quantity)}} VNĐ</td>
                                    </tr>
                                @endforeach
                                    <tr>
                                        <td>Tax</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>12.5%</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total</b></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td><b>{{number_format($sum + $sum*125/1000)}} VNĐ</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                </form>
            </div>   
        </div>
</section>
 <!-- footer -->
@partial('footer')
  <!-- / footer -->
</section>
<script>
    $(document).ready(function(){
        $('#menu-order').addClass('active');

        $('#statusChoice1').click(function(){
			var obj = $(this);
			var id = {{$order->id}};
			var field = $(this).val();
			$.ajax({
                url: '/admin/order/changefield?id=' + id + '&field=' + field,
                method: "GET",
                success: function(data) {
                    alert('Order status changed.')
                }
            });
        });

        $('#statusChoice2').click(function(){
			var obj = $(this);
			var id = {{$order->id}};
			var field = $(this).val();
			$.ajax({
                url: '/admin/order/changefield?id=' + id + '&field=' + field,
                method: "GET",
                success: function(data) {
                    alert('Order status changed.')
                }
            });
        });

        $('#statusChoice3').click(function(){
            var cnfrm = confirm('Are you sure?');
            if(cnfrm != true) {
                return false;
            }
            else {
                var obj = $(this);
			var id = {{$order->id}};
			var field = $(this).val();
			$.ajax({
                url: '/admin/order/changefield?id=' + id + '&field=' + field,
                method: "GET",
                success: function(data) {
                    $('#statusChoice1').attr("disabled", "true");
                    $('#statusChoice2').attr("disabled", "true");
                    $('#statusChoice4').attr("disabled", "true");
                    alert('Order status changed.');
                }
            });
            }
        });

        $('#statusChoice4').click(function(){
            var cnfrm = confirm('Are you sure?');
            if(cnfrm != true) {
                return false;
            }
            else {
                var obj = $(this);
                var id = {{$order->id}};
                var field = $(this).val();
                $.ajax({
                    url: '/admin/order/changefield?id=' + id + '&field=' + field,
                    method: "GET",
                    success: function(data) {
                        $('#statusChoice1').attr("disabled", "true");
                        $('#statusChoice2').attr("disabled", "true");
                        $('#statusChoice3').attr("disabled", "true");
                        alert('Order status changed.');
                    }
                });
            }
        });

    });
</script>