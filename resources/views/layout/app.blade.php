<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel= "stylesheet" href="{{asset('css/app.css')}}">
        <title> Zakai </title>


    </head>
    <body>
        <div class = "container" >
            @include('inc.messages')
            @yield('content')
        </div>
        <script src="//cdn.ckeditor.com/4.4.7/standard/ckeditor.js"></script>">
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
        @yield('scripts')
    </body>
</html>



