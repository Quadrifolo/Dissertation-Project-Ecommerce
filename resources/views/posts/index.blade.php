@extends('layouts.app')

@section('content')


<div id="loader"></div>

<div id="myDiv" class="animate-bottom">

<div class="card my-4">
  <form action="{{ route('posts.search') }}">
    <input name="query" placeholder="Search Posts..." type="text">
    <button type="submit"><i class="btn-btn-secondary"> @lang('Search')</i></button>
</form>

</div>



<h1> {{ __('Posts') }} </h1>
@if(count($posts)>= 1)
     @foreach($posts as $posts)
            <div class ="well">
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <img style= "width:50% " img src="/storage/{{$posts->image}}">
                        </div>

                <h3><a href="/posts/{{$posts->id}}">{{$posts->title}}</a></h3>


                        

                          
              <small>{{ __('Written on') }} {{$posts->created_at}} {{ __('by') }} {{$posts->author_id}}  </small>
            </div>
            @endforeach
         <!--   {{ route('posts.index', app()->getLocale())}} -->
    @else 
        <p>No Posts Found</p>
    @endif

            </div>
  

@endsection
