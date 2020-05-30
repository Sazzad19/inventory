@extends('backend.layouts.master')
@section('title')
   Purchase Listing Page
@endsection
@section('css')
    <link  href="{{asset('backend/plugins/datepicker/datepicker.css')}}" rel="stylesheet">
  
@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Purchase Management</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 110px;">
                            <div class="input-group">
                                <a href="{{route('purchase.create')}}" class="btn btn-success">New Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
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
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Remaining to paid Purchase Details</h2>
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
                            <table width="100%" class="table table-striped table-bordered table-hover" id="purchaseTable">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Goods Name</th>
                                    <th>Party Name</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                    <th>Purchase Date</th>
                                    <th>Purchase By</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1 ?>
                                @foreach($rempurchase as $pc)
                                    <tr>
                                        <th> {{$i++}}</th>
                                        <td> {{$pc->goods_name}}</td>
                                        <td> {{$pc->party_name}}</td>
                                        <td> {{$pc->totalamount}}</td>
                                        <td> {{$pc->paidamount}}</td>
                                        <td> {{$pc->dueamount}}</td>
                                        <td> {{$pc->created_at}}</td>
                                        <td> {{$pc->created_by}}</td>
                                        <td>
                                            @if($pc->status == 'vat')
                                                <span class="label label-success"> vat </span>
                                            @endif
                                            @if($pc->status == 'pan')
                                                <span class="label label-success"> pan </span>
                                            @endif
                                            @if($pc->status == 'normal')
                                                <span class="label label-success"> normal </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('purchase.edit',$pc->id)}}" class="btn btn-info" ><i class="fa fa-check-circle"></i> Pay Due</a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"> Grand Total </td>
                                    <td>
                                        <?php $total=0 ?>
                                        @if($rempurchase)
                                            @foreach($rempurchase as $s)
                                                @php
                                                    $price = $s->totalamount;
                                                    $total += $price;
                                                @endphp
                                            @endforeach
                                            Tk. {{$total}}
                                        @endif
                                    </td>
                                    <td>
                                        <?php $total=0 ?>
                                        @if($rempurchase)
                                            @foreach($rempurchase as $s)
                                                @php
                                                    $price = $s->paidamount;
                                                    $total += $price;
                                                @endphp
                                            @endforeach
                                            Tk. {{$total}}
                                        @endif
                                    </td>
                                    <td>
                                        <?php $total=0 ?>
                                        @if($rempurchase)
                                            @foreach($rempurchase as $s)
                                                @php
                                                    $price = $s->dueamount;
                                                    $total += $price;
                                                @endphp
                                            @endforeach
                                            Tk. {{$total}}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                  <div class="row">
                            <form id="purchasereport" action="{{route('purchase.report')}}" method="post">
                                {{csrf_field()}}
                                <div class="col-md-3">
                                    <input class="form-control" data-toggle="start" type="text" name="start" placeholder="pick Start Date">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" data-toggle="end" type="text" name="end" placeholder="pick End Date">
                                </div>
                                <div class="col-md-3">
                                    <button  id="purchasereport" type="submit" class="btn btn-info">Import Report</button>
                                </div>
                            </form>
                        </div>
                        <button  id="purchase"  class="btn btn-info">Import Report</button>

                        <br>
                        <h2>Clear paid Purchase details</h2>
                        <hr>
                        <div class="x_content">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="categorytable">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Goods Name</th>
                                    <th>Party Name</th>
                                    <th>Total Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Due Amount</th>
                                    <th>Purchase Date</th>
                                    <th>Purchase By</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 1 ?>
                                @foreach($paidpurchase as $pc)
                                    <tr>
                                        <th> {{$i++}}</th>
                                        <td> {{$pc->goods_name}}</td>
                                        <td> {{$pc->party_name}}</td>
                                        <td> {{$pc->totalamount}}</td>
                                        <td> {{$pc->paidamount}}</td>
                                        <td> {{$pc->dueamount}}</td>
                                        <td> {{$pc->created_at}}</td>
                                        <td> {{$pc->created_by}}</td>
                                        <td>
                                            @if($pc->status == 'vat')
                                                <span class="label label-success"> vat </span>
                                            @endif
                                            @if($pc->status == 'pan')
                                                <span class="label label-success"> pan </span>
                                            @endif
                                            @if($pc->status == 'normal')
                                                <span class="label label-success"> normal </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3"> Grand Total </td>
                                    <td>
                                        <?php $total=0 ?>
                                        @if($paidpurchase)
                                            @foreach($paidpurchase as $s)
                                                @php
                                                    $price = $s->totalamount;
                                                    $total += $price;
                                                @endphp
                                            @endforeach
                                            Tk. {{$total}}
                                        @endif
                                    </td>
                                    <td>
                                        <?php $total=0 ?>
                                        @if($paidpurchase)
                                            @foreach($paidpurchase as $s)
                                                @php
                                                    $price = $s->paidamount;
                                                    $total += $price;
                                                @endphp
                                            @endforeach
                                            Tk. {{$total}}
                                        @endif
                                    </td>
                                    <td>
                                        <?php $total=0 ?>
                                        @if($paidpurchase)
                                            @foreach($paidpurchase as $s)
                                                @php
                                                    $price = $s->dueamount;
                                                    $total += $price;
                                                @endphp
                                            @endforeach
                                            Tk. {{$total}}
                                        @endif
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
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
        $(document).ready(function() {
            $('#purchaseTable').DataTable();
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

    $("#purchase").on("click",function(){
    alert("The paragraph was clicked.");
  });


    $.ajaxSetup({
        headers: {
            'X-CRF-TOKEN': $('meat[name = "csrf-token"]').attr('content')
        }
    });


    $('#purchasereport').on('submit', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var post = $(this).attr('method');
        var data = $(this).serialize();
        $.ajax({
            url: url,
            type: post,
            data: data,
            dataType: 'html',
            success: function (data) {
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
    });


});

    </script>
      
@endsection