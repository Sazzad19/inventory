@extends('backend.layouts.master')
@section('title')
    Sales Edit Page
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('backend/plugins/select2.min.css')}}">
@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Sale Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 90px;">
                            <div class="input-group">
                                <a href="{{route('sales.list')}}" class="btn btn-success">View Sales</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit CreditSale</h2>
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
                              <form action="{{route('creditsale.update',$creditsale->id)}}" method="post">
                                           {{ csrf_field()}}
                             

                             
                         
                                      <div class="form-group">
                                           <label for="sales_quantity">Sales Quantity</label>
                                           <input type="number" min="1" class="form-control" id="sales_quantity" name="sales_quantity" value="{{$creditsale->quantity}}" placeholder="Quantity" required>
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
                                    <input type="number" min="1" class="form-control" value="{{$creditsale->paidamount}}" id="paid_amount" name="paid_amount" placeholder="Paid Amount" required>
                                    <span class="error"><b>
                                         @if($errors->has('paid_amount'))
                                                {{$errors->first('paid_amount')}}
                                         @endif</b></span>
                                </div>

                         

                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnCreate" class="btn btn-primary">Update CreditSale</button>
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
  <script src="{{asset('backend/plugins/select2.min.js')}}"></script>
<script type="text/javascript">
   $(document).ready(function () {
            $(".js-example-basic-single").select2();

        });
     $(document).ready(function () {
            $('#product_id').on('change', function () {
                var prdid1 = $(this).val();

                var path1 = 'getquantityedit';
                $.ajax({
                    url: path1,
                    method: 'post',
                    data: {'product_id1': prdid1, '_token': $('input[name=_token]').val()},
                    dataType: 'text',
                    success: function (resp) {
                        console.log(resp);
                    
                        $('#stock').val(resp);
                    }
                });

            });
          });
</script>

@endsection