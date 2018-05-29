<!DOCTYPE html>
<html lang="en">

    <head>
        {!! meta_init() !!}
        <meta name="keywords" content="@get('keywords')">
        <meta name="description" content="@get('description')">
        <meta name="author" content="@get('author')">
    
        <title>@get('title')</title>

        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- bootstrap-css -->
        <link rel="stylesheet" href="@asset('css/bootstrap.min.css')" >
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
        <script src="@asset('js/jquery2.0.3.min.js')"></script>
        <script src="@asset('js/raphael-min.js')"></script>
        <script src="@asset('js/morris.js')"></script>
        
    </head>

    <body>
        @content()

        <script src="@asset('js/bootstrap.js')"></script>
        <script src="@asset('js/jquery.dcjqaccordion.2.7.js')"></script>
        <script src="@asset('js/scripts.js')"></script>
        <script src="@asset('js/jquery.slimscroll.js')"></script>
        <script src="@asset('js/jquery.nicescroll.js')"></script>
        <script src="@asset('js/jquery.scrollTo.js')"></script>
    </body>

</html>
