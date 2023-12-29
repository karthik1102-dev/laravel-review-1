<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){

        $products = Product::all();
        return view('products.index',compact('products'));
        
        // return response()->json(['success'=>$products]);


    }


    public function createProduct(){

        return view('products.create');
  
    }

    public function storeProduct(Request $request){

        $request['user_id']=auth()->id();
        $request['date']=  Carbon::parse($request->date);
        // dd($request->except('_token','id'));
        Product::create($request->except('_token'));
        if($request->ajax()){

            return response(['success' => 'Employee created successfully.']);
        }
         return redirect('/product');
    }

    public function editProduct($id){
        $product = Product::find($id);
        return view('products.edit',compact('product'));

    }

    public function editProductajax($id){
        $product = Product::find($id);
        return response()->json(['success'=>$product]);

    }

    public function updateProduct(ProductRequest $request){
        $request['date']=  Carbon::parse($request->date);
        Product::where('id',$request->id)->update($request->except('_token'));
        return redirect('/product');
    }

    public function deleteProduct($id){
        Product::where('id',$id)->delete();
        return redirect('/product');
    }
}
