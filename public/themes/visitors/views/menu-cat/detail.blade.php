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
        <h2 class="w3ls_head">Menu Detail</h2>
        <div class="grid_3 grid_5 w3ls">
        @if($saved == 1)
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Data has been saved to the database.
            </div>
        @endif
        <form method="post" action="/admin/menu-cat/detail?id={{ isset($category)?$category->id:'' }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="save-group-buttons">
                    <button name="submit" class="btn btn-md btn-success" data-toggle="tooltip" title="Save">
                        <i class="fa fa-save"></i>
                    </button> 
                    <button class="btn btn-md btn-primary float-right" data-toggle="tooltip" title="Add new category" onclick="event.preventDefault();window.location.href='{{route('admin.menu.detail')}}';">
                            <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <legend>Basic infomation</legend>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Title</label>
                            <input class="form-control" name="name" type="text" required value="{{ isset($category)?$category->name:'' }}" placeholder="Category title">
                            <small class="form-text text-muted">Name of the menu</small>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Public</label>
                            <input type="checkbox" class="checkbox-toggle" name="public" id="public" {{ isset($category)&&$category->public==1?'checked':'' }}/>
                            <small class="form-text text-muted">When "Public" feature is selected, this menu will be displayed on the site interface.</small>
                        </div>
                    </div>
                </div>
                <hr>
            </form>
		</div>
</section>
 <!-- footer -->
@partial('footer')
  <!-- / footer -->
</section>
<script>
    $(document).ready(function(){
        $('#menu-menu').addClass('active');
    });
</script>
