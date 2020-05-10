@extends('layouts.master')
@section('title') products @endsection
@section('contant')
<section class="content-header">
    <h1>
        products
      <small>{{$products->total()}}</small>
    </h1>
</section>
<form>
<div class="row">
<div class="col-md-6">

    <form action="{{route('dashboard.products.index')}}" method="get" class="sidebar-form">
    <input type="text" name="search" value="{{request()->search}}" placeholder="search" class="form-control" >
</div>

<div class="col-md-6">

    <select  name="category_id" value="{{request()->category_id}}" class="form-control" >
        <option value="">-- All Categories -- </option>
        @foreach ($categories as $category )
        @foreach (config('translatable.locales') as $local )
          <option value="{{$category->id}}" {{request()->category_id == $category->id ? 'selected' : ''}}>{{$category->translate($local)->name}}</option>
        @endforeach
        @endforeach

    </select>
    </form>
</div>

<div class="col-md-4">
    <button  type="submit" class="btn btn-primary"><i class="fa fa-search" ></i>Search</button>
    @if (auth()->user()->hasPermission('create_products'))
        <a href="{{route('dashboard.products.create')}}" class="btn btn-primary"><i class="fa fa-plus" ></i>Add</a>
    @else
    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus" ></i>Add</a>

    @endif
</div>

</div>
</form>
<hr  style="border-top: 3px solid #e7e0e0;">
<div class="box-body">
@if($products->count() > 0)
<table class="table table-hover">
    <thead>

        <tr>
            <th>#</th>
            <th>القسم</th>
            <th>الاسم</th>
            <th>الوصف</th>
            <th>Name</th>
            <th>Descrabtion</th>
            <th>Image</th>
            <th>Purchase Price</th>
            <th>Sale Price</th>
            <th>المكسب</th>
            <th>Action</th>
        </tr>
    </thead>

     <tbody>
        @foreach ($products as $index=>$product )

        <tr >
            <td>{{$index + 1}}</td>
            <td>{{$product->category->name}}</td>
            @foreach (config('translatable.locales') as $local )
                 <td>{{$product->translate($local)->name}}</td>
                 <td>{!!$product->translate($local)->description!!}</td>
            @endforeach
            <td><img src="{{$product->image_path}}" height="60" width="60" alt=""></td>
            <td>{{$product['purchase_price']}}</td>
            <td>{{$product['sale_price']}}</td>
            <td>{{$product->Profit_Precent}}%</td>
            <td>
                @if (auth()->user()->hasPermission('update_products'))
                    <a class="btn btn-info" href="{{route('dashboard.products.edit',$product->id)}}">Edit</a>
                @else
                <a class="btn btn-info disabled" href="#">Edit</a>
               @endif


               @if (auth()->user()->hasPermission('delete_products'))
                 <form onclick="return myFunction();" action="{{route('dashboard.products.destroy',$product->id)}}" method="post" style="display:inline-block">
                    <input class="btn btn-danger" type="submit" value="Delete" />
                    @method('delete')
                    @csrf
                </form>
                @else
                <button class="btn btn-danger disabled" type="submit">Delete</button>

               @endif


            </td>

         </tr>
         @endforeach

     </tbody>

</table>

{{$products->appends(request()->query())->links()}}

@else
<h1>No Recordis </h1>
@endif

@endsection
</div>

