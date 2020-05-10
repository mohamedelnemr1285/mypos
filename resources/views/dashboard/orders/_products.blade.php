
<div class="col-md-4 test" style="display:none">
    <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Orders</h3>
        </div>
        <!-- /.box-header -->

                <div class="card card-body">

                    <table class="table text-center table-hover" >
                        <thead class="align-center">

                            <tr >
                                <th>الاسم</th>
                                <th>الكمية</th>
                                <th>الســعر</th>
                            </tr>
                        </thead>

                         <tbody class="order-list">
                             @foreach ($order->products as $product)
                             <tr>
                             <td>{{$product->name}}</td>
                             <td>{{$product->pivot->quantity}}</td>
                             <td>{{number_format($product->pivot->quantity * $product->sale_price, 2)}}</td>
                             </tr>

                             @endforeach


                         </tbody>

                    </table>
                </div>


                </div>
     </div>
</div>
