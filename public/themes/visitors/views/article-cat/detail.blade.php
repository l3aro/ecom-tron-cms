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
        <h2 class="w3ls_head">Article Category Detail</h2>
        <div class="grid_3 grid_5 w3ls">
        @if($saved == 1)
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Data has been saved to the database.
            </div>
        @endif
        @if($slug_exists == 1)
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> URL matches another post.
            </div>
        @endif
        @if($slug_exists == 2)
            <div class="alert alert-danger" role="alert">
                <strong>Error!</strong> Auto generate URL matches another post. Please create an URL manually.
            </div>
        @endif
        <form method="post" action="/admin/article-cat/detail?id={{ isset($category)?$category->id:'' }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="save-group-buttons">
                    <button name="submit" class="btn btn-md btn-success" data-toggle="tooltip" title="Save">
                        <i class="fa fa-save"></i>
                    </button> 
                    <button class="btn btn-md btn-primary float-right" data-toggle="tooltip" title="Add new article" onclick="event.preventDefault();window.location.href='{{route('admin.article-cat.detail')}}';">
                            <i class="fa fa-plus"></i>
                    </button>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <legend>Basic infomation</legend>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="disabledInput">ID</label>
                            <input class="form-control" name="id" type="text" value="{{ isset($category)?$category->id:'' }}" readonly="readonly">
                            <small class="form-text text-muted">ID is the code of the article, this is a unique property</small>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Title</label>
                            <input class="form-control" name="name" type="text" required value="{{ isset($category)?$category->name:'' }}" placeholder="Category title">
                            <small class="form-text text-muted">Name of the category</small>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <select class="form-control" name="parent">
                                <option value="0" {{ $category->parent===0?'selected':'' }}>
                                @if ($list_cat)
                                    @foreach ($list_cat as $cat)
                                        <option value="{!! $cat->id !!}" {{ $category->parent==$cat->id?'selected':'' }}>{!! $cat->name !!}</option>
                                        @php
                                            if ($cat->sub !== null) {
                                                printSub($cat->sub, $category->parent);
                                            }
                                        @endphp
                                    @endforeach
                                @endif
                            </select>
                            <small class="form-text text-muted">Select the parent of this category</small>
                        </div>
                        <div class="form-group">
                                <label class="control-label" for="focusedInput">Optimize URLs</label>
                                <input class="form-control" name="slug" type="text" value="{{ isset($category)?$category->slug:'' }}" placeholder="Tối ưu URL" pattern="[a-z0-9/-]{5,}">
                                <small class="form-text text-muted">Optimize the URL path to the best for SEO. For example: "article-name" self-generated system is: http://domainame.com/article-name</small>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Highlight</label>
                            <input type="checkbox" class="checkbox-toggle" name="highlight" id="highlight" {{ isset($category)&&$category->highlight==1?'checked':'' }}/>
                            <small class="form-text text-muted">When "Highlight" feature is selected, this article will be displayed on the homepage or points indicated on the interface.</small>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Avatar</label>
                            <input class="form-control" name="image" type="file" value="" placeholder="Ảnh đại diện">
                            <small class="form-text text-muted">Image that will be displayed on the list pages. </small>
                        </div>
                        @if(!empty($category->image))
                        <div class="form-group text-center">
                            <input type="hidden" name="current_image" value="<?=$category->image?>">
                            <img src="{{ isset($category->image)?URL::asset('media/article-cat/'.$category->image):'' }}" width="auto" height="300"/>
                            <button id="btn-delete-image" class="btn btn-danger" imgdetailid="<?=$category->id?>" name="deleteimagedetail" value="<?=$category->id?> data-toggle="tooltip" title="Delete current avatar"" type="submit">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <legend>Description</legend>
                        <div class="form-group">
                            <textarea name="des" class="form-control use-ck-editor-advance" rows="15" id="textAreaDes">{{ isset($category)?$category->des:'' }}</textarea>
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
<script src="@asset('js/ckeditor/ckeditor.js')"></script>
<script>
    $(document).ready(function(){
        $('#menu-article').addClass('active');
        CKEDITOR.replace( 'textAreaDes' );
    });
</script>
<?php
function printSub($sub, $parent_process_id, $nth=1) {
    foreach ($sub as $key=>$value) {
?>
        <option value="{!! $value->id !!}" {{ $parent_process_id==$value->id?'selected':'' }}>
<?php
            for ($i = 0; $i < $nth; $i++) {
                echo ' - ';
            }
?>
            {!! $value->name !!}
        </option>
<?php
        if ($value->sub !== null) {
            printSub($value->sub, $parent_process_id, $nth+1);
        }
    }
    return;
}
?>