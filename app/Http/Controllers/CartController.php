<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Coupon;
use Cart;
use App\CurrencyRate;
use App\AttributeValue;
use DB;
use Validator;
use Session;


class CartController extends Controller
{

    public function add(Request $request, Product $product){
 

    // $options = $request->except('_token', 'colour', 'size', 'qty');4
    
 /// $size = DB::table('attribute_values')->get();
        $productSize = $request->input('size');
        $pqty= $request->input('qty');
        $image = $product->cover_img;
        $uniqueId = rand( $min=1 , $max=10);
        $sessionKey = session()->getid();
        $uniqueI = uniqid();

        

       \Cart::session($sessionKey)->add(array(
         'id' => $uniqueId,
         'name' => $product->name,
         'price' => $product->price,
         'quantity' => $pqty,
         'image' => $product->cover_img,
         'pid'=> $product->id,
          'attributes' => array(
            $productSize,
            ),
         'associatedModel' => $product 
        ));


      //  dd($uniqueI);
     //dd($product->id);
     //dd($sessionKey);
         
        return redirect()->route('cart.index');
        
    }


    public function index(){


        $sessionKey = session()->getid();

//dd($cartItems);

     $cartItems =\Cart::session($sessionKey)->getContent();





   //  $condition = new \Darryldecode\Cart\CartCondition(array(
     //   'name' => 'Shipping Fees',
    //    'type' => 'shipping',
//        'target' =>'subtotal', // this condition will be applied to cart's total when getTotal() is called.
  //     'value' => '+3',
    //    'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
//    ));

  
    //    \Cart::session(session()->getid())->condition($condition);
        
    





   
        return view('cart.index',['cartItems' => $cartItems]);
    }


    public function destroy($itemId){
        //remove item from card 
                
        
             $cartItems =\Cart::session(session()->getid())->remove($itemId);
                return back();
            }

    public function update($rowId){
        \Cart::session(session()->getid())->update($rowId ,[
            'quantity' => [
                'relative' => false,
                'value' => request('quantity')
            ]
        ]);

        return back();
    }



    public function checkout(){
        
        $products = Product::orderBy('created_at','desc')->paginate(0);

        if(\Cart::session(session()->getid())->isEmpty()) { 

            return redirect('cart')->withMessage('Please Add Products To Cart');

        }

        

        return view('cart.checkout',['Products'=>$products]);
    }
    


    public function applyCoupon() {



        $couponCode = request('coupon_code');


        $couponData = Coupon::where('code', $couponCode)->first();
        
        // couponCode logic
        $condition = new \Darryldecode\Cart\CartCondition(array(

            'name' => 'VAT',
            'type' => 'tax',
            'target' => 'subtotal',
            'value' => '12.5%',


        ));

        \Cart::session(session()->getid())->condition($condition);

        return back()->withMessage('Coupon Applied');

    }


}


    



   

