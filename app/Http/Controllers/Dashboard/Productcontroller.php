<?php

namespace App\Http\Controllers\Dashboard;

use App\Product;
use App\Category;
use Illuminate\Support\Facades\Storage;
use App\ProductTranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class Productcontroller extends Controller
{

    public function index(Request $request)
    {
        $categories = Category::all();
        $products = Product::when($request->search , function($q) use ($request){
            return $q->whereTranslationLike('name','%'. $request->search .'%');
        })->when($request->category_id ,function($q) use ($request){
            return $q->whereTranslationLike('name','%'. $request->search .'%');

        })->latest()->paginate(2);

        return view('dashboard.products.index',compact('categories','products'));

    }


    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create',compact('categories'));

    }


    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',

        ];

        foreach(config('translatable.locales') as $local){
            $rules += [
                 $local . '.name' => 'required|unique:product_translations,name',
                 $local . '.description' => 'required|unique:product_translations,description',
            ];

        }

        $rules +=[
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required',

        ];

        $request->validate($rules);

        $request_data = $request->all();

        $product = Product::create($request_data);
        if($request->image){

         $img_name = time(). '.' .$request->image->getClientOriginalExtension();


        $product->image=$img_name;

        $request->image->move(public_path('uploads/products/'),$img_name);
        $request_data['image'] = RAND() . $request->image;
    }
        $product->save();

        session()->flash('message',trans('site.add_success'));
       return redirect()->route('dashboard.products.index');

    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit',compact('categories','product'));
    }




    public function update(Request $request, Product $product)
    {
        $rules = [
            'category_id' => 'required',

        ];

        foreach(config('translatable.locales') as $local){
            $rules += [
                 $local . '.name' => 'required',Rule::unique('product_translations,name')->ignore($product->id),
                 $local . '.description' => 'required',Rule::unique('product_translations,description')->ignore($product->id),
            ];

        }

        $rules +=[
            'purchase_price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'stock' => 'required',

        ];

        $request->validate($rules);

        $request_data = $request->all();

        $product->update($request_data);

        if($request->image){

            if($product->image != 'default.jpg') {
                Storage::disk('public_uploads')->delete('/products/' . $product->image);
            }

         $img_name = time(). '.' .$request->image->getClientOriginalExtension();

         $product->image=$img_name;

        $request->image->move(public_path('uploads/products/'),$img_name);
        $request_data['image'] = RAND() . $request->image;
         }

        $product->save();

        session()->flash('message','Edit Success');
       return redirect()->route('dashboard.products.index');
    }


    public function destroy(Product $product)
    {
        if($product->image != 'default.jpg') {
            Storage::disk('public_uploads')->delete('/products/' . $product->image);
        }

        $product->delete();

        session()->flash('message','Delete Success');
       return redirect()->route('dashboard.products.index');
    }
}
