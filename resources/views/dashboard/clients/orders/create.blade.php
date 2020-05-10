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
  <li class="active">Add Order</li>
  </ol>

    @include('layouts.error')

  <div class="row">
    <h3 class="box-title">Categories</h3>

    <div class="col-md-6">
        @foreach ($categories as $category)

    <p>
        <a class="btn btn-primary btn-block" data-toggle="collapse" href="#{{str_replace(' ', '_', $category->name)}}" role="button" aria-expanded="false" aria-controls="collapseExample">
            {{$category->name}}
        </a>

      </p>
      <div class="panel-collapse collapse" id="{{str_replace(' ', '_', $category->name)}}">
        <div class="card card-body">
            @if ($category->count() > 0)

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>الاسم</th>
                        <th>المخزن</th>
                        <th>الســعر</th>
                        <th>اضــف</th>
                    </tr>
                </thead>

                @foreach ($category->products as $product)
                 <tbody>
                    <tr >
                        @foreach (config('translatable.locales') as $local )
                        <td>{{$product->translate($local)->name}}</td>
                            @endforeach
                             <td>{{$product->stock}}</td>
                             <td>{{$product->sale_price}}</td>
                            <td>
                                <a href=""
                                     id="product-{{$product->id}}"
                                    data-id="{{$product->id}}"
                                    data-name="{{$product->name}}"
                                    data-price="{{$product->sale_price}}"

                                     class="btn btn-success btn-sm add-product">
                                     <i class="fa fa-plus"></i>
                                    </a>
                            </td>
                        </tr>
                 </tbody>
                 @endforeach

            </table>
            @else
            <h1>No Recordis </h1>
            @endif
           </div>
      </div>
      @endforeach
    </div>

        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Orders</h3>
                </div>
                <!-- /.box-header -->
                <form action="{{route('dashboard.clients.orders.store',$client->id)}}" method="POST">
                    @csrf
                    @method('post')

                        <div class="card card-body">

                            <table class="table text-center table-hover">
                                <thead class="align-center">

                                    <tr >
                                        <th>المنتج</th>
                                        <th>الكمية</th>
                                        <th>الســعر</th>
                                    </tr>
                                </thead>

                                 <tbody class="order-list">


                                 </tbody>

                            </table>
                        </div>

                            <h4 class="inline pull-right">
                                    المجموع :
                                <span class="total"></span>
                             </h4>
                             <button class="btn btn-primary btn-block disabled" id="add-order">اضف طلب</button>

                            </form>
                        </div>
             </div>
        </div>
    </div>
</div>

    </section>

@endsection



