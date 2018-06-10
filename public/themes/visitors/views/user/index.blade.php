<!--header start-->
@partial('header')
<!--header end-->
<!--sidebar start-->
@partial('sidebar')
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
					{{$title}}
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-8 m-b-xs">
                        <button id="btn-del-all" class="btn btn-md btn-danger" data-toggle="tooltip" title="Delete selected">
                            <i class="fa fa-trash"></i>
                        </button>
                        <button class="btn btn-md btn-primary float-right" data-toggle="tooltip" title="Add new category" onclick="event.preventDefault();window.location.href='{{route('admin.user.detail')}}';">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <div class="col-sm-4">
                        <div class="input-group w3_w3layouts">
                            <input type="text" id="keyword" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    {{ csrf_field() }}
                    {!! Theme::scope('user.list', ['users' => $users])->content() !!}
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    @partial('footer')
    <!-- / footer -->
</section>
<script>
    $(document).ready(function(){
		$('#menu-user').addClass('active');
        $('#keyword').keyup(function(){
            delay(function(){
                run_search();
            }, 400 );
        });
        $('.search-change').change(function(){
            run_search();
        });
        $('#search-button').click(function(){
            run_search();
        });
        init_action();
    });
	function init_action() {
        $('.pagination li a').click(function(e){
            e.preventDefault();
            run_search($(this).attr('href').split('page=')[1]);
        });

		$('#btn-ck-all').click(function(){
			var checkBoxes = $(".checkdel");
	        checkBoxes.prop("checked", !checkBoxes.prop("checked"));
	        if ($('input.checkdel:checkbox:checked').length == $('input.checkdel:checkbox').length){
		        $('#btn-ck-all i').attr('class', 'fa fa-check-square-o')
	        } else if ($('input.checkdel:checkbox:checked').length > 0) {
		        $('#btn-ck-all i').attr('class', 'fa fa-minus-square-o')
	        } else {
		        $('#btn-ck-all i').attr('class', 'fa fa-square-o')
	        }
		});
		$('.delete-button').click(function(e){
			e.preventDefault();
			if (confirm('Are you sure?')){
                var delete_id = $(this).attr('delete-id');
				$.ajax({
					url: '/admin/user/delete?id=' + delete_id,
					async: true,
					method: 'GET',
					success: function(data){
						window.location.reload();
					}
				});
			}
		});
		$("#btn-del-all").click(function(){
			var countchecked = $('input.checkdel:checkbox:checked').length;
			if (countchecked > 0){
				if (confirm('Are you sure?')){
					var delstr = '';					
					$('input.checkdel:checkbox:checked').each(function(index){
						delstr += $(this).attr('del-id') + ',';
					});
					token = $('#delform input[name="_token"').val();
					$.ajax({
						url: '/admin/user/delete?id=' + delstr,
						async: false,
						method: "GET",
						data: {_token:token},
						success: function(data) {
							if (data != 0) {
								alert(data);
							}
						}
					});
					window.location.reload();
				}
			} else {
				return false;
			}
		});
		$(".checkdel").change(function(){
	        if ($('input.checkdel:checkbox:checked').length == $('input.checkdel:checkbox').length){
		        $('#btn-ck-all i').attr('class', 'fa fa-check-square-o')
	        } else if ($('input.checkdel:checkbox:checked').length > 0) {
		        $('#btn-ck-all i').attr('class', 'fa fa-minus-square-o')
	        } else {
		        $('#btn-ck-all i').attr('class', 'fa fa-square-o')
	        }
		});
        $('button[cms-change-field="changfield"]').click(function(){
			var obj = $(this);
			var currentvalue = $(this).attr('currentvalue');
			var id = $(this).attr('item-id');
			var field = $(this).attr('field');
			$.ajax({
				  url: '/admin/user/changefield?id=' + id + '&p=' + currentvalue + '&field=' + field,
                  method: "GET",
				  success: function(data) {
				  	if (currentvalue==0) { 
				  		pic = 'check';
				  		currentvalue = 1;
				  		tooltip = 'Click để tắt';
				  		cl = 'btn-success';
				  	} else { 
				  		pic = 'times';
				  		currentvalue = 0;
				  		tooltip = 'Click để bật';
				  		cl = '';
				  	}
				  	obj.attr('currentvalue', currentvalue);
				  	obj.attr('class', 'btn btn-sm p-1 ' + cl + '');
					obj.html('<i class="fa fa-' + pic + '"></i>');
				  	obj.attr('data-original-title', tooltip);
				  }
				});
		});
    }
    function run_search(page){
        $("[data-toggle=tooltip]").tooltip('hide');
        var keyword = $('#keyword').val();
        $.ajax({
            url: '/admin/user/admin?f_name=' + keyword + '&page=' + page,
            type: 'GET',
            success: function(data) {
                $('#data_table').html(data);
                init_action();
            }
        });
    }
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();
</script>