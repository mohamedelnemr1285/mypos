<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Categorytranslation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;


class Categorycontroller extends Controller
{

    public function index(Request $request)
    {
        $translations = Categorytranslation::all();

        $categories = Category::when($request->search, function($q) use ($request){
          return  $q->whereTranslationLike('name','%' .$request->search . '%');
        })->latest()->paginate(5);
       // return view('dashboard.categories.index',compact('categories'));

        return View::make('dashboard.categories.index')->with('categories', $categories)->with('translations', $translations);


    }


    public function create()
    {
        return view('dashboard.categories.create');
    }


    public function store(Request $request)
    {

        $rule = [];
        foreach(config('translatable.locales') as $local){
            $rule = [$local.'.name' => ['required','unique:categorytranslations,name']];
        }

        $request->validate($rule);

         Category::create($request->all());

         session()->flash('message',trans('site.add_success'));
         return redirect()->route('dashboard.categories.index');
    }


    public function edit(Category $category)
    {

        return view('dashboard.categories.edit',compact('category'));
    }

    public function update(Request $request, Category $category)
    {

        $rule = [];
        foreach(config('translatable.locales') as $local){
            $rule = [$local.'.name' => ['required',Rule::unique('categorytranslations','name')->ignore($category->id,'category_id')]];
        }

        $request->validate($rule);

        $category->update($request->all());

        session()->flash('message' ,'Edit Success');
       return redirect()->route('dashboard.categories.index');
    }


    public function destroy(Category $category)
    {
        $category->delete();


        session()->flash('message' ,'Delete Success');
       return redirect()->route('dashboard.categories.index');
    }
}
