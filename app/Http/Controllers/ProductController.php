<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //


   //view product
   public function viewproduct(){
    $products = Product::orderBy('id','desc')->get();

    return view('ProductList',['products'=>$products]);
}

    //create product
    public function addproduct(Request $request){
        $validator = Validator::make($request->all(),[
            'title'=>'required|string',
            'description'=>'required|string',
            'price'=>'required|numeric',
            'quantity'=>'required|integer',
            'tax_percentage'=>'required|integer',
            'image'=>'required|image|mimes:png,jpg,gif'
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'validation failed',
                'error'=>$validator->errors()
            ]);
        }

        //getting image name from request
        $image = $request->file('image')->hashName();
        //setting the image path to be stored in the database('image/' is the folder in which the image is saved)
        $imagepath = 'image/'.$image;
        //the request img is stored to public/image 
        //php artisan storage:link (creating link)
        $request->file('image')->storeAs('public/'.$imagepath);

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->tax_percentage = $request->tax_percentage;
        $product->image = $imagepath;

        $product->save();
        
        // $data = [
        //     'title'=>$request->title,
        //     'description'=>$request->description,
        //     'price'=>$request->price,
        //     'quantity'=>$request->quantity,
        //     'tax_percentage'=>$request->input('tax_percentage'),
        //     'image' => $imagepath
        // ];

        // Product::create($data);

        return response()->json([
            'status'=>true,
            'message'=>'product added',
        ]);
    }

    //update product 

    public function updateproduct(Request $request,$id){
        try{
            $product = Product::findOrFail($id);

            $validator = Validator::make($request->all(),[
                'title'=>'nullable|string',
            'description'=>'nullable|string',
            'price'=>'nullable|numeric',
            'quantity'=>'nullable|integer',
            'tax_percentage'=>'nullable|integer',
            'image'=>'nullable|image|mimes:png,jpg,gif'
            ]);

            if($validator->fails()){
                return response()->json([
                    'status'=>true,
                    'message'=>'validation failed',
                    'error'=>$validator->errors()
                ]);
            }
            $final = [];
            $datas = [
                'title',
            'description',
            'price',
            'quantity',
            'tax_percentage',
            ];
            
            foreach($datas as $data){
                if($request->filled($data)){
                   $final[$data] = $request->input($data);
                }
            }

            if($request->hasFile('image')){
                $image = $request->file('image')->hashName();
                 $imagepath = 'image/'.$image;
                 $request->file('image')->storeAs('public/'.$imagepath);
                 $final['image'] = $imagepath;
            }

            $product->update($final);

            

            return response()->json([
                'status'=>true,
                'message'=>'product update successffully'
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

    //delete product
    public function delete($id){
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status'=>true,
            'message'=>'product deleted successfully',
        ]);
    }
}
