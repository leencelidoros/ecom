<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
class ProductController extends Controller
{
   public function index()
   {

      // return Product::all();
      $data=Product::all();
       return view('product' ,['products'=>$data]);
   }
    public function detail($id)
   {
      $data= Product::find($id);
      return view('detail',['product'=>$data ]);
   }
   public function addToCart(Request $request)
   {
      return "helo";
   }
   public function search(Request $request)
   {
       $data = Product::
       where('name', 'like', '%' . $request->input('query') . '%')
       ->get();
       return view('search', ['products' => $data]);
   }
   
}
