@extends('layouts.master')
@section('title') DashBoard @endsection
@section('contant')

<h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  @extends('layouts.master')
  @section('title')Edit categories @endsection
  @section('contant')
  <section>
  <h1>
     Edit categories
    </h1>

    <ol class="breadcrumb">
    <li><a href="{{route('dashboard.index')}}">Main</a></li>
    <li><a href="{{route('dashboard.categories.index')}}">categories</a></li>
    <li class="active">Edit</li>
    </ol>

      @include('layouts.error')

    <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Edit categories</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{route('dashboard.categories.update',$category->id)}}" method="POST" >
          @csrf
          @method('put')
            <div class="box-body">

                @foreach (config('translatable.locales') as $local)

                <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('site.'.$local.'.name') }}</label>
                        <input type="text" name="{{$local}}[name]" value="{{$category->translate($local)->name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" required>
                      </div>

                @endforeach

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
