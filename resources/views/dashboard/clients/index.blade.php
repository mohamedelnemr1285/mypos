@extends('layouts.master')
@section('title') Clients @endsection
@section('contant')
<section class="content-header">
    <h1>
        Clients
      <small>{{$clients->total()}}</small>
    </h1>
</section>
<form>
<div class="row">
<div class="col-md-6">

    <form action="{{route('dashboard.clients.index')}}" method="get" class="sidebar-form">
    <input type="text" name="search" value="{{request()->search}}" placeholder="search" class="form-control" >
    </form>
</div>

<div class="col-md-4">
    <button  type="submit" class="btn btn-primary"><i class="fa fa-search" ></i>Search</button>
    @if (auth()->user()->hasPermission('create_clients'))
        <a href="{{route('dashboard.clients.create')}}" class="btn btn-primary"><i class="fa fa-plus" ></i>Add</a>
    @else
    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus" ></i>Add</a>

    @endif
</div>

</div>
</form>
<hr  style="border-top: 3px solid #e7e0e0;">
<div class="box-body">
@if($clients->count() > 0)
<table class="table table-hover">
    <thead>

        <tr>
            <th>#</th>
            <th>الاسم</th>
            <th>التليفون</th>
            <th>العنوان</th>
            <th>Orders</th>
            <th>Action</th>
        </tr>
    </thead>

     <tbody>
        @foreach ($clients as $index=>$client )

        <tr >
            <td>{{$index + 1}}</td>
                 <td>{{$client->name}}</td>
                 <td>{{ is_array($client->phone) ? implode(array_filter($client->phone),'-') : $client->phone }}</td>
                 <td>{{$client->address}}</td>
                @if (auth()->user()->hasPermission('create_orders'))
                <td><a href="{{route('dashboard.clients.orders.create',$client->id)}}" class="btn btn-primary btn-sm">Add Orders</a></td>
                @else
                <td><a href="#" class="btn btn-primary btn-sm disabled">Add Orders</a></td>
                @endif

            <td>
                @if (auth()->user()->hasPermission('update_clients'))
                    <a class="btn btn-info" href="{{route('dashboard.clients.edit',$client->id)}}">Edit</a>
                @else
                <a class="btn btn-info disabled" href="#">Edit</a>
               @endif


               @if (auth()->user()->hasPermission('delete_clients'))
                 <form onclick="return myFunction();" action="{{ route('dashboard.clients.destroy',$client->id) }}" method="post" style="display:inline-block">
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

{{$clients->appends(request()->query())->links()}}

@else
<h1>No Recordis </h1>
@endif

@endsection
</div>

