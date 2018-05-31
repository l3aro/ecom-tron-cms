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
            <h2 class="w3ls_head">Article Detail</h2>
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
            <form method="post" action="/admin/product/detail?id={{ isset($product)?$product->id:'' }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="save-group-buttons">
                        <button name="submit" class="btn btn-md btn-success" data-toggle="tooltip" title="Save">
                            <i class="fa fa-save"></i>
                        </button> 
                        <button class="btn btn-md btn-primary float-right" data-toggle="tooltip" title="Add new product" onclick="event.preventDefault();window.location.href='{{route('admin.product.detail')}}';">
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
                                <input class="form-control" name="id" type="text" value="{{ isset($product)?$product->id:'' }}" readonly="readonly">
                                <small class="form-text text-muted">ID is the code of the product, this is a unique property</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="focusedInput">Title</label>
                                <input class="form-control" name="name" type="text" required value="{{ isset($product)?$product->name:'' }}" placeholder="Article title">
                                <small class="form-text text-muted">Name of the product</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Category</label>
                                <select class="form-control" name="cat">
                                    
                                </select>
                                <small class="form-text text-muted">Select the category of this product</small>
                            </div>
                            <div class="form-group">
                                    <label class="control-label" for="focusedInput">Optimize URLs</label>
                                    <input class="form-control" name="slug" type="text" value="{{ isset($product)?$product->slug:'' }}" placeholder="Tối ưu URL" pattern="[a-z0-9/-]{5,}">
                                    <small class="form-text text-muted">Optimize the URL path to the best for SEO. For example: "product-name" self-generated system is: http://domainame.com/product-name</small>
                                </div>
                            <div class="form-group">
                                <label class="control-label">Public</label>
                                <input type="checkbox" class="checkbox-toggle" name="public" id="public" {{ isset($product)&&$product->public==1?'checked':'' }}/>
                                <small class="form-text text-muted">When "Public" feature is selected, this product will be displayed on the site interface.</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Highlight</label>
                                <input type="checkbox" class="checkbox-toggle" name="highlight" id="highlight" {{ isset($product)&&$product->highlight==1?'checked':'' }}/>
                                <small class="form-text text-muted">When "Highlight" feature is selected, this product will be displayed on the homepage or points indicated on the interface.</small>
                            </div>
                            <div class="form-group">
                                <label class="control-label">New</label>
                                <input type="checkbox" class="checkbox-toggle" name="new" id="new" {{ isset($product)&&$product->new==1?'checked':'' }}/>
                                <small class="form-text text-muted">When the "New" feature is selected, this product will be displayed on the homepage or on points specified on the interface.</small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="control-label" for="focusedInput">Avatar</label>
                                <input class="form-control" name="image" type="file" value="" placeholder="Ảnh đại diện">
                                <small class="form-text text-muted">Image that will be displayed on the list pages. </small>
                            </div>
                            @if(!empty($product->image))
                            <div class="form-group text-center">
                                <input type="hidden" name="current_image" value="<?=$product->image?>">
                                <img src="{{ isset($product->image)?URL::asset('media/product/'.$product->image):'' }}" width="auto" height="300"/>
                                <button id="btn-delete-image" class="btn btn-danger" imgdetailid="<?=$product->id?>" name="deleteimagedetail" value="<?=$product->id?> data-toggle="tooltip" title="Delete current avatar"" type="submit">
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
                                <textarea name="des" class="form-control use-ck-editor-advance" rows="15" id="textAreaDes">{{ isset($product)?$product->des:'' }}</textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <legend>Detail</legend>
                            <div class="form-group">
                                <textarea name="detail" class="form-control use-ck-editor-advance" rows="15" id="textAreaDetail">{{ isset($product)?$product->detail:'' }}</textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            @if($product->id != null)
                <div class="row">
                    <div class="col-lg-12">
                        <legend>Relate images ( Up to 10 images )</h3>
                        <!-- The file upload form used as target for the file upload widget -->
                        <form id="fileupload" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" value="<?=$product->id?>" name="pid">
                            <!-- Redirect browsers with JavaScript disabled to the origin page -->
                            <noscript>
                                <input type="hidden" name="redirect" value="/">
                            </noscript>
                            <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                            <div class="fileupload-buttonbar row" style="margin-bottom: 15px;">
                                <div class="col-md-6">
                                    <div class="fileupload-buttons">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="fileinput-button btn btn-sm btn-info">
                                            <i class="fa fa-folder-open-o"></i>
                                            <span>Add image ...</span>
                                            <input type="file" name="files[]" multiple>
                                        </span>
                                        <button type="submit" class="start btn btn-sm btn-success">
                                            <i class="fa fa-upload"></i>
                                            Upload all
                                        </button>
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    <!-- The global progress state -->
                                    <div class="fileupload-progress fade" style="display:none">
                                        <!-- The global progress bar -->
                                        <div class="progress" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                        <!-- The extended global progress state -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                </div>
                            </div>
                            <!-- The table listing the files available for upload/download -->
                            <div role="presentation">
                                <div id="sortable" class="files row"></div>
                            </div>
                        </form>
                        @if( isset($productImages) && count($productImages) > 0 )
                        <div class="row">
                            @foreach ( $productImages as $row )
                                <div class="col-lg-3 col-md-4 col-xs-6 p-3 border list-image">
                                    <a class="d-block mh-100 mw-100" style="height: 250px; overflow: hidden" href="/media/product/<?=$product->id?>/<?php echo $row->image;?>" target="_blank">
                                        <img src="/media/product/<?=$product->id?>/<?php echo $row->image;?>" style="max-height: 100%">
                                    </a><br/>
                                    <a class="btn btn-danger btn-sm delete-product-image" href="javascript:void(0)" imgdetailid="<?=$row->id?>"
                                             data-toggle="tooltip" title="Xóa">
                                                <i class="material-icons">delete</i>
                                            </a>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
                @endif
        </div>
</section>
 <!-- footer -->
@partial('footer')
  <!-- / footer -->
</section>
<script src="@asset('js/ckeditor/ckeditor.js')"></script>
<script>
    $(document).ready(function(){
        CKEDITOR.replace( 'textAreaDes' );
        CKEDITOR.replace( 'textAreaDetail' );
    });
</script>
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="@asset('css/js-upload/jquery.fileupload.css')">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript>
	<link rel="stylesheet" href="@asset('css/js-upload/jquery.fileupload-noscript.css')">
</noscript>
<style type="text/css">
	.fade {
		opacity: 1;
	}

	.template-download img {
		width: 150px;
		height: 100px;
	}
</style>
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="template-upload col-lg-3 col-md-4 col-xs-6 p-3 border" id="item_1">
        <span class="preview"></span>
        <p class="name">{%=file.name%}</p>
                <strong class="error"></strong>
        <p class="size">Processing...</p>
                <div class="progress"></div>
        
                {% if (!i && !o.options.autoUpload) { %}
                <button class="start btn btn-success" disabled><i class="fa fa-upload"></i> Upload</button>
            {% } %}
            {% if (!i) { %}
                <button class="cancel btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
            {% } %}
    </div>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="col-lg-3 col-md-4 col-xs-6 p-3 border">
                    {% if (file.thumbnailUrl) { %}
        <a class="d-block mh-100 mw-100" style="height: 250px; overflow: hidden" href="{%=file.url%}" title="{%=file.name%}" target="_blank">
            <img src="{%=file.thumbnailUrl%}" style="max-height: 100%">
        </a>
        <a class="btn btn-success btn-sm" href="#">
                                         <i class="material-icons">check_circle</i> Upload thành công
                                    </a>
                    {% } %}
                {% if (file.error) { %}
                    <div><span class="error">Error</span> {%=file.error%}</div>
                {% } %}
    </div>
    {% } %}
</script>
<script src="@asset('js/js-upload/tmpl.min.js')"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="@asset('js/js-upload/load-image.min.js')"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="@asset('js/js-upload/canvas-to-blob.min.js')"></script>
<!-- blueimp Gallery script -->
<script src="@asset('js/js-upload/jquery.blueimp-gallery.min.js')"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="@asset('js/js-upload/jquery.iframe-transport.js')"></script>
<!-- The basic File Upload plugin -->
<script src="@asset('js/js-upload/jquery.fileupload.js')"></script>
<!-- The File Upload processing plugin -->
<script src="@asset('js/js-upload/jquery.fileupload-process.js')"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="@asset('js/js-upload/jquery.fileupload-image.js')"></script>
<!-- The File Upload audio preview plugin -->
<script src="@asset('js/js-upload/jquery.fileupload-audio.js')"></script>
<!-- The File Upload video preview plugin -->
<script src="@asset('js/js-upload/jquery.fileupload-video.js')"></script>
<!-- The File Upload validation plugin -->
<script src="@asset('js/js-upload/jquery.fileupload-validate.js')"></script>
<!-- The File Upload user interface plugin -->
<script src="@asset('js/js-upload/jquery.fileupload-ui.js')"></script>
<script>
    var CSRF_TOKEN = $('[name="_token"]').val();
    $(function () {
        'use strict';
        $('#fileupload').fileupload({
            // Uncomment the following to send cross-domain cookies:
            //xhrFields: {withCredentials: true},
            url: '/admin/product/uploadimage'
            , limitMultiFileUploads: 10
        });
    });
    $(document).ready(function () {
        $('#btn-delete-image').click(function(e){
            e.preventDefault();
            if (confirm('Are you sure?')){
                var id = $(this).attr('imgdetailid');
                $.ajax({
                    url: '/admin/product/deleteavatar?id=' + id,
                    async: false,
                    method: 'GET',
                    success: function(){
                        window.location.href="/admin/product/detail?id=<?=$product->id ?>";
                    }
                    });
            } else {
                return false;
            }
        });
        $('.delete-product-image').click(function(e){
            e.preventDefault();
            if (confirm('Are you sure?')){
                var id = $(this).attr('imgdetailid');
                var button = $(this);
                $.ajax({
                    url: '/admin/product/deleteproductimage?id=' + id,
                    async: false,
                    method: 'GET',
                    success: function(){
                        button.parents('.list-image').remove();
                    }
                    });
            } else {
                return false;
            }
        });
    });
</script>