@extends('backend.layouts.master')
@section('title')
    Module Edit Page
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Module Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 90px;">
                            <div class="input-group">
                                <a href="{{route('module.list')}}" class="btn btn-success">View Modules</a>
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
                            <h2>Edit Module</h2>
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
                              <form action="{{route('module.update',$module->id)}}" method="post">
                                           {{ csrf_field()}}
                                <div class="form-group">
                                    <label for="name">Module Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$module->name}}" placeholder="Enter name">
                                    <span class="error"><b>
                                         @if($errors->has('name'))
                                                {{$errors->first('name')}}
                                            @endif</b>
                                        </span>
                                </div>
                         
                                <div class="form-group">
                                    <label for="module_rank">Module Rank</label>
                                    <input type="text" class="form-control" id="module_rank" name="module_rank" value="{{$module->module_rank}}" placeholder="Enter module_rank">
                                    <span class="error"><b>
                                         @if($errors->has('module_rank'))
                                                {{$errors->first('module_rank')}}
                                            @endif</b></span>
                                </div>
                                <div class="form-group">
                                    <label for="module_icon">Module Icon</label>
                                    <input type="text" class="form-control" id="module_icon" name="module_icon" value="{{$module->module_icon}}"placeholder="Enter module_icon (eg:- fa fa-dashboard)">
                                </div>
                                <div class="form-group">
                                    <label>Disply in Sidebar</label>
                                    @if($module->view_sidebar == 1)
                                    <input type="radio" name="view_sidebar" value="1" id="view_sidebar" checked="1">
                                    <label for="view_sidebar"> Yes </label>
                                    <input type="radio" name="view_sidebar" id="deactive" value="0">
                                    <label for="deactive">No</label>
                                    @else
                                    <input type="radio" name="view_sidebar" value="1" id="view_sidebar" >
                                    <label for="view_sidebar"> Yes </label>
                                    <input type="radio" name="view_sidebar" id="deactive" value="0" checked="1">
                                    <label for="deactive">No</label>


                                    @endif
                                </div>
                                    <div class="form-group">
                                    <label>Display For &nbsp;</label>
                                    @foreach($role as $r)
                                     @foreach($currentrole as $cp)
                                        @if($cp->role_id == $r->id)
                                            @php($check = 'Checked')
                                            @php
                                                break;
                                            @endphp
                                        @else
                                            @php($check = '')
                                        @endif
                                    @endforeach
                                     <input type="checkbox" id="{{$r->name}}" name="roles[]" value="{{$r->id}}" @if(isset($check)){{$check}} @else @endif><label for="{{$r->name}}" >{{$r->name}}</label>
                                    @endforeach
                                </div>

                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="btnCreate" class="btn btn-primary">Update Module</button>
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