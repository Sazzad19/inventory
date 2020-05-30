 @extends('backend.layouts.master')
@section('title')
    Employees create Page
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
                    <h3>Dealer Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <a href="{{route('dealer.list')}}" class="btn btn-success">View Dealers</a>
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
                            <h2>Create Dealer</h2>
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
                            <form action="{{route('dealer.store')}}" method="post">
                                {{ csrf_field()}}
                               <div class="form-group">
                                <label for="customer_id">Select Customer Id</label>
                                <select style="width:100%;" class="form-control js-example-basic-single" id="customer_id" name="customer_id" data-placeholder="--Search Customer--" required>
                                </select>
                                <span class="error"><b>
                                   @if($errors->has('customer_id'))
                                          {{$errors->first('customer_id')}}
                                   @endif</b>
                                </span>
                            </div>
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <input type="text" class="form-control" id="area" name="area" placeholder="Enter Area">
                                    <span class="error"><b>
                                         @if($errors->has('area'))
                                                {{$errors->first('area')}}
                                            @endif</b>
                                        </span>
                                </div>
                                <div class="form-group">
                                    <label for="selltarget">Sale Target</label>
                                    <input type="number" class="form-control" id="selltarget" name="selltarget" placeholder="Enter Sell Target">
                                    <span class="error"><b>
                                         @if($errors->has('selltarget'))
                                                {{$errors->first('selltarget')}}
                                            @endif</b>
                                        </span>
                                </div>
                              
                        



                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnCreate" class="btn btn-primary">Create Dealer</button>
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
            $("#customer_id").select2();
        });
    </script>

<script type="text/javascript">
    refreshcustomer();

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

</script>
@endsection
