<!DOCTYPE html>
<html lang="en">

    <head>
        {!! meta_init() !!}
        <link rel="icon" href="@asset('img/fav-icon.png')" type="image/x-icon" />
        <meta name="keywords" content="@get('keywords')">
        <meta name="description" content="@get('description')">
        <meta name="author" content="@get('author')">
    
        <title>Persuit - @get('title')</title>

        @styles()
        
    </head>

    <body>
        @content()

        @scripts()
    </body>

</html>
