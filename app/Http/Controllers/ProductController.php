<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
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
       $productId = $request->input('product_id');
   
       $user = $request->user();
       if ($user) {
           $cart = new Cart;
           $cart->user_id = $user->id;
           $cart->product_id = $productId;
           $cart->save();
           return redirect('/home')->with('success', 'Item added to the cart successfully.');
       }
       return redirect('/login')->with('error', 'You must be logged in to add items to the cart.');
   }
   public function search(Request $request)
   {
       $data = Product::
       where('name', 'like', '%' . $request->input('query') . '%')
       ->get();
       return view('search', ['products' => $data]);
   }
   public static function cartItem()
   {
       if (auth()->check()) {
           $userId = auth()->id();
           $cartCount = Cart::where('user_id', $userId)->count();
   
           return $cartCount;
       } else {
           return 0; 
       }
   }
   

   }
   
