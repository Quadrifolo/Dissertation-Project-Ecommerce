@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-default"> {{ __("Go Back") }}</a>
<h1>{{$posts->title}}</h1>
<img style=" width:50% "img src="/storage/{{$posts->image}}">
<br><br>
<div>
    {{$posts->body}}
</div>
<hr>
<small> {{ __("Written on") }} {{$posts->created_at}}  {{ __("by") }} {{$posts->author_id}}</small>
<hr>
@if(!Auth::guest()) 
    @if(Auth::user()->id == $posts->user_id)
<a href="/posts/{{$posts->id}}/edit" class="btn btn=default">Edit</a>

{!!Form::open(['action' => ['PostsController@destroy', $posts->id], 'method'=> 'POST', 'class' => 'pull-right'])!!}
{{Form::hidden('_method', 'DELETE')}}
{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
{!!Form::close()!!}
    @endif
@endif
@endsection