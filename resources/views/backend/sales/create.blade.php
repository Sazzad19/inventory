@extends('backend.layouts.master')
@section('title')
    Make Sales Page
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('backend/plugins/select2.min.css')}}">
    <link  href="{{asset('backend/plugins/datepicker/datepicker.css')}}" rel="stylesheet">
@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Sales Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 95px;">
                            <div class="input-group">
                                <a href="{{route('sales.list')}}" class="btn btn-success">View Sales Report</a>
                            </div>
                        </div>

                    </div>
                     <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 95px;">
                            <div class="input-group">
                                <a href="{{route('customer.create')}}" class="btn btn-success">Create Customer</a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
              <div class="clearfix"></div>
            @if(Session::has('success_message'))
                <div class="alert alert-success">
                    {{ Session::get('success_message') }}<div id="msg"></div>
                </div>
            @endif
            @if(Session::has('error_message'))
                <div class="alert alert-danger">
                    {{ Session::get('error_message') }}
                </div>
            @endif
            <div class="resp"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Sale Product</h2>
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
                    </div>
                </div>
            </div>

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
                                           <label for="price">Price per/quantity*</label>
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
    </div>
    <!-- /page content -->
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('backend/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#categorytable').DataTable();
        });
    </script>
    <script src="{{asset('backend/plugins/select2.min.js')}}"></script>
    <script type="text/javascript">


        $(document).ready(function () {
            $(".js-example-basic-single").select2();

        });
    </script>
    <script src="{{asset('backend/plugins/datepicker/datepicker.js')}}"></script>
    <script type="text/javascript">
        $('[data-toggle="start"]').datepicker({
            format: 'yyyy-mm-dd'
        });

        $('[data-toggle="end"]').datepicker({
            format: 'yyyy-mm-dd'
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
                        $('#quantity').empty();
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
                        $('#price').empty();
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
        refreshproduct1();
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
@endsection
