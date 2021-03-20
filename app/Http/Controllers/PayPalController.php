<?php

namespace App\Http\Controllers;

use App\Order;
use App\Mail\OrderPaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Srmklive\PayPal\Services\ExpressCheckout;


class PayPalController extends Controller
{
    //
    public function getExpressCheckout($orderId){

       $checkoutData = $this->checkoutData($orderId);

        $provider = new ExpressCheckout();
        
        
        $response = $provider->setExpressCheckout($checkoutData);


        return redirect($response['paypal_link']);




      // dd($response);

    }




    private function checkoutData($orderId){
        $cart = \Cart::session(session()->getid());
        
        
        $cartItems = array_map(function($items){

            return [
                'name'=> $items['name'],
                'price'=> $items['price'],
                'qty' => $items['quantity'],
            ];

        } , $cart->getContent()->toarray(), );

     //   dd($cartItems);


$checkoutData = [
    'items'=> $cartItems,

    'return_url' => route('paypal.success', $orderId),
    'cancel_url' => route('paypal.cancel'),
    'invoice_id' => uniqid(),
    'invoice_description'=> "Order Description",
    'total'=> $cart->getTotal()


];
        return $checkoutData;
    }

        public function cancelPage(){

            dd('payment failed');

        }



        public function getExpressCheckoutSuccess(Request $request, $orderId){

            $token = $request->get('token');
            $payerId = $request->get('PayerID');            
            $provider = new ExpressCheckout();
            $checkoutData = $this->checkoutData($orderId);

            $response = $provider->getExpressCheckoutDetails($token);


            if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

                // Perform Payment On Paypal . 

                $payment_status = $provider->doExpressCheckoutPayment($checkoutData, $token, $payerId);
                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];

                if(in_array($status ,['Completed', 'Processed'])){
                $order = Order::find($orderId);
                $order->is_paid = 1;
                $order->save();
               // $stock =AttributeValue::find($stock);
             
                //Send Mail to The User Letting Them Know Their Order Details . 
         

                    Mail::to($order->email_address)->send(new OrderPaid($order));

                }

                \Cart::session(session()->getid())->clear();
      

                return redirect('/')->withMessage('Payment Successful');

                }


                

            


            return redirect('home')->withError('Payment unsuccessful Something Went Wrong !');

         
        }



}


