@extends('layouts.master')
@section('title') Users @endsection
@section('contant')
<section>
<h1>
    Users
  </h1>

  <ol class="breadcrumb">
  <li><a href="{{route('dashboard.index')}}">Main</a></li>
  <li><a href="{{route('dashboard.users.index')}}">Users</a></li>
  <li class="active">Add</li>
  </ol>

    @include('layouts.error')

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add User</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
    <form role="form" action="{{route('dashboard.users.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
          <div class="box-body">

            <div class="form-group">
            <label for="exampleInputEmail1">{{ trans('site.first_name') }}</label>
                <input type="text" name="username" value="{{old('username')}}" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Last Name</label>
                <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name">
              </div>


            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" value="{{old('image')}}" class="form-control image" id="exampleInputEmail1">
              </div>
              <div class="form-group">
              <img src="{{asset('public/uploads/users/default.jpg')}}" height="50" width="50" class="preview">
              </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword2">Password Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password Confirmation">
              </div>

              <!-- START CUSTOM TABS -->
<h2 class="page-header">Permissions</h2>

<div class="row">

  <div class="col-md-8">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
        @php
            $models = ['users','categories','products','clients','orders'];
            $maps = ['create', 'read', 'update', 'delete'];
        @endphp
      <ul class="nav nav-tabs">
          @foreach ($models as $index=>$model )
          <li class="{{$index == 0 ? 'active' : ''}}"><a href="#{{$model}}" data-toggle="tab">{{$model}}</a></li>
          @endforeach
      </ul>

      <div class="tab-content">
        @foreach ($models as $index=>$model )

        <div class="tab-pane {{$index == 0 ? 'active' : ''}}" id="{{$model}}">

            @foreach ($maps as $map )

            <label><input type="checkbox" name="permissions[]" value="{{$map}}_{{$model}}">{{$map}}</label>

            @endforeach

          </div>
          @endforeach

      </div>

    </div>
  </div>
</div>

          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>

</div>

      <!-- /.box -->
</section>


@endsection



