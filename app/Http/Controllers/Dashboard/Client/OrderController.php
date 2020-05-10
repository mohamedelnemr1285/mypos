<?php

namespace App\Http\Controllers\Dashboard\Client;

use App\Category;
use App\Order;
use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        //
    }


    public function create(Client $client)
    {
        $categories = Category::with('products')->get();
       return view('dashboard.clients.orders.create',compact('client','categories'));
    }


    public function store(Request $request, Client $client)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $order = $client->orders()->create([]);

        $order->products()->attach($request->products);

        $total_price = 0;

        foreach($request->products as $id=>$quantity){

            $prodcut = Product::findOrfail($id);

             $total_price += $prodcut->sale_price * $quantity['quantity'];

             $prodcut->update([

                'stock' => $prodcut->stock - $quantity['quantity']

             ]);

        }


        $order->update([

            'total_price' => $total_price

        ]);

        session()->flash('message',trans('site.add_success'));
         return redirect()->route('dashboard.orders.index');


    }



    public function edit(Client $client, Order $order)
    {
        //
    }


    public function update(Request $request, Client $client, Order $order)
    {

    }


    public function destroy(Client $client, Order $order)
    {
        //
    }
}
