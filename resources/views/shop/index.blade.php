@extends('layouts.app')

<html>
<head>
<style>
.active {
  color: red;
  background-color: yellow;
}
</style>
</head>




@section('content')

 
<div id="loader"></div>

<div id="myDiv" class="animate-bottom">


  
   <!-- <h2> {{ __('Products') }}</h2> -->



        
    

<div class="row">
  <div class="col-md-4 order-md-2 mb-4">
    <h4 class="d-flex justify-content-between align-items-left mb-3">
                  
        <li class="list-group-item d-flex justify-content-between lh-condensed">

 <h4>@lang('Categories')</h4>
       

 
  <div class="row">
      <div class="col-sm-3 col-sm-offset-1">
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div class="sidebar-module sidebar-module-inset">
          </div>
          <div class="sidebar-module">
            <div class="shop-sidebar mr-50">
              <div class="sidebar-widget mb-50">
                  <h3 class="sidebar-title">@lang('Search Products')</h3>
                  <div class="sidebar-search">
                  <form action="{{ route('products.search') }}">
                          <input name="query" placeholder=@lang('Search Products')... type="text">
                          <button type="submit"><i class="btn-btn-secondary"> @lang('Search')</i></button>
                      </form>
                  </div>
              </div> 
          </div>
            <a href="{{ route('shop.index') }}">@lang('View All') </a>
            @foreach($category as $category)

            <ol class="list-unstyled">
              <li><a href="{{route('shop.index',['category_id' => $category->id ])}} ">{{ __("$category->name") }}</a></li>
          
               @endforeach

             



            </ol>
      
          </div>
          <div class="sidebar-module">
           <!-- <h4>@lang('View Shop In') .. </h4> -->
            
            
            
           


          </div>
        </div><!-- /.blog-sidebar -->
       
        @foreach ($products as $product)

       

        

        <div class="col-md-4 col-sm-6">
            <div class="thumbnail" >
                <img src="/storage/{{$product->cover_img}}" alt="Card image cap" >
                <div class="card-body">
                    <h4><a href= "{{ route('shop.product' , $product->id) }}">{{ __("$product->name")}}</a></h4>
                 <!--<p class="card-text">{{$product->description}}</p>-->
                  
                  <!-- <h5> @lang('Region'): {{$product->locale}} </h5> -->
                   
              
                  <h3 id="value">  £ {{$product->price}}</span></h3>
              
             
                </div>
                 
            </div>
        </div>
        

        @endforeach
       
      </div>
     
  
     
     
 
      
      
    



 
   
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     

<script>
  $(function() {
  $("#curr").on("change",function() {
    $(".currencies").hide();
    $("."+this.value).show();
  }).change();
});
        
    </script>
@endsection