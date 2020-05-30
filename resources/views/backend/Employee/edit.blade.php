@extends('backend.layouts.master')
@section('title')
    Employees Edit Page
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Employee Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 90px;">
                            <div class="input-group">
                                <a href="{{route('employee.list')}}" class="btn btn-success">View Employees</a>
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
                            <h2>Edit Employee</h2>
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
                              <form action="{{route('employee.update',$employee->id)}}" method="post">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Employee Name</label>
                                    <input type="text" class="form-control" id="name" value="{{$employee->name}}" name="name" placeholder="Enter Permission Name">
                                    <span class="error"><b>
                                         @if($errors->has('name'))
                                                {{$errors->first('name')}}
                                            @endif</b>
                                        </span>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" value="{{$employee->address}}" name="address" placeholder="Enter Permission Name">
                                    <span class="error"><b>
                                         @if($errors->has('address'))
                                                {{$errors->first('address')}}
                                            @endif</b>
                                        </span>
                                </div>
                                  <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" value="{{$employee->phone_number}}" name="phone_number" placeholder="Enter Permission Name">
                                    <span class="error"><b>
                                         @if($errors->has('phone_number'))
                                                {{$errors->first('phone_number')}}
                                            @endif</b>
                                        </span>
                                </div>
                                  <div class="form-group">
                                    <label for="salary">Salary</label>
                                    <input type="text" class="form-control" id="salary" value="{{$employee->salary}}" name="salary" placeholder="Enter Permission Name">
                                    <span class="error"><b>
                                         @if($errors->has('salary'))
                                                {{$errors->first('salary')}}
                                            @endif</b>
                                        </span>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" name="btnUpdate" class="btn btn-primary">Update Employee</button>
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

@endsection