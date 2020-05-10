@extends('layouts.master')
@section('title') Users @endsection
@section('contant')
<section class="content-header">
    <h1>
        Users
      <small>{{$users->total()}}</small>
    </h1>
</section>
<form>
<div class="row">
<div class="col-md-6">

    <form action="{{route('dashboard.users.index')}}" method="get" class="sidebar-form">
    <input type="text" name="search" value="{{request()->search}}" placeholder="search" class="form-control" >
    </form>
</div>

<div class="col-md-4">
    <button  type="submit" class="btn btn-primary"><i class="fa fa-search" ></i>Search</button>
    @if (auth()->user()->hasPermission('create_users'))
        <a href="{{route('dashboard.users.create')}}" class="btn btn-primary"><i class="fa fa-plus" ></i>Add</a>
    @else
    <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus" ></i>Add</a>

    @endif
</div>

</div>
</form>
<hr  style="border-top: 3px solid #e7e0e0;">
<div class="box-body">
@if($users->count() > 0)
<table class="table table-hover">
    <thead>

        <tr>
            <th>#</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>

     <tbody>
        @foreach ($users as $index=>$user )

        <tr >
            <td>{{$index + 1}}</td>
            <td>{{$user['username']}}</td>
            <td>{{$user['last_name']}}</td>
            <td>{{$user['email']}}</td>
        <td><img src="{{$user->image_path}}" height="60" width="60" alt=""></td>

            <td>
                @if (auth()->user()->hasPermission('update_users'))
                    <a class="btn btn-info" href="{{route('dashboard.users.edit',$user->id)}}">Edit</a>
                @else
                <a class="btn btn-info disabled" href="#">Edit</a>
               @endif


               @if (auth()->user()->hasPermission('delete_users'))
                 <a class="btn btn-danger" onclick="return myFunction();" href ="{{route('dashboard.delete',$user->id)}}" >Delete</a>
                @else
                <button class="btn btn-danger disabled" type="submit">Delete</button>

               @endif


            </td>

         </tr>
         @endforeach

     </tbody>

</table>

{{$users->appends(request()->query())->links()}}

@else
<h1>No Recordis </h1>
@endif

@endsection
</div>

