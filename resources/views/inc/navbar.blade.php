<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>



            <div class="centre-image">

            <!-- Branding Image -->
            <a class="navbar-brand" href={{ route('pages.index')}}>
                <img src="{{ url('pictures/disso-logo2.png') }}"alt="">
              
            </a>
            </div>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <ul class ="nav navbar-nav">
                <li class="active">
                <li><a href= {{ route('pages.index')}}>{{ __('Home') }}</a></li>
             <li><a href= {{ route('lookbook.index')}}>{{ __('Lookbook')}}</a></li> 
                <li><a href={{ route('shop.index')}}> {{ __('Shop') }}</a></li>
                <li><a href={{ route('posts.index')}}>{{ __('Blog') }}</a></li>
            </ul>
        <ul>


            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">

                
                
               




                <li >
                    <a href="{{ route('cart.index')}}">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Cart') }}
                            <div class="badge">
                                
                                {{Cart::session(session()->getid())->getContent()->count()}}
                                
                                
                                
                            </div>
                        </a>                    

                    </li>
                <!-- Authentication Links -->
                @guest
                        




                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif

                      

                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('login') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                               

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
            </ul>
        </div>
    </div>
</nav>
  {{-- display success message --}}
  @if(session()->has('message'))
  <div class="alert alert-success text-center" role="alert">
     {{session('message')}}
  </div>
@endif

{{-- display error message --}}

@if(session()->has('error'))
<div class="alert alert-danger text-center" role="alert">
  {{session('error')}}
</div>
@endif


</div>




</body>

</html>




