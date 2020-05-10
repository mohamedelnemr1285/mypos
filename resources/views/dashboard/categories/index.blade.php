@extends('layouts.master')
@section('title') Categories @endsection
@section('contant')
<section class="content-header">
    <h1>
        categories
      <small>{{$categories->total()}}</small>
    </h1>
</section>
<form>
<div class="row">
<div class="col-md-6">

    <form action="{{route('dashboard.categories.index')}}" method="get" class="sidebar-form">
    <input type="text" name="search" value="{{request()->search}}" placeholder="search" class="form-control" >
    </form>
</div>

<div class="col-md-4">
    <button  type="submit" class="btn btn-primary"><i class="fa fa-search" ></i>Search</button>
    @if (auth()->user()->hasPermission('create_categories'))
        <a href="{{route('dashboard.categories.create')}}" class="btn btn-primary"><i class="fa fa-plus" ></i>Add</a>
    @else
    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus" ></i>Add</a>

    @endif
</div>

</div>
</form>
<hr  style="border-top: 3px solid #e7e0e0;">
<div class="box-body">
@if($categories->count() > 0)
<table class="table table-hover">
    <thead>

        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>Name</th>
            <th>عدد المنتجات</th>
            <th>المنتجات المرتبطة</th>
            <th>Action</th>
        </tr>
    </thead>

     <tbody>
        @foreach ($categories as $index=>$category )

        <tr >
            <td>{{$index + 1}}</td>
            @foreach (config('translatable.locales') as $local )
                 <td>{{$category->translate($local)->name}}</td>
            @endforeach
            <td>{{$category->products->count()}}</td>
          <td><a href="{{route('dashboard.products.index'),$category->id}}" class="btn btn-primary btn-sm">المنتجات المرتبطة</a></td>
            <td>
                @if (auth()->user()->hasPermission('update_categories'))
                    <a class="btn btn-info" href="{{route('dashboard.categories.edit',$category->id)}}">Edit</a>
                @else
                <a class="btn btn-info disabled" href="#">Edit</a>
               @endif


               @if (auth()->user()->hasPermission('delete_categories'))
                 <form onclick="return myFunction();" action="{{ route('dashboard.categories.destroy',$category->id) }}" method="post" style="display:inline-block">
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

{{$categories->appends(request()->query())->links()}}

@else
<h1>No Recordis </h1>
@endif

@endsection
</div>

