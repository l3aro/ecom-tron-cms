@sections('header')
        
@sections('categories-banner', ['banner'=>$banner??'default', 'title'=>$title??'', 'type'=>'article-cat'])

{{ csrf_field() }}
        
        <!--================Categories Product Area =================-->
        <section class="no_sidebar_2column_area">
            <div class="container">
                <div class="showing_fillter">
                    <div class="row m0">
                        <div class="first_fillter">
                        <h4>Hiển thị {{$articles->firstItem()}} tới {{$articles->lastItem()}} trong {{$articles->total()}} bài viết</h4>
                        </div>
                        <div class="secand_fillter">
                            <h4>LỌC :</h4>
                            <select class="selectpicker">
                                <option value="newest">Mới nhất</option>
                                <option value="oldest">Cũ nhất</option>
                                <option value="name">Tên</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="two_column_product">
                {!! Theme::scope('list-article', ['articles' => $articles])->content() !!}
                </div>
            </div>
        </section>
        <!--================End Categories Product Area =================-->
        
@sections('footer')
<script>

var delay = (function(){
    var timer = 0;
    return function(callback, ms){
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();

$(document).ready(function(){

    $('.selectpicker').change(function(){
        delay(function(){
            run_search();
        }, 130 );
    });

    init_element();
});

function init_element(){
    $('.pagination li a').click(function(e){
        e.preventDefault();
        run_search($(this).attr('href').split('page=')[1]);
    });
}

function run_search(page){
    var valueSelected = $('.selectpicker').val();
    var currentPath = window.location.href;
    $.ajax({
        url: currentPath + '?filter=' + valueSelected + '&page=' + page,
        type: 'GET',
        success: function(data) {
            $('.two_column_product').html(data);
            init_element();
        }
    });
}
</script>