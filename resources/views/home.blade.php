@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ __('Dashboard') }}</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <h3>{{ __('Recent Updates') }}</h3>
                    @if(count($posts) > 0)
                        <table class="table table-striped">
                                <tr>
                                    <th> @lang('Title')</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                @foreach($posts as $post)
                                <tr>
                                  <td>  <a href="/posts/{{$post->id}}">{{$post->title}}</a></td>
                                  
                                    <td>
                                        
                              
                                    </td>
                                </tr>
                                @endforeach
                            </table>

                            @else 
                            <p> No Posts Available </p>


                            @endif
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
