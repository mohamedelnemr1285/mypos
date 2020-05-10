@extends('layouts.master')
@section('title') products @endsection
@section('contant')
<section>
<h1>
    products
  </h1>

  <ol class="breadcrumb">
  <li><a href="{{route('dashboard.index')}}">Main</a></li>
  <li><a href="{{route('dashboard.products.index')}}">products</a></li>
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
    <form role="form" action="{{route('dashboard.products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
          <div class="box-body">

            <div class="form-group">
                <label for="exampleInputEmail1">Categories</label>
                    <select  name="category_id" class="form-control">
                        <option value="">--- All categories ---</option>
                    @foreach ($categories as $category)
                     @foreach (config('translatable.locales') as $local )
                    <option value="{{$category->id}}" {{old('category_id' == $category->id ? 'selected' : '' )}}>{{$category->translate($local)->name}}</option>
                     @endforeach
                    @endforeach
                    </select>
                  </div>

            @foreach (config('translatable.locales') as $local)

            <div class="form-group">
                <label for="exampleInputEmail1">{{ trans('site.'.$local.'.name') }}</label>
                    <input type="text" name="{{$local}}[name]" value="{{old($local.'.name')}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">{{ trans('site.'.$local.'.description') }}</label>
                        <textarea  name="{{$local}}[description]" class="form-control ckeditor">{{old($local.'.description')}}</textarea>
                      </div>

            @endforeach

            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" name="image" value="{{old('image')}}" class="form-control image" id="exampleInputEmail1">
              </div>
              <div class="form-group">
                <img src="{{asset('public/uploads/users/default.jpg')}}" height="50" width="50" class="preview">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Purchase Price</label>
                    <input type="number" step="0.01" name="purchase_price" value="{{old('purchase_price')}}" class="form-control" id="exampleInputEmail1" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Sale Price</label>
                    <input type="number" step="0.01" name="sale_price" value="{{old('sale_price')}}" class="form-control" id="exampleInputEmail1" >
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Stock</label>
                    <input type="number" name="stock" value="{{old('stock')}}" class="form-control" id="exampleInputEmail1" >
                  </div>




                  <!-- START CUSTOM TABS -->
<h2 class="page-header">Permissions</h2>

<div class="row">

  <div class="col-md-6">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
        @php
            $models = ['products','users','products'];
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



