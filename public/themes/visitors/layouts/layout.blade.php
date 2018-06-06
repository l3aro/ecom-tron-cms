<!DOCTYPE html>
<html lang="en">

    <head>
        {!! meta_init() !!}
        <meta name="keywords" content="@get('keywords')">
        <meta name="description" content="@get('description')">
        <meta name="author" content="@get('author')">
        <link rel="icon" href="@asset('images/fav-icon.png')" type="image/x-icon" />
    
        <title>@get('title')</title>

        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- bootstrap-css -->
        <link rel="stylesheet" href="@asset('css/bootstrap.min.css')" >
        <link rel="stylesheet" href="@asset('css/bootstrap-grid.min.css')" >
        <link rel="stylesheet" href="@asset('css/bootstrap-reboot.min.css')" >
        <!-- //bootstrap-css -->
        <!-- Custom CSS -->
        <link href="@asset('css/style.css')" rel='stylesheet' type='text/css' />
        <link href="@asset('css/style-responsive.css" rel="stylesheet')"/>
        <!-- font CSS -->
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <!-- font-awesome icons -->
        <link rel="stylesheet" href="@asset('css/font.css" type="text/css')"/>
        <link href="@asset('css/font-awesome.css" rel="stylesheet')"> 
        <link rel="stylesheet" href="@asset('css/morris.css" type="text/css')"/>
        <!-- calendar -->
        <link rel="stylesheet" href="@asset('css/monthly.cs')s">
        <!-- //calendar -->
        <!-- //font-awesome icons -->
        <script src="@asset('js/jquery-3.2.1.min.js')"></script>
        <script src="@asset('js/jquery-ui.min.js')"></script>
        <script src="@asset('js/raphael-min.js')"></script>
        <script src="@asset('js/morris.js')"></script>
        
    </head>

    <body>
        <section id="container">
        @content()
        </section>
        <script src="@asset('js/bootstrap.js')"></script>
        {{-- <script src="@asset('js/bootstrap.bundle.min.js')"></script> --}}
        {{-- <script src="@asset('js/popper.min.js')"></script>  --}}
        <script src="@asset('js/jquery.dcjqaccordion.2.7.js')"></script>
        <script src="@asset('js/scripts.js')"></script>
        <script src="@asset('js/jquery.slimscroll.js')"></script>
        <script src="@asset('js/jquery.nicescroll.js')"></script>
        <script src="@asset('js/jquery.scrollTo.js')"></script>
    </body>

</html>
