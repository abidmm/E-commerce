<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Notifications\checkoutNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{

    //view myorders
    public function myorders()
    {
        $checkout = Order::get();
        //order is grouped using order_no column and saved to $orders as key value pair
        //key is order_no and values is the whole row corresponding to order_no
        //if there are rows with same order no , the key will be order_no and value will be array of the rows 
        $orders = $checkout->groupBy('order_no');
        $totalAmounts = [];


        foreach($orders as $orderno => $details){
            $sum = $details->sum('total_amount');
            $totalAmounts[$orderno] = $sum;
        }

        return view('check_out', ['orders' => $orders,'totalAmount'=>$totalAmounts]);
    }

    public function randomno()
    {
        $prefix = 'ORD';
        $randomNo = rand(1000, 2000);
        $orderNo = $prefix . $randomNo;

        return $orderNo;
    }


    //checkout
    public function checkout()
    {
        $carts = Cart::get();
        if ($carts->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'no items in cart'
            ]);
        } else {

            $orderNo = $this->randomno();
            foreach ($carts as $cart) {
                $order = new Order();
                $order->order_no = $orderNo;
                $order->title = $cart->product->title;
                $order->image = $cart->product->image;
                $order->quantity = $cart->quantity;
                $order->total_amount = $cart->total_amount;
                $order->save();
                $cart->delete();
            }

           
            $checkout = Order::where('order_no',$orderNo)->get();

            $temp = '';
            foreach($checkout as $check){
               $temp .= $check->title . ' ';
            }
            
            //mailing with orderno after checkout
            $to = 'abidmeethal@gmail.com';           
            Notification::route('mail', $to)->notify(new checkoutNotification($orderNo,$temp));

            return response()->json([
                'status' => true,
                'message' => 'ordered successfully'
            ]);
        }
    }
}
