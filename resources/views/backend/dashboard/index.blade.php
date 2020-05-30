@extends('backend.layouts.master')
@section('title')
    NagarikBazar Dashboard Page
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2.min.css')}}">
    <!-- NProgress -->
    <link href="{{asset('backend/vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('backend/vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{asset('backend/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}"
          rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('backend/vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('backend/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/login/css/style.css')}}" rel="stylesheet">
   
@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <!-- top tiles -->
        <div class="row tile_count" style="font-size: x-large;">
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="info-box blue-bg bg-red" style="text-align: center;border-radius: 5px;">
                    <i class="fa fa-money"></i>
                    <div class="count">
                        {{$totalsaleamount}}
                    </div>
                    <div class="title">Total Sale</div>
                </div><!--/.info-box-->
            </div><!--/.col-->

            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="info-box brown-bg bg-primary" style="text-align: center;border-radius: 5px;">
                    <i class="fa fa-shopping-cart"></i>
                    <div class="count">{{$totalpurchasesamount}}</div>
                    <div class="title">Total Purchase</div>
                </div><!--/.info-box-->
            </div><!--/.col-->

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="info-box dark-bg bg-red" style="text-align: center;border-radius: 5px;">
                    <i class="fa fa-thumbs-o-up"></i>
                    <div class="count">{{$totalcreditsalesdue}}</div>
                    <div class="title">Total Credit Sale</div>
                </div><!--/.info-box-->
            </div><!--/.col-->


            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="info-box dark-bg bg-primary" style="text-align: center;border-radius: 5px;">
                    <i class="fa fa-product-hunt"></i>
                    <div class="count">{{$totaldue_to_pay}}</div>
                    <div class="title">Total Credit Expense</div>
                </div><!--/.info-box-->
            </div><!--/.col-->
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="info-box dark-bg bg-primary" style="text-align: center;border-radius: 5px;">
                    <i class="fa fa-product-hunt"></i>
                    <div class="count">{{Session::get('amount')}}</div>
                    <div class="title">{{Session::get('status')}}</div>
                </div><!--/.info-box-->
            </div><!--/.col-->
        </div>
        <!-- /top tiles -->
        @if(Session::has('success_message'))
            <div class="alert alert-success">
                {{ Session::get('success_message') }}
            </div>
        @endif
        @if(Session::has('error_message'))
            <div class="alert alert-danger">
                {{ Session::get('error_message') }}
            </div>
        @endif
        <div class="resp"></div>
        <br>

        <div class="row">

            <div class="col-md-6">


  <div class="container">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#cashsale">Cash Sale</a></li>
                <li><a data-toggle="tab" href="#creditsale">Credit Sale</a></li>
              </ul>
                <div class="tab-content">
              <div id="cashsale" class="tab-pane fade in active">
                          <div class="x_content">
                            <form id="btnSave" action="{{route('sales.store')}}" method="POST">
                                       {{ csrf_field()}}

                                       <div class="form-group">
                                           <label for="customer_id">Chose Customer</label>
                                        <select style="width:100%;" class="form-control js-example-basic-single" id="customer_id" name="customer_id" data-placeholder="--Search Customer--" required>
                </select>
                                           <span class="error"><b>
                                              @if($errors->has('customer_id'))
                                                     {{$errors->first('customer_id')}}
                                              @endif</b>
                                           </span>
                                       </div>
                                       <div class="form-group">
                                           <label for="product_id">Chose Product</label>
                                           <select class="form-control js-example-basic-single" id="product_id" name="product_id" data-placeholder="--Search Product--" required>
                                           </select>
                                           <span class="error"><b>
                                              @if($errors->has('product_id'))
                                                     {{$errors->first('product_id')}}
                                              @endif</b>
                                           </span>
                                       </div>
                                       <div class="form-group">
                                           <label for="quantity">Stock Available</label>
                                           <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock Available" disabled>
                                           <span class="error"><b>
                                                @if($errors->has('stock'))
                                                       {{$errors->first('stock')}}
                                                @endif</b></span>
                                       </div>
                                       <div class="form-group">
                                           <label for="price">Price per/pices*</label>
                                           <input type="number" class="form-control" name="price" id="price" placeholder="price" required>
                                           <span class="error"><b>
                                                @if($errors->has('price'))
                                                       {{$errors->first('price')}}
                                                @endif</b></span>
                                       </div>
                                       <div class="form-group">
                                           <label for="sales_quantity">Sales Quantity</label>
                                           <input type="number" min="1" class="form-control" id="sales_quantity" name="sales_quantity" placeholder="Quantity" required>
                                           <span class="error"><b>
                                                @if($errors->has('sales_quantity'))
                                                       {{$errors->first('sales_quantity')}}
                                                @endif</b></span>
                                       </div>
                                         <div class="form-group">
                                           <label for="bonus">Bonus</label>
                                           <input type="number" min="0" class="form-control" id="bonus" name="bonus" placeholder="Bonus" required>
                                          <span class="error"><b>
                                                @if($errors->has('bonus'))
                                                       {{$errors->first('bonus')}}
                                                @endif</b></span>
                                       </div>
                                           <div class="form-group">
                                           <label for="discount">Discount</label>
                                           <input type="number" min="0" class="form-control" id="discount" name="discount" placeholder="Discount" required >
                                           <span class="error"><b>
                                                @if($errors->has('discount'))
                                                       {{$errors->first('discount')}}
                                                @endif</b></span>
                                         
                                       </div>
                                           <div class="form-group">
                                           <label for="commission">Commission</label>
                                           <input type="number" min="0" class="form-control" id="commission" name="commission" placeholder="Commission" required>
                                           <span class="error"><b>
                                                @if($errors->has('commission'))
                                                       {{$errors->first('commission')}}
                                                @endif</b></span>
                                       
                                       </div>

                                       <!-- /.box-body -->
                                       <div class="box-footer">
                                           <button type="submit" name="btnSave" class="btn btn-primary">MakeSales</button>
                                       </div>
                                   </form>
                                  </div>
                              </div>


                            <div id="creditsale" class="tab-pane fade">
                                 <div class="x_content">
                                    <form id="btnSave" action="{{route('credit.sales.store')}}" method="POST">
                                        {{ csrf_field()}}
                                        <div class="form-group">
                                            <label for="customer_id">Chose Customer</label>
                                           <select style="width:100%;" class="form-control js-example-basic-single" id="customer_id1" name="customer_id" data-placeholder="--Search Customer--" required>
                </select>
                                            <span class="error"><b>
                                               @if($errors->has('customer_id'))
                                                      {{$errors->first('customer_id')}}
                                               @endif</b>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <label for="due">Previous Due</label>
                                            <input type="number" class="form-control" id="due" name="due" placeholder="Previous Due" disabled>
                                            <span class="error"><b>
                                                 @if($errors->has('due'))
                                                        {{$errors->first('due')}}
                                                 @endif</b></span>
                                        </div>
                                        <div class="form-group">

                                          <label for="product_id1">Chose Product</label>
                                         <select style="width:100%;" class="form-control js-example-basic-single" id="product_id1" name="product_id" data-placeholder="--Search Product--" required>
                </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="quantity">Stock Available</label>
                                            <input type="number" class="form-control" id="stock1" name="stock" placeholder="Stock Available" disabled>
                                            <span class="error"><b>
                                                 @if($errors->has('stock'))
                                                        {{$errors->first('stock')}}
                                                 @endif</b></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price per/pices*</label>
                                            <input type="number" class="form-control" name="price" id="price1" placeholder="price" required>
                                            <span class="error"><b>
                                                 @if($errors->has('price'))
                                                        {{$errors->first('price')}}
                                                 @endif</b></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="sales_quantity">Sales Quantity</label>
                                            <input type="number" min="1" class="form-control" id="quantity1" name="sales_quantity" placeholder="Quantity" required>
                                            <span class="error"><b>
                                                 @if($errors->has('sales_quantity'))
                                                        {{$errors->first('sales_quantity')}}
                                                 @endif</b></span>
                                        </div>
                                               <div class="form-group">
                                           <label for="bonus">Bonus</label>
                                           <input type="number" min="0" class="form-control" id="bonus" name="bonus" placeholder="Bonus" required>
                                          <span class="error"><b>
                                                @if($errors->has('bonus'))
                                                       {{$errors->first('bonus')}}
                                                @endif</b></span>
                                       </div>

                                           <div class="form-group">
                                           <label for="discount">Discount</label>
                                           <input type="number" min="0" class="form-control" id="discount" name="discount" placeholder="Discount" required >
                                           <span class="error"><b>
                                                @if($errors->has('discount'))
                                                       {{$errors->first('discount')}}
                                                @endif</b></span>
                                         
                                       </div>
                                       
                                           <div class="form-group">
                                           <label for="commission">Commission</label>
                                           <input type="number" min="0" class="form-control" id="commission" name="commission" placeholder="Commission" required>
                                           <span class="error"><b>
                                                @if($errors->has('commission'))
                                                       {{$errors->first('commission')}}
                                                @endif</b></span>
                                       
                                       </div>
                                                <div class="form-group">
                                    <label for="paid_amount">Paid Amount</label>
                                    <input type="number" min="1" class="form-control" id="paid_amount" name="paid_amount" placeholder="Paid Amount" required>
                                    <span class="error"><b>
                                         @if($errors->has('paid_amount'))
                                                {{$errors->first('paid_amount')}}
                                         @endif</b></span>
                                </div>
                                        <!-- /.box-body -->
                                        <div class="box-footer">
                                            <button type="submit" name="btnSave" class="btn btn-primary">MakeSales</button>
                                        </div>
                                    </form>
                                </div>

</div>
</div>
</div>





            </div>
            <div class="col-md-6">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Quick Sales Billing
                            <small>Listing Billing</small>
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="saleslist">

                        </div>
                        <div id="ajaxform">

                        </div>
                    </div>
                </div>
            </div>
        </div>

  <div class="row">
        
          <div class="x_panel">
               <div class="x_title">
                            <h2>Credit sales</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Settings 1</a>
                                        </li>
                                        <li><a href="#">Settings 2</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
              <div class="x_content">
                <table width="100%" class="table table-striped table-bordered table-hover" id="myTable">
                      <thead>
                      <tr>
                          <th>S.N.</th>
                          <th>Customer Name</th> 
                          <th>Product Name</th>
                        
                          <th>Total Price</th>
                          <th>Paid Amount</th>
                          <th>Due Amount</th>
                          <th>Sale Date</th>

                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $l=1 ?>
                      @foreach($creditsale as $m)
                          <tr>
                              <th> {{$l++}}</th>
                              <td> {{$m->cust_name}}</td>
                              <td> {{$m->prod_name}}</td>
                              <td> {{$m->price}}</td>

                              <td> {{$m->paidamount}}</td>
                               <td> {{$m->dueamount}}</td>
                              <td> {{$m->sales_date}}</td>
                              <td>
                                  <div class="row">
                                      <div class="col-md-5">
                                          <a href="{{route('creditsale.edit',$m->id)}}" class="btn btn-info "><i class="fa fa-pencil"></i> Edit</a>
                                      </div>
                                    {{--  <div class="col-md-5">
                                          <form action="" method="post">
                                              <input type="hidden" name="_method" value="DELETE">
                                              {{ csrf_field()}}
                                              <button class="btn btn-danger" type="submit" onclick= "return confirm('are you sure to delete?')"><i class="fa fa-trash-o"></i> Delete</button>
                                          </form>
                                      </div> --}}

                                      <div class="col-md-3">
                                                   <a href="{{route('creditsale.paydue',$m->id)}}" class="btn btn-info"><i class="fa fa-check-circle"></i> Pay due</a>
                                                </div>
                                  </div>
                              </td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
                  
              </div>
          </div>
       
      </div>
        <div class="row">
          <div class="x_panel">
              <div class="x_title">
                  <h2>Credit Purchases</h2>
                  <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                          <ul class="dropdown-menu" role="menu">
                              <li><a href="#">Settings 1</a>
                              </li>
                              <li><a href="#">Settings 2</a>
                              </li>
                          </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <table width="100%" class="table table-striped table-bordered table-hover" id="myTable1">
                      <thead>
                      <tr>
                          <th>S.N.</th>
                          <th>Party Name</th>
                          <th>Goods Name</th>
                          <th>Total Amount</th>
                          <th>Due Amount</th>
                          <th>Purchase Date</th>

                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php $l=1 ?>
                      @foreach($creditpusrchase as $m)
                          <tr>
                              <th> {{$l++}}</th>
                              <td> {{$m->party_name}}</td>
                              <td> {{$m->goods_name}}</td>
                              <td> {{$m->totalamount}}</td>

                              <td> {{$m->dueamount}}</td>
                              <td> {{$m->purchase_date}}</td>
                              <td>
                                  <div class="row">
                                      {{--<div class="col-md-5">
                                          <a href="{{route('module.edit',$m->id)}}" class="btn btn-info "><i class="fa fa-pencil"></i> Edit</a>
                                      </div>
                                      <div class="col-md-5">
                                          <form action="" method="post">
                                              <input type="hidden" name="_method" value="DELETE">
                                              {{ csrf_field()}}
                                              <button class="btn btn-danger" type="submit" onclick= "return confirm('are you sure to delete?')"><i class="fa fa-trash-o"></i> Delete</button>
                                          </form>
                                      </div>
                                      --}}
                                               <div class="col-md-3">
                                                     <a href="{{route('purchase.edit',$m->id)}}" class="btn btn-info" ><i class="fa fa-check-circle"></i> Pay Due</a>
                                                </div>
                                  </div>
                              </td>
                          </tr>
                      @endforeach
                      </tbody>
                  </table>
                 
              </div>
          </div>
        </div>
 

  <div class="row">
    <div class="x_panel">
        <div class="x_title">
            <h2>Create Product</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Settings 1</a>
                        </li>
                        <li><a href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{route('product.store')}}" method="post">
                {{ csrf_field()}}
                <div class="form-group">
                    <label for="productcategory_id">Chose ProductCategory</label>
                    <select class="form-control" id="productcategory_id" name="productcategory_id">
                        <option value="">--Select Productcategory--</option>
                        @foreach($productcategory as $m)
                            <option value="{{$m->id}}">{{$m->name}}</option>
                        @endforeach
                    </select>
                    <span class="error"><b>
                       @if($errors->has('productcategory_id'))
                                {{$errors->first('productcategory_id')}}
                            @endif</b>
                    </span>
                </div>
                <div class="form-group">
                    <label for="name">Name*</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    <span class="error"><b>
                           @if($errors->has('name'))
                                {{$errors->first('name')}}
                            @endif</b>
                     </span>
                </div>
                <div class="form-group">
                    <label for="code">Code*</label>
                    <input type="text" class="form-control" id="code" name="code" placeholder="Enter Product code">
                    <span class="error"><b>
                           @if($errors->has('code'))
                                {{$errors->first('code')}}
                            @endif</b>
                     </span>
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity*</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
                    <span class="error"><b>
                         @if($errors->has('quantity'))
                                {{$errors->first('quantity')}}
                            @endif</b></span>
                </div>
                <div class="form-group">
                    <label for="price">Price*</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Enter price per Item">
                    <span class="error"><b>
                         @if($errors->has('price'))
                                {{$errors->first('price')}}
                            @endif</b></span>
                </div>
                <div class="form-group">
                    <label for="price">Expiry Date*</label>
                    <input type="date" class="form-control" id="expiry_date*" name="expiry_date" placeholder="Enter Expiry Date of the Item">
                    <span class="error"><b>
                         @if($errors->has('expiry_date'))
                                {{$errors->first('expiry_date')}}
                            @endif</b></span>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <input type="radio" name="status" value="1" id="Active" checked=""><label for="Active"> Active</label>
                    <input type="radio" name="status" id="deactive" value="0"><label for="deactive">DeActive</label>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="btnCreate" class="btn btn-primary" >Save Product</button>
                </div>
            </form>
        </div>
    </div>
  </div>


        <br/>
    </div>
    <!-- /page content -->
@endsection

@section('script')

  <script type="text/javascript" src="{{asset('backend/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready( function () {
    $('#myTable').DataTable();
     $('#myTable1').DataTable();
} );
    </script>
    <script src="{{asset('backend/plugins/select2.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".js-example-basic-single").select2();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#product_id').on('change', function () {
                var prdid = $(this).val();
                var path = 'getquantity';
                $.ajax({
                    url: path,
                    method: 'post',
                    data: {'product_id': prdid, '_token': $('input[name=_token]').val()},
                    dataType: 'text',
                    success: function (resp) {
                        console.log(resp);
                        //$('#quantity').empty();
                        $('#stock').val(resp);
                    }
                });

            });
            $('#product_id1').on('change', function () {
                var prdid = $(this).val();
                var path = 'getquantity';
                $.ajax({
                    url: path,
                    method: 'post',
                    data: {'product_id': prdid, '_token': $('input[name=_token]').val()},
                    dataType: 'text',
                    success: function (resp) {
                        console.log(resp);
                        $('#quantity1').empty();
                        $('#stock1').val(resp);
                    }
                });

            });


            $('#product_id').on('change', function () {
                var prdid = $(this).val();
                var path = 'getprice';
                $.ajax({
                    url: path,
                    method: 'post',
                    data: {'product_id': prdid, '_token': $('input[name=_token]').val()},
                    dataType: 'text',
                    success: function (resp) {
                        console.log(resp);
                        //$('#price').empty();
                        $('#price').val(resp);
                    }
                });
            });

            $('#product_id1').on('change', function () {
                var prdid = $(this).val();
                var path = 'getprice';
                $.ajax({
                    url: path,
                    method: 'post',
                    data: {'product_id': prdid, '_token': $('input[name=_token]').val()},
                    dataType: 'text',
                    success: function (resp) {
                        console.log(resp);
                        $('#price1').empty();
                        $('#price1').val(resp);
                    }
                });
            });

            $('#customer_id1').on('change', function () {
                var cstid = $(this).val();
                var path = 'getcustomerdue';
                $.ajax({
                    url: path,
                    method: 'post',
                    data: {'customer_id': cstid, '_token': $('input[name=_token]').val()},
                    dataType: 'text',
                    success: function (resp) {
                        console.log(resp);
                        $('#due').empty();
                        $('#due').val(resp);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CRF-TOKEN': $('meat[name = "csrf-token"]').attr('content')
                }
            });
            $('#btnSave').on('submit', function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                var post = $(this).attr('method');
                var data = $(this).serialize();
                $.ajax({
                    url: url,
                    type: post,
                    data: data,
                    success: function (data) {
                        refreshproduct();
                        readsales();
                        ajaxform();
                     
                        var m = "<div class='alert alert-success'>" + data.success_message + "</div>";
                        // alert(data.success_message);
                        $('.resp').html(m);
                           document.getElementById("btnSave").reset();

                    }
                });
            });
        });
        readsales();
        refreshproduct();
        readsales();
        refreshproduct();
        refreshproduct1()
        refreshcustomer();
         refreshcustomer1();  
        ajaxform();
        function readsales() {
            $.ajax({
                type: 'get',
                url: "{{url('ajaxsales-list')}}",
                dataType: 'html',
                success: function (data) {
                    $('#saleslist').html(data);
                }
            })
        }
        function ajaxform() {
            $.ajax({
                type: 'get',
                url: "{{url('ajax-form')}}",
                dataType: 'html',
                success: function (data) {
                    $('#ajaxform').html(data);
                }
            })
        }
        function refreshproduct() {
            $.ajax({
                type: 'get',
                url: "{{url('refresh-product')}}", 
                dataType: 'html',
                success: function (data) {
                    $('#product_id').html(data);
                }
            })
        }

             function refreshproduct1() {
            $.ajax({
                type: 'get',
                url: "{{url('refresh-product')}}", 
                dataType: 'html',
                success: function (data) {
                    $('#product_id1').html(data);
                }
            })
        }
             function refreshcustomer() {
            $.ajax({
                type: 'get',
                url: "{{url('refresh-customer')}}",
                dataType: 'html',
                success: function (data) {
                    $('#customer_id').html(data);
                }
            })
        }
                function refreshcustomer1() {
            $.ajax({
                type: 'get',
                url: "{{url('refresh-customer')}}",
                dataType: 'html',
                success: function (data) {
                    $('#customer_id1').html(data);
                }
            })
        }
        function printorder() {
            $.ajax({
                url: "{{url('sales-allpdf')}}",
                type: 'get',
                dataType: 'html',
                success:function(data) {
                    var mywindow = window.open('', 'Sabaiko Live Bakery', 'height=400,width=600');
                    mywindow.document.write('<html><head><title></title>');
                    mywindow.document.write('</head><body>');
                    mywindow.document.write(data);
                    mywindow.document.write('</body></html>');
                    mywindow.document.close();
                    mywindow.focus();
                    mywindow.print();
                    mywindow.close();

                }
            });
        }

    </script>

    <!-- FastClick -->
    <script src="{{asset('backend/vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('backend/vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('backend/vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('backend/vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('backend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('backend/vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('backend/vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('backend/vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('backend/vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('backend/vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('backend/vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('backend/vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('backend/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('backend/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('backend/vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('backend/vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('backend/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('backend/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('backend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('backend/vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('backend/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('backend/vendors/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <!-- Custom Theme Scripts -->
@endsection
