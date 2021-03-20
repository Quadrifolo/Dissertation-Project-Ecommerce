@extends('layouts.app')


@section('content') 
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <link rel="canonical" href="https://getbootstrap.com/docs/3.4/examples/carousel/">

    <title>Carousel Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">



      <style> 

     

</style>
  </head>
<!-- NAVBAR
================================================== -->

    <body onload="myFunction()" style="margin:0;">
      
  
      <div id="loader"></div>

<div id="myDiv" class="animate-bottom">





    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">

        @foreach($homepage as $homepage)
        <div class="item active"> 
          <img class="first-slide" src="/storage/{{$homepage->Img}}" alt="First slide">
          @endforeach
          <div class="container">
            <div class="carousel-caption">
              @guest 
                        
              <h1> {{$dates}} </h1>
              <h1> {{ __("$greetings") }} </h1>
                 <h1>@lang('Welcome To Zakai')</h1>
                 
             
            @if(Route::has('register'))<p><a class="btn btn-lg btn-primary" href="{{ __('Register') }}" role="button">@lang('Register')</a></p>
            @endguest
 @else 
          <h1> {{$dates}} </h1>
            <h1> {{ __("$greetings") }} </h1>
                  <h1>@lang('Welcome Back') {{Auth::user()->name}}  </h1>
            
       
       @endif
             
            </div>
          </div>
        </div>
        
   <!--   <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a> -->
    </div><!-- /.carousel -->



    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">
      <div class="row">
        <div class="col-lg-4">
          <img class="img-circle" img src={{ url('css/Homepage-Icons7.png') }} alt="Generic placeholder image" width="140" height="140">
          <h2>@lang('Shop')</h2>
          <p>We have lots of new products available in different regions click the link below to find out more about the different products we have in your region and in others.</p>
          <p><a class="btn btn-default" href="{{ route('posts.index')}}" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" img src={{ url('css/Homepage-Icons7.png') }}  alt="Generic placeholder image" width="140" height="140">
          <h2>@lang('Blog')</h2>
          <p>Want to see our latest news and updates keep up to date with our blog posts which we post regularly , we go into latest news and fashion tips for our viewers .</p>
          <p><a class="btn btn-default" href="{{ route('shop.index')}}" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle"img src={{ url('css/Homepage-Icons7.png') }}  alt="Generic placeholder image" width="140" height="140">
          <h2>@lang('Lookbook')</h2>
          <p> Want to see our lookbook for our current ranges and be inspired take a look at how we have styled the current range and take inspiration for when you shop yourself.</p>
          <p><a class="btn btn-default" href="{{ route('about.index')}}" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->
      

   
      <!-- START THE FEATURETTES -->

     <!--<hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">Upcoming Coming Events <span class="text-muted">It'll blow your mind.</span></h2>
          <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" img src={{ url('css/Homepage-Icons5.png') }}  alt="Generic placeholder image">
        </div>
      </div> -->

      
   


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>


<body>
</html>
<script src="//cdnjs.cloudflare.com/ajax/libs/processing.js/1.4.1/processing-api.min.js"></script>
<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 3000);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}


  </script>

<script>
  function myFunction() {
    var d = new Date();
    var n = d.toLocaleString();
    document.getElementById("demo").innerHTML = n;
  }
  </script>

    <script type="text/javascript" src="http://localhost:8000/js/jquery.min.js"></script>
  <!--  <script type="text/javascript" src="http://localhost:8000/js/docs/4.4/assets/img/favicons/manifest.json"></script> -->
</body>
</html>
  
@endsection


    