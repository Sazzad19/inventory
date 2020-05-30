@extends('backend.layouts.master')
@section('title')
    Product Edit Page
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Customer Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 75px;">
                            <div class="input-group">
                                <a href="{{route('product.list')}}" class="btn btn-success">View Product</a>
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
                            <h2>Edit Customer</h2>
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
                            <form action="{{route('customer.update',$customer->id)}}" method="post">
                                {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{$customer->name}}" class="form-control" id="name" name="name" placeholder="Enter name">
                                    <span class="error"><b>
                                         @if($errors->has('name'))
                                                {{$errors->first('name')}}
                                            @endif</b>
                                        </span>
                                </div>
                                <div class="form-group">
                                    <label for="district">District</label>
                                    <input type="text" value="{{$customer->district}}" class="form-control" id="district" name="district" placeholder="Enter name">
                                    <span class="error"><b>
                                         @if($errors->has('district'))
                                                {{$errors->first('district')}}
                                            @endif</b>
                                        </span>
                                </div>
                                <div class="form-group">
                                    <label for="phonenumber">PhoneNumber</label>
                                    <input type="text" value="{{$customer->phone_number}}" class="form-control" id="phonenumber" name="phonenumber" placeholder="Enter name">
                                    <span class="error"><b>
                                         @if($errors->has('phonenumber'))
                                                {{$errors->first('phonenumber')}}
                                            @endif</b>
                                        </span>
                                </div>
                                <div class="form-group">
                                    <label for="codenumber">CodeNumber</label>
                                    <input type="text"  value="{{$customer->code_number}}" class="form-control" id="codenumber" name="codenumber" placeholder="Enter module_key">
                                    <span class="error"><b>
                                         @if($errors->has('codenumber'))
                                                {{$errors->first('codenumber')}}
                                            @endif</b>
                                         </span>
                                </div>
                                <div class="form-group">
                                    <label for="due_amount">Due Amount</label>
                                    <input type="text" value="{{$customer->due_amount}}" class="form-control" id="due_amount" name="due_amount" placeholder="Enter module_url">
                                    <span class="error"><b>
                                         @if($errors->has('due_amount'))
                                                {{$errors->first('due_amount')}}
                                            @endif</b></span>
                                </div>



                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnCreate" class="btn btn-primary" >Update Product</button>
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
    <script src="{{asset('backend/plugins/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        $(function(){
            var $foo = $('#name');
            var $bar = $('#slug');
            function onChange() {
                $bar.val($foo.val().replace(/\s+/g, '-').toLowerCase());
            };
            $('#name')
                .change(onChange)
                .keyup(onChange);
        });
    </script>
@endsection
