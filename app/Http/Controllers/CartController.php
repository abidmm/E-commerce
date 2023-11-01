<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //view 
    public function viewcart()
    {
        $items = Cart::get();

        //adding values in column
        $final_amount = $items->sum('sub_total');

        //order is grouped using order_no column and saved to $orders as key value pair
        //key is order_no and values is the whole row corresponding to order_no
        //if there are rows with same order no , the key will be order_no and value will be array of the rows 
        $taxpercentagegroup = $items->groupBy('product.tax_percentage');
        $final_taxPercentage = [];

        foreach ($taxpercentagegroup as $taxpercentage => $values) {
            $taxAmount = $values->sum('tax_amount');
            $final_taxPercentage[$taxpercentage] = $taxAmount;
        }

        return view('cart', ['items' => $items, 'final_amount' => $final_amount, 'final_taxpercentage' => $final_taxPercentage]);
    }


    //add edit product to cart
    public function addcart(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $count = $request->count;
            $totalAmount = $request->count * $product->price;
            $taxAmount = ($totalAmount * $product->tax_percentage) / 100;
            $subTotal = $totalAmount + $taxAmount;


            $cartitem = $product->cart()->where('product_id', $id)->first();

            if ($cartitem) {
                $temp = [
                    'quantity' => $cartitem->quantity + $count,
                    'total_amount' => $cartitem->total_amount + $totalAmount,
                    'tax_amount' => $cartitem->tax_amount + $taxAmount,
                    'sub_total' => $cartitem->sub_total + $subTotal
                ];

                if ($request->count > $product->quantity) {
                    return response()->json([
                        'status' => false,
                        'message' => 'product limit exceeded'
                    ]);
                }
                $cartitem->update($temp);
                $product->quantity = $product->quantity - $request->count;
                $product->save();

                return response()->json([
                    'status' => true,
                    'message' => 'product updated to cart'
                ]);
            }
            // $data = new Cart();
            // $data->quantity = $count;
            // $data->total_amount = $totalAmount;
            // $data->tax_amount = $taxAmount;
            // $data->sub_total = $subTotal;
            // $product->cart()->save($data);

            // $data->save();

            $data = [
                'quantity' => $count,
                'total_amount' => $totalAmount,
                'tax_amount' => $taxAmount,
                'sub_total' => $subTotal
            ];

            if ($data['quantity'] > $product->quantity || $data['quantity'] <= 0) {
                return response()->json([
                    'status' => false,
                    'message' => 'limit exceeded'
                ]);
            }

            $product->cart()->create($data);
            $product->quantity = $product->quantity - $data['quantity'];
            $product->save();
            // Cart::create($data);

            return response()->json([
                'status' => true,
                'message' => 'product added to cart'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => true,
                'message' => 'product not found',
                'error' => $e->getMessage()
            ]);
        }
    }

    //delete
    public function removeall($id)
    {
        try{
            $product = Product::findOrFail($id);
            //using $product we find it in cart by checking whether the product_id is the id of $product
            //first() returns the first element found
            $cartproduct = $product->cart()->where('product_id', $product->id)->first();
            $product->quantity = $cartproduct->quantity + $product->quantity;
            $product->save();
            $cartproduct->delete();
            return response()->json([
                'status' => true,
                'message' => 'cart deleted successfully',
            ]);
        }
         catch(ModelNotFoundException $e){
            return response()->json([
                'status'=>false,
                'message'=>'product not found',
                'error'=>$e->getMessage()
            ]);
         }
      
    }


    //reduce quantity from cart
    public function reduce(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $count = $request->count;
        $totalAmount = $request->count * $product->price;
        $taxAmount = ($totalAmount * $product->tax_percentage) / 100;
        $subTotal = $totalAmount + $taxAmount;

        $cartitem = $product->cart()->where('product_id', $id)->first();

        $temp = [
            'quantity' => $count,
            'total_amount' => $cartitem->total_amount + $totalAmount,
            'tax_amount' => $cartitem->tax_amount + $taxAmount,
            'sub_total' => $cartitem->sub_total + $subTotal
        ];


       
        //if reducing from cart,adding to product
        if ($temp['quantity'] < $cartitem->quantity) {
            $diff = $cartitem->quantity - $request->count;
            $product->quantity = $product->quantity + $diff;
            $product->save();
        }

        //if cart item more than product or less
        if (($request->count - $cartitem->quantity) > $product->quantity) {
            return response()->json([
                'status' => false,
                'message' => 'product limit exceeded'
            ]);
        }
         //if adding more to cart ,reducing from product
         if ($temp['quantity'] > $cartitem->quantity) {
            $add = $request->count - $cartitem->quantity;
            $product->quantity = $product->quantity - $add;
            $product->save();
        }

        //cart save
        $cartitem->update($temp);

        return response()->json([
            'status' => true,
            'message' => 'quantity edited'
        ]);
    }
}
