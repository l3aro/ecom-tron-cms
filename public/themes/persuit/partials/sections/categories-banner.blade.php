<!--================Categories Banner Area =================-->
<?php
    if($banner === 'default') {
        $location = Theme::asset()->absUrl('img/banner/categories-banner.jpg');
    }
    else {
        $location = '/media/product-cat/'.$banner;
    }
?>
<section class="categories_banner_area" style="background-image: url({{$location}});">
    <div class="container">
        <div class="c_banner_inner">
            <h3>{{$title}}</h3>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->