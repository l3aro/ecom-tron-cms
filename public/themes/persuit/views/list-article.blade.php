<div class="row">
@foreach($articles as $article)
    <div class="col-lg-4 col-sm-6">
        <a href="/cam-nang/{{$article->slug}}">
            <div class="l_product_item">
                <div class="l_p_img">
                    <img class="img-fluid" src="{{ asset('media/article/'.$article->image) }}" alt="">
                </div>
                <div class="l_p_text">
                    <ul>
                        <li><a class="add_cart_btn" href="/cam-nang/{{$article->slug}}">Xem chi tiết</a></li>
                    </ul>
                    <h4>{!! $article->name !!}</h4>
                </div>
            </div>
        </a>
    </div>
@endforeach
</div>
<nav aria-label="Page navigation example" class="pagination_area">
    <!-- <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">4</a></li>
    <li class="page-item"><a class="page-link" href="#">5</a></li>
    <li class="page-item"><a class="page-link" href="#">6</a></li>
    <li class="page-item next"><a class="page-link" href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
    </ul> -->
    {{$articles->links()}}
</nav>