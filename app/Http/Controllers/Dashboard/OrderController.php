<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;

class OrderController extends Controller
{
    public function index(Request $request)
   {
       //  $products = Product::all();
         $order = Order::all();
        // $products = $order->products;
       $orders = Order::WhereHas('client', function($q) use ($request) {

        return $q->where('name', 'like','%'.$request->search.'%');

       })->paginate(5);

       return view('dashboard.orders.index',compact('orders','order'));
   }

   public function products(Order $order)
   {

    $products = $order->products;
    return view('dashboard.orders._products',compact('products'));
   }

   public function destroy(Order $order)
   {

        foreach($order->products as $product)
        {
            $product->update([
                'stock' => $product->stock + $product->pivot->quantity
            ]);
        }

    $order->delete();
    session()->flash('message','Delete Success');
    return redirect()->route('dashboard.orders.index');
   }
}
