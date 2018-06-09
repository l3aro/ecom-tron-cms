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
            <h3>shop grid with left sidebar</h3>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="#">Shop</a></li>
                <li class="current"><a href="#">Shop Grid with Left Sidebar</a></li>
            </ul>
        </div>
    </div>
</section>
<!--================End Categories Banner Area =================-->