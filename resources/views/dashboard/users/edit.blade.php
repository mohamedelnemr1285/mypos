@extends('layouts.master')
@section('title') DashBoard @endsection
@section('contant')

<h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  @extends('layouts.master')
  @section('title')Edit Users @endsection
  @section('contant')
  <section>
  <h1>
     Edit Users
    </h1>

    <ol class="breadcrumb">
    <li><a href="{{route('dashboard.index')}}">Main</a></li>
    <li><a href="{{route('dashboard.users.index')}}">Users</a></li>
    <li class="active">Edit</li>
    </ol>

      @include('layouts.error')

    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit User</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{route('dashboard.users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')
            <div class="box-body">

              <div class="form-group">
              <label for="exampleInputEmail1">{{ trans('site.first_name') }}</label>
                  <input type="text" name="username" value="{{$user->username}}" class="form-control" id="exampleInputEmail1" placeholder="Enter First Name">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Last Name</label>
                  <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Last Name">
                </div>


              <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" value="{{$user->email}}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" value="{{old('image')}}" class="form-control" id="exampleInputEmail1">
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

              <label><input type="checkbox" name="permissions[]" {{$user->hasPermission($map.'_'.$model) ? 'checked' : ''}} value="{{$map}}_{{$model}}">{{$map}}</label>

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
              <button type="submit" class="btn btn-primary">Edit</button>
            </div>
          </form>
        </div>
      </div>

  </div>

        <!-- /.box -->
  </section>


  @endsection


@endsection
