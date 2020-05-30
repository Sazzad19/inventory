@extends('backend.layouts.master')
@section('title')
    Database Backup List
@endsection
@section('css')

@endsection
<!-- page content -->
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3> Database Backup List</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 100px;">
                           <div class="input-group">
                                <a href="{{route('backup.create')}}" class="btn btn-success">Create New Backup</a>
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
                            <h2>Listing Database Files</h2>
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
                                    <th>File Name</th>
                                    <th>Size</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                 
                                </tr>
                                </thead>
                                <tbody>
                                <?php $l=1 ?>
                                @foreach($backups as $m)
                                    <tr>
                                        <th> {{$l++}}</th>
                                        <td> {{$m['file_name']}}</td>
                                          <td> {{$m['file_size']}}</td>
                                           <td>{{$m['last_modified']}}</td>
                                          
                                       
                                        <td>
                                           <a  href="{{route('backup.download',$m['file_name'])}}"><li class="fa fa-download">Download</li></a>
                                           <a  href="{{route('backup.delete',$m['file_name'])}}"><li class="fa fa-remove">Delete</li></a>
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
