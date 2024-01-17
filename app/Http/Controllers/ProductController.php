<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Jobs\ProcessPodcast;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
   public function index()
   {
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
           return redirect('/cartlist')->with('success', 'Item added to the cart successfully.');
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
   public function cartlist()
   {
       $user = Auth::user();
   
       if (Auth::check()) {
           $userId = $user->id;
   
           $products = DB::table('carts')
               ->join('products', 'carts.product_id', '=', 'products.id')
               ->where('carts.user_id', $userId)
               ->select('products.*','carts.id as cart_id')
               ->get();
   
           return view('cartlist', ['products' => $products]);
       } else {
           return redirect('/login')->with('error', 'You must be logged in to view your cart.');
       }
   }
 public function removecart($id)
 {
    cart::destroy($id);
    return redirect ('/cartlist');
 }
  
 public function order()
{
    $user = Auth::user();
   
    if (Auth::check()) {
        $userId = $user->id;

        $total = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->where('carts.user_id', $userId)
            ->select('products.*','carts.id as cart_id')
            ->sum('products.price');

        return view('order', ['total' => $total]);
    } else {
        return redirect('/login')->with('error', 'You must be logged in to view your cart.');
    }
}

public function orderPlace(Request $request)
{
    $user = Auth::user();
   
    if (Auth::check()) {
        $userId = $user->id;

        $allCart = Cart::where('user_id', $userId)->get();

        foreach ($allCart as $cart) {
            $order = new Order;
            $order->product_id = $cart->product_id;
            $order->user_id = $cart->user_id;
            $order->status = "pending";
            $order->payment_method = $request->payment_method;
            $order->payment_status = "pending";
            $order->address = $request->address;
            $order->phone = $request->phone;
            $order->save();
        }

        Cart::where('user_id', $userId)->delete();

        return redirect('/home')->with('success', 'Order placed successfully.');
    } else {
        return redirect('/login')->with('error', 'You must be logged in to place an order.');
    }
}
  public function myorders()
  {
    $user = Auth::user();
   
    if (Auth::check()) {
        $userId = $user->id;

     $orders= DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $userId)
            ->get();

         return view('myorders', ['orders' => $orders]);
    } else {
        return redirect('/login')->with('error', 'You must be logged in to view your cart.');
    }
  }
  
  public function dispatchJob()
  {
    ProcessPodcast::dispatch(1)->onQueue('test');
     
  }
   

   }
   
