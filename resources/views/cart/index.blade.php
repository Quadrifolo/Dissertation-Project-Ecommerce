@extends('layouts.app')



@section('content')



<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


				<div class="panel-body">

					<div class="row">
                        
					
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-16">
                                    <div class="panel panel-info">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <h3><span class="glyphicon glyphicon-shopping-cart"></span>  {{ __('Your Cart') }}  </h3>
                                                    </div>
                                                    <div class="col-xs-6">
                                                     
                                                       
                                                        <a href={{route('shop.index')}}>
                                                            <button class="btn btn-primary btn-sm btn-block">Continue Shopping</button>
                                                         </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <!-- FIX UP CART INFORMATION AND ADD SHIPPING -->

     <table class="table">
        @if(Cart::isEmpty())

        <h4> Cart Is Empty </h4>
        @endif 
    <thead>
        
        <tr>
            <th> {{ __('Name') }} 
 </th>
            <th> {{ __('Price') }} </th>
            <th> {{ __('Quantity') }}</th>

            <th>{{ __('Action')}}</th>
        </tr>
    </thead>
    <tbody>
      <!-- {{ session()->getid()}} -->
    
        @foreach ($cartItems as $item)    
                   
     
        

        <tr>
            </div> </td>
            <td scope="row"> <div class="col-lg-3">
               
                <img src="/storage/{{$item->image}}" class="img-thumbnail" width="200" height="200"> </div>{{ __($item->name) }} <br>
           
                
                Size :{{ $item->attributes}}</td>

            <td>
                    

               £ {{Cart::session(session()->getid())->get($item->id)->getPriceSum()}}
            </td>
            <td>
            <form action="{{route('cart.update', $item->id ) }}"> 
                    <input name="quantity" type="number" value="{{ $item->quantity }}">

                    <input type="submit" value="save">

                </form>

            </td>

            <td>
                <a href="{{ route('cart.destroy', $item->id) }}">{{ __('Delete') }}</a>
            </td>
        </tr>
        
        @endforeach
        <!--<div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="coupon-all">
                    <div class="coupon">
                        <form action="{{route('cart.coupon')}}" method="get">
                            <input id="coupon_code" class="input-text" name="coupon_code" value="V"
                                placeholder="Coupon Code" type="text"> 
                                <input class="btn btn-secondary" name="apply_coupon" value="Apply coupon" type="submit">
                        -->
                         



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </tbody>

 
    <h4> Shipping Fees: £3 </h4>
    <h3>                                                                 
       <div class="float-right"> {{ __('Total Price') }} : {{ __('£') }}{{\Cart::session(session()->getid())->getTotal()}} </div>
    </h3>

   
</table>


 
<br>

                                    </div>
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <h3> Shipping Info <h3> 
                                            <p> <span class="glyphicon glyphicon-road"></span> Estimated Shipping: 1-3 Working Days</p> 
                                            <h4> Shipping is an additional £3 on top of the order placed , Delivery Will Take Up To 1-3 Working Days To Complete <h4>
                                        


                                    </li>
                                    <br>

                                    <div  style="float: right;"> <a class= "btn btn-primary btn-lg" href="{{ route('cart.checkout')}}" role="button">{{ __('Proceed to Checkout') }} </a> </div>
     <br>
     <br>
                                   

@endsection 