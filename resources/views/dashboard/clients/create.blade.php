@extends('layouts.master')
@section('title') Clients @endsection
@section('contant')
<section>
<h1>
    clients
  </h1>

  <ol class="breadcrumb">
  <li><a href="{{route('dashboard.index')}}">Main</a></li>
  <li><a href="{{route('dashboard.clients.index')}}">clients</a></li>
  <li class="active">Add</li>
  </ol>

    @include('layouts.error')

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Add Client</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
    <form role="form" action="{{route('dashboard.clients.store')}}" method="POST">
        @csrf
        @method('POST')
          <div class="box-body">


            <div class="form-group">
                <label for="exampleInputEmail1">الاسم</label>
                    <input type="text" name="name" value="{{old('name')}}" class="form-control" id="exampleInputEmail1" placeholder="ادخل الاسم" required>
                  </div>

                  @for ($i =0 ; $i <2 ; $i++)

                  <div class="form-group">
                    <label for="exampleInputEmail1">رقم التليفون</label>
                        <input type="text" name="phone[]" value="{{old('phone')[$i]}}" class="form-control" id="exampleInputEmail1" placeholder="ادخل رقم التليفون " >
                      </div>

                  @endfor


                      <div class="form-group">
                        <label for="exampleInputEmail1">العنوان</label>
                            <input type="text" name="address" value="{{old('address')}}" class="form-control" id="exampleInputEmail1" placeholder="ادخل العنوان" >
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



