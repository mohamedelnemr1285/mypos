@extends('layouts.master')
@section('title') categories @endsection
@section('contant')
<section>
<h1>
    categories
  </h1>

  <ol class="breadcrumb">
  <li><a href="{{route('dashboard.index')}}">Main</a></li>
  <li><a href="{{route('dashboard.categories.index')}}">categories</a></li>
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
    <form role="form" action="{{route('dashboard.categories.store')}}" method="POST">
        @csrf
        @method('POST')
          <div class="box-body">

            @foreach (config('translatable.locales') as $local)

            <div class="form-group">
                <label for="exampleInputEmail1">{{ trans('site.'.$local.'.name') }}</label>
                    <input type="text" name="{{$local}}[name]" value="{{old($local.'.name')}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" required>
                  </div>

            @endforeach



                  <!-- START CUSTOM TABS -->
<h2 class="page-header">Permissions</h2>

<div class="row">

  <div class="col-md-6">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
        @php
            $models = ['categories','users','products'];
            $maps = ['create', 'read', 'update', 'delete'];
        @endphp
    <!--  <ul class="nav nav-tabs">
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

      </div> -->

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



