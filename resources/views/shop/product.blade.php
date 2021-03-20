@extends('layouts.app')


@section('content')

<ul class="breadcrumb">

  <li><a href={{ route('pages.index')}} > {{__("Home")}}</a></li>
  <li><a href={{ route('shop.index')}}>{{ __("Shop")}}</a></li>
  <li>{{ __("$products->name")}}</li>
</ul>
<a href={{ route('shop.index') }} class="btn btn-default"> {{ __("Go Back")}}</a>


<div class="container">
<hr>

	
<div class="card">
	<div class="row">
		<aside class="col-sm-5 border-right">
<article class="gallery-wrap"> 
<div class="img-big-wrap">
</div> <!-- slider-product.// -->
<div class="img-small-wrap">
  <div class="item-gallery"> <img src="/storage/{{$products->cover_img}}" width="350" height="500" > </div>
</div> <!-- slider-nav.// -->
</article> <!-- gallery-wrap .end// -->
		</aside>
		<aside class="col-sm-7">
<article class="card-body p-5">
	<h1>{{ __("$products->name")}}</h1>
	
	   

	   


<p class="price-detail-wrap">  
	
	<span class="price h3 text-warning"> 
	
			<h3 id="value"><h3><span>£{{$products->price}}</span></h3>
		
	

</p> <!-- price-detail-wrap .// -->
<form action="{{ route('cart.add', $products->id)}}" method="GET" role="form" id="addToCart">

<dl class="item-property">
  <dt> {{ __("Description")}}</dt>
  {{ __("$products->description")}}
<dl class="param param-feature">
  <dt>Model#</dt>
  <dd>12345611</dd>

<br>
<dt> Size <dt>
	<dd><select class="form-control form-control-sm" style="width:70px;" name="size">
@foreach ($size as $size)

<option> {{$size->name}} </option>
@endforeach

</select>	</dd> 
<!--	<option> M</option>
	<option> L </option> 
</select>	</dd> -->
</dl>  <!-- item-property-hor .// -->
<dl class="param param-feature">
  <dt>Availability</dt>
  <dd> {{$stockValue}} </dd>
   
	
</dl>  <!-- item-property-hor .// -->

<hr>
	<div class="row">
		<div class="col-sm-5">
			<dl class="param param-inline">
			  <dt> {{ __("Quantity")}}: </dt>
			  <dd>
				<input class="form-control" type="number" min="1" value="1" max="{{ $products->quantity }}" name="qty" style="width:70px;">
			 
			  </dd>
			</dl>  <!-- item-property .// -->
		</div> <!-- col.// -->
		<div class="col-sm-7">
			<dl class="param param-inline">
					  
			
				 
			</dl>  <!-- item-property .// -->
		</div> <!-- col.// -->
	</div> <!-- row.// -->
	<hr>
	<button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
</article> <!-- card-body.// -->
		</aside> <!-- col.// -->
	</div> <!-- row.// -->
</div> <!-- card.// -->


</div>
<!--container.//-->

</form>

</article>


<br><br>
<div>
    
</div>
<script>
	$(function() {
	$("#curr").on("change",function() {
	  $(".currencies").hide();
	  $("."+this.value).show();
	}).change();
  });
		  
	  </script>
@endsection