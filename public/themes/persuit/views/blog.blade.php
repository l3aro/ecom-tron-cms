@sections('header')
        
@sections('categories-solid',['title' => $title])
        
        <!--================Contact Area =================-->
        <section class="contact_area p_100">
            <div class="container">
                <div class="text-center"><i><b>{!!$article->des!!}</b></i></div>
                <br>
                {!!$article->detail!!}
            </div>
        </section>
        <!--================End Contact Area =================-->
        
@sections('footer')               