<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\PaypalController;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shipping_fullname' => 'required',
           'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_county'=> 'required',
            'shipping_postcode' => 'required|max:8',
            'shipping_phone' => 'required|max:13',
          //  'shipping_method' => 'method'
        ]);
        
        $order = new Order();

        $order->order_number = uniqid('OrderNumber-');

        $order->email_address = $request->input('email_address');
        $order->shipping_fullname = $request->input('shipping_fullname');
        $order->shipping_county = $request->input('shipping_county');
        $order->shipping_city = $request->input('shipping_city');
        $order->shipping_address = $request->input('shipping_address');
        $order->shipping_phone = $request->input('shipping_phone');
        $order->shipping_postcode = $request->input('shipping_postcode');
      //  $order->shipping_method = $request->input('shipping_method');


        if(!$request->has('billing_fullname')) {
            $order->billing_fullname = $request->input('shipping_fullname');
            $order->billing_county = $request->input('shipping_county');
            $order->billing_city = $request->input('shipping_city');
            $order->billing_address = $request->input('shipping_address');
            $order->billing_phone = $request->input('shipping_phone');
            $order->billing_postcode = $request->input('shipping_postcode');
        }else {
            $order->billing_fullname = $request->input('billing_fullname');
            $order->billing_county = $request->input('billing_county');
            $order->billing_city = $request->input('billing_city');
            $order->billing_address = $request->input('billing_address');
            $order->billing_phone = $request->input('billing_phone');
            $order->billing_postcode = $request->input('billing_postcode');
        }
        
        
        $order->grand_total = \Cart::session(session()->getid())->getTotal();
        $order->item_count = \Cart::session(session()->getid())->getContent()->count();

       
        if (\Auth::check()) {
            // The user is logged in...
        
        $order->user_id = auth()->id();

        } else {

            $order->user_id = "2";
        }



        
     if (request('payment_method') == 'paypal'){
        $order->payment_method = 'paypal';

     }

        
        $order->save();
  


// save order items
        $cartItems =  \Cart::session(session()->getid())->getContent();

        foreach($cartItems as $item) {
            $order->items()->attach($item->pid, [ 'price'=> $item->price, 'quantity'=> $item->quantity, 'attributes' => $item->attributes, 'name' => $item->name ]);

        
        
        }


        //paypal payment gateway redirect
        if(request('payment_method') == 'paypal'){    
        
        return redirect()->route('paypal.checkout', $order->id);

        }


     //empty cart
      \Cart::session(session()->getid())->clear();
      

        
      return redirect()->route('/')->withMessage('Order Has Been Placed');


       


        //checks to see if requests are being receieved 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
