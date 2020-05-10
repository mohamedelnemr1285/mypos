@extends('layouts.master')
@section('title') orders @endsection
@section('contant')
<section class="content-header">
    <h1>
        orders
      <small>{{$orders->total()}}</small>
    </h1>

    <ol class="breadcrumb">
        <li><a href="{{route('dashboard.index')}}">Main</a></li>
        <li><a href="{{route('dashboard.orders.index')}}">Orders</a></li>
     </ol>
    </section>

<form>
<div class="row">
<div class="col-md-6">
    <form action="{{route('dashboard.orders.index')}}" method="get" class="sidebar-form">
    <input type="text" name="search" value="{{request()->search}}" placeholder="search" class="form-control" >
    <button  type="submit" class="btn btn-primary"><i class="fa fa-search" ></i>Search</button>

    @if (auth()->user()->hasPermission('create_orders'))
    <a href="{{route('dashboard.orders.create')}}" class="btn btn-primary"><i class="fa fa-plus" ></i>Add</a>
    @else
    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus" ></i>Add</a>
    @endif

</form>
</div>
</form>
</div>

<div class="row">
<div class="col-md-8">


<hr  style="border-top: 3px solid #e7e0e0;">
<div class="box-body">
@if($orders->count() > 0)
<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>اسم العميل</th>
            <th>السعر</th>
          <!--  <th>الحالة</th> -->
            <th>تاريخ الاضافة</th>
            <th>Action</th>
        </tr>
    </thead>

     <tbody>
        @foreach ($orders as $index=>$order )
        <tr >
            <td>{{$index + 1}}</td>
            <td>{{$order->client->name}}</td>
            <td>{{number_format($order->total_price, 2)}}</td>
          <!--  <td><button
                data-status="$order->status"
                data-url="{{route('dashboard.orders.update',$order->id)}}"
                data-method="put"
                data-avaolable-status=""
                class="order-status-btn btn"
                > {{$order->status}}

                </button>
            </td> -->
            <td>{{$order->created_at->format('Y-m-d')}}</td>
            <td>
                <button class="btn btn-primary order-prodcut"
                 data-url="{{route('dashboard.orders.products',$order->id)}}"
                 data-method="get"
                 >

                Show <i class="fa fa-list"></i></button>

                @if (auth()->user()->hasPermission('update_orders'))
                    <a class="btn btn-info" href="{{route('dashboard.orders.edit',$order->id)}}">Edit</a>
                @else
                <a class="btn btn-info disabled" href="#">Edit</a>
               @endif


               @if (auth()->user()->hasPermission('delete_orders'))
                 <form onclick="return myFunction();" action="{{route('dashboard.orders.destroy',$order->id)}}" method="post" style="display:inline-block">
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

{{$orders->appends(request()->query())->links()}}

@else
<h1>No Recordis </h1>
@endif


</div>

</div>
@include('dashboard/orders/_products')
<div class="product-list" >

</div>

</div>
@endsection

</div>

