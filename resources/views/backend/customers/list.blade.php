@extends('backend.layouts.master')
@section('title')
    Module Listing Page
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Module Management</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 100px;">
                            <div class="input-group">
                                <a href="{{route('customer.create')}}" class="btn btn-success">Create New Customer</a>
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
                            <h2>Listing Customers</h2>
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
                             <table width="100%" class="table table-striped table-bordered table-hover" id="customerTable">
                                <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>Name</th>
                                    <th>District</th>
                                    <th>PhoneNumber</th>
                                    <th>CodeNumber</th>
                                    <th>Due Amount</th>
                                    <th>Customer Type</th>

                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $l=1 ?>
                                @foreach($customer as $m)
                                    <tr>
                                        <th> {{$l++}}</th>
                                        <td> {{$m->name}}</td>
                                        <td> {{$m->district}}</td>
                                        <td> {{$m->phone_number}}</td>

                                        <td> {{$m->code_number}}</td>
                                        <td> {{$m->due_amount}}</td>
                                         <td>
                                            @if($m->customer_type == 0)
                                                <span class="label label-success"> Normal </span>
                                            @else
                                                <span class="label label-danger">Dealer </span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <a href="{{route('customer.edit',$m->id)}}" class="btn btn-info "><i class="fa fa-pencil"></i> Edit</a>
                                                </div>
                                                <div class="col-md-5">
                                                  <form action="{{route('customer.delete' ,$m->id)}}" method="post">
                                                      <input type="hidden" name="_method" value="DELETE">
                                                      {{ csrf_field()}}
                                                      <button type="submit" class="btn btn-danger" onclick="return confirm('are you sure to delete?')" ><i class="fa fa-trash-o"></i></button>
                                                  </form>
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
            </div>
        </div>
    </div>
    <!-- /page content -->
@endsection
@section('script')
  <script type="text/javascript" src="{{asset('backend/plugins/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript">
        $(document).ready( function () {
    $('#customerTable').DataTable();
    
} );
    </script>

@endsection
