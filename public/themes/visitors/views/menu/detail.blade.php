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
        <h2 class="w3ls_head">Menu Option Detail</h2>
        <div class="grid_3 grid_5 w3ls">
        @if($saved == 1)
            <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Data has been saved to the database.
            </div>
        @endif
        <form method="post" action="/admin/menu/detail?cat={{ $cat or '' }}&&id={{ isset($menu)?$menu->id:'' }}" enctype="multipart/form-data">
            {{ csrf_field() }}
                <div class="save-group-buttons">
                    <button name="submit" class="btn btn-md btn-success" data-toggle="tooltip" title="Save">
                        <i class="fa fa-save"></i>
                    </button> 
                    <button class="btn btn-md btn-primary float-right" data-toggle="tooltip" title="Add new category" onclick="event.preventDefault();window.location.href='{{route('admin.menu.detail')}}?cat={{$cat or ''}}';">
                            <i class="fa fa-plus"></i>
                    </button>
                    <button class="btn btn-md btn-info float-right" style="margin-right: 0.5rem;" data-toggle="tooltip" title="Add new category" onclick="event.preventDefault();window.location.href='{{route('admin.menu.index')}}?cat={{$cat or ''}}';">
                            <i class="fa fa-arrow-left"></i>
                    </button>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <legend>Basic infomation</legend>
                        <input class="form-control" name="id" type="hidden" required value="{{ isset($menu)?$menu->id:'' }}">
                        <div class="form-group">
                            <label class="control-label" for="focusedInput">Title</label>
                            <input class="form-control" name="name" type="text" required value="{{ isset($menu)?$menu->name:'' }}" placeholder="Category title">
                            <small class="form-text text-muted">Name of the category</small>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Category</label>
                            <select class="form-control" name="parent">
                                <option value="0"></option>
                                @if ($menu_options)
                                    @foreach ($menu_options as $option)
                                        <option value="{!! $option->id !!}" {{ $menu->parent==$option->id?'selected':'' }}>{!! $option->name !!}</option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="form-text text-muted">Select the parent of this category</small>
                        </div>
                        <div class="form-group" >
                            <label class="control-label">Menu type</label>
                            <select class="form-control" name="type" id="list-option">
                                <option value="0" {!! $menu->type==0?'selected':'' !!}>Custom link</option>
                                <option value="1" {!! $menu->type==1?'selected':'' !!}>[Article] Link into an article catgory</option>
                                <option value="2" {!! $menu->type==2?'selected':'' !!}>[Article] Synchronized with the entire subdivision of an category</option>
                                <option value="3" {!! $menu->type==3?'selected':'' !!}>[Article] Synchronized article category</option>
                                <option value="4" {!! $menu->type==4?'selected':'' !!}>[Article] Link into a certain article</option>
                                <option value="5" {!! $menu->type==5?'selected':'' !!}>[Product] Link into a product catgory</option>
                                <option value="6" {!! $menu->type==6?'selected':'' !!}>[Product] Synchronized with the entire subdivision of an category</option>
                                <option value="7" {!! $menu->type==7?'selected':'' !!}>[Product] Synchronized product category</option>
                                <option value="8" {!! $menu->type==8?'selected':'' !!}>[Product] Link into a certain product</option>
                                <option value="9" {!! $menu->type==9?'selected':'' !!}>[Product] Link into list new featured product</option>
                                <option value="10" {!! $menu->type==10?'selected':'' !!}>[Product] Link into list promotion product</option>
                            </select>
                        </div>
                        <div class="form-group {!!$menu->type==0?'d-block':'d-none'!!}" id="form-link"  >
                            <label class="control-label">URL</label>
                            <input class="form-control" name="link" type="text" value="{!!$menu->link!!}"
                                placeholder="URL (Link)">
                            <small>Custom link</small>
                        </div>
                        <div class="form-group {!!$menu->type==1||$menu->type==2?'d-block':'d-none'!!}" id="form-article-cat">
                            <label class="control-label">Category</label>
                            <select class="form-control" name="article_cat">
                                @if($article_cat_options)
                                    @foreach ($article_cat_options as $option)
                                        <option value="{!! $option->id !!}" {{ $menu->article_cat==$option->id?'selected':'' }}>{!! $option->name !!}</option>
                                        @php
                                            if ($option->sub !== null) {
                                                printSub($option->sub, $menu->article_cat);
                                            }
                                        @endphp
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group {!!$menu->type==5||$menu->type==6?'d-block':'d-none'!!}" id="form-product-cat">
                            <label class="control-label">Chọn mục</label>
                            <select class="form-control" name="product_cat">
                                @if($product_cat_options)
                                    @foreach ($product_cat_options as $option)
                                        <option value="{!! $option->id !!}" {{ $menu->product_cat==$option->id?'selected':'' }}>{!! $option->name !!}</option>
                                        @php
                                            if ($option->sub !== null) {
                                                printSub($option->sub, $menu->product_cat);
                                            }
                                        @endphp
                                    @endforeach
                                @endif
                            </select>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <legend>Menu type explanation</legend>
                        <div class="well">
                            <ul>
                                <li style="margin-bottom:0.5rem;"><b>Custom link</b> When clicked on this menu will redirect to the specified URL</li>
                                <li style="margin-bottom:0.5rem;"><b>[Article] Link into an article catgory</b> Clicking on this menu will redirect directly to the article list page under the selected category</li>
                                <li style="margin-bottom:0.5rem;"><b>[Article] Synchronized with the entire subdivision of an category</b> The system will generate sub-menus that are sub-items of the selected item and each submenu will link to the article list page according to the selected item.</li>
                                <li style="margin-bottom:0.5rem;"><b>[Article] Synchronized article category</b> The system generates all the items in the database in accordance with the structure of the intended parent</li>
                                <li style="margin-bottom:0.5rem;"><b>[Article] Link into a certain article</b> Clicking on this menu will redirect to the detail page of the selected article</li>
                                <li style="margin-bottom:0.5rem;"><b>[Product] Link into a product catgory</b> Clicking on this menu will redirect directly to the product list page under the selected item</li>
                                <li style="margin-bottom:0.5rem;"><b>[Product] Synchronized with the entire subdivision of an category</b> The system generates sub-menus that are sub-items of the selected item and each submenu will link to the product list page under the selected item.</li>
                                <li style="margin-bottom:0.5rem;"><b>[Product] Synchronized product category</b> The system generates all product items in the database in accordance with the structure of the intended parent</li>
                                <li style="margin-bottom:0.5rem;"><b>[Product] Link into a certain product</b> Clicking this menu will redirect to the detail page of the selected product</li>
                                <li style="margin-bottom:0.5rem;"><b>[Product] Link into list new featured product</b> Clicking on this menu will redirect directly to the latest and have "new" option product list page</li>
                                <li style="margin-bottom:0.5rem;"><b>[Product] Link into list promotion product</b> Clicking on this menu will redirect directly to the promotion product list page under the selected item</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12" id="list-data-table">
                    </div>
                </div>
                <input type="hidden" name="product_id" id="product_id" value="<?=$menu->product_id?>">
	            <input type="hidden" name="article_id" id="article_id" value="<?=$menu->article_id?>">
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
        $('#menu-menu').parent('li').addClass('active');
        $('#list-option').change(function () {
            $('#list-data-table').html('');
            var selectedIndex = $("#list-option").find("option:selected").val();
            //Option selected: Link
            if (selectedIndex === "0") {
                $("#form-link").removeClass('d-none').addClass('d-block');
            } else {
                $("#form-link").removeClass('d-block').addClass('d-none');
            }
            //Option selected: Syn with Article Categories
            if (selectedIndex === "1" || selectedIndex === "2") {
                $("#form-article-cat").removeClass('d-none').addClass('d-block');
            } else {
                $("#form-article-cat").removeClass('d-block').addClass('d-none');
            }
            //Option selected: Syn with Product Categories
            if (selectedIndex === "5" || selectedIndex === "6") {
                $("#form-product-cat").removeClass('d-none').addClass('d-block');
            } else {
                $("#form-product-cat").removeClass('d-block').addClass('d-none');
            }
            if (selectedIndex === "4") {
                run_search_article();
            }
            if (selectedIndex === "8") {
                run_search_product();
            }
        });
        var selectedIndex = $("#list-option").find("option:selected").val();
        
        if (selectedIndex === "4") {
            display_article(<?=$menu->article_id?>);
        }
        if (selectedIndex === "8") {
            display_product(<?=$menu->product_id?>);
        }
    });
    function init_list_form_action() {
        $('#keyword').keyup(function(){
            delay(function(){
                var selectedIndex = $("#list-option").find("option:selected").val();
                if (selectedIndex === "4") {
                    run_search_article();
                }
                if (selectedIndex === "8") {
                    run_search_product();
                }
            }, 200 );
        });
        $('.search-change').change(function(){
            var selectedIndex = $("#list-option").find("option:selected").val();
            if (selectedIndex === "4") {
                run_search_article();
            }
            if (selectedIndex === "8") {
                run_search_product();
            }
        });
        $('.pagination li').addClass('page-item');
        $('.pagination li a').addClass('page-link');
        $('.pagination li span').addClass('page-link');
        $('.pagination li a').click(function(e){
            e.preventDefault();
            var selectedIndex = $("#list-option").find("option:selected").val();
            if (selectedIndex === "4") {
                run_search_article($(this).attr('href').split('page=')[1]);
            }
            if (selectedIndex === "8") {
                run_search_product($(this).attr('href').split('page=')[1]);
            }
        });
    }
    function init_row_action() {
        $('.choose-record').click(function(){
            var recordId = $(this).attr('record-id');
            var selectedIndex = $("#list-option").find("option:selected").val();
            if (selectedIndex === "4") {
                $('#article_id').val(recordId);
                display_article(recordId);
            }
            if (selectedIndex === "8") {
                $('#product_id').val(recordId);
                display_product(recordId);
            }
        });
    }
    function run_search_article(page){
        var keyword = $('#keyword').val();
        var cat = $('#cat').val();
        if(!keyword) keyword = '';
        if(!cat) cat = 0; 
        if(!page) page = 1; 
        $.ajax({
            url: '/admin/menu/list_articles?keyword=' + keyword + '&cat=' + cat + '&page=' + page,
            type: 'GET',
            success: function(data) {
                $('#list-data-table').html(data);
                init_list_form_action();
                init_row_action();
            }
        });

    }
    function run_search_product(page){
        var keyword = $('#keyword').val();
        var cat = $('#cat').val();
        if(!keyword) keyword = '';
        if(!cat) cat = 0; 
        if(!page) page = 1; 
        $.ajax({
            url: '/admin/menu/list_products?keyword=' + keyword + '&cat=' + cat + '&page=' + page,
            type: 'GET',
            success: function(data) {
                $('#list-data-table').html(data);
                init_list_form_action();
                init_row_action();
            }
        });

    }

    function display_article(id){
        $.ajax({
            url: '/admin/menu/get_article?id=' + id,
            type: 'GET',
            success: function(data) {
                var articleCatName = '';
                if (data.article_cat) articleCatName = data.article_cat.name;
                $('#list-data-table').html('Linking into article: ' 
                + '<table class="table-sm table-hover table-bordered mb-2" id="table_content" width="100%">'
                + '<thead class="thead-light">'
                +	'<tr>'
                    +	'<th class="align-middle" style="width: 50px;">ID</th>'
                    +	'<th class="align-middle">Article name</th>'
                    +	'<th class="align-middle">Category</th>'
                    +	'<th class="align-middle" style="width: 120px;">Date modified</th>'
                +	'</tr>'
                + '</thead>'
                + '<tbody>'
                + '<tr>'
                + '<td>' + data.article.id + '</td>'
                + '<td class="edit-name">'
                +	'<a href="/admin/article/detail/' + data.article.id + '" target="_blank">' + data.article.name + '</a>'
                + '</td>'
                + '<td>'
                + '<a href="/admin/articlecat/detail/' + data.article.cat + '" target="_blank">' + articleCatName + '</a>'
                + '</td>'
                +	'<td>' + data.article.updated_at + '</td>'
                + '</tr>'
                + '</tbody>'
                + '</table>'
                + '<button class="btn btn-sm btn-info button-choose-article">Chọn bài viết khác</button>'
                );
                $('.button-choose-article').click(function(e){
                    e.preventDefault();
                    run_search_article(0);
                });
            }
        });
    }

    function display_product(id){
        $.ajax({
            url: '/admin/menu/get_product?id=' + id,
            type: 'GET',
            success: function(data) {
                var productCatName = '';
                if (data.product_cat) productCatName = data.product_cat.name;
                $('#list-data-table').html('Linking into product: ' 
                + '<table class="table-sm table-hover table-bordered mb-2" id="table_content" width="100%">'
                + '<thead class="thead-light">'
                +	'<tr>'
                    +	'<th class="align-middle" style="width: 50px;">ID</th>'
                    +	'<th class="align-middle" style="width: 50px;">Ảnh</th>'
                    +	'<th class="align-middle">Product name</th>'
                    +	'<th class="align-middle" style="width: 120px;">Ngày tạo</th>'
                +	'</tr>'
                + '</thead>'
                + '<tbody>'
                + '<tr>'
                + '<td>' + data.product.id + '</td>'
                + '<td class="edit-name">'
                +	'<a href="/admin/product/detail?id=' + data.product.id + '" target="_blank">' + data.product.name + '</a>'
                + '</td>'
                + '<td>'
                + '<a href="/admin/productcat/detail?id=' + data.product.cat + '" target="_blank">' + productCatName + '</a>'
                + '</td>'
                +	'<td>' + data.product.updated_at + '</td>'
                + '</tr>'
                + '</tbody>'
                + '</table>'
                + '<button class="btn btn-sm btn-info button-choose-product">Chọn sản phẩm khác</button>'
                );
                $('.button-choose-product').click(function(e){
                    e.preventDefault();
                    run_search_product(0)
                });
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