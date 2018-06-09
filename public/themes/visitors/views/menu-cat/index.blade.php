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
                    List Menu Category
                </div>
                <div class="row w3-res-tb">
                    <div class="col-sm-12 m-b-xs">
                        <button class="btn btn-md btn-primary" data-toggle="tooltip" title="Add new category" onclick="event.preventDefault();window.location.href='{{route('admin.menu-cat.detail')}}';">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                    {{-- <div class="col-sm-4">
                        <div class="input-group w3_w3layouts">
                            <input type="text" id="keyword" class="form-control" placeholder="Search" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search"></i></span>
                        </div>
                    </div> --}}
                </div>
                <div class="table-responsive">
                    {{ csrf_field() }}
                    {!! Theme::scope('menu-cat.list', ['categories' => $categories])->content() !!}
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
        $('#menu-menu').addClass('active');
		$('.delete-button').click(function(e){
			e.preventDefault();
			if (confirm('Are you sure?')){
                var delete_id = $(this).attr('delete-id');
				$.ajax({
					url: '/admin/menu-cat/delete?id=' + delete_id,
					async: true,
					method: 'GET',
					success: function(data){
						window.location.reload();
					}
				});
			}
		});
    });
</script>