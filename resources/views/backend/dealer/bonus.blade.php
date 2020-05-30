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
                    <h3>Dealer Management </h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 90px;">
                            <div class="input-group">
                                <a href="{{route('dealer.list')}}" class="btn btn-success">View Dealers</a>
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
                            <h2>Dealer Bouns</h2>
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
                              <form action="{{route('dealer.store_bonus',$dealer->id)}}" method="post">
                                {{ csrf_field()}}
                          
                          <?php
                             $conn = new mysqli('localhost', 'root', '', 'nagarik_bazar');
                             $sql = "SELECT* FROM dealers where id=$dealer->id";
                                 $result = $conn->query($sql);
                                 $dl=mysqli_fetch_array($result);
                                 $sql = "SELECT* FROM sales where customer_id=".$dl['customer_id'];
                                 $result = $conn->query($sql);
                                  $totalcreditsalesamount = 0;
                                while($rw=mysqli_fetch_array($result)){
                                    $with=$rw['price'];
                                     $totalcreditsalesamount += $with;
                                 }


                            ?>
                                <div class="form-group">
                                    <label for="totalsell">Total Sell</label>
                                    <input type="text" class="form-control" id="totalsell" value="{{$totalcreditsalesamount}}" name="totalsell">
                                    <span class="error"><b>
                                         @if($errors->has('selltarget'))
                                                {{$errors->first('selltarget')}}
                                            @endif</b>
                                        </span>
                                </div>
                                      <div class="form-group">
                                    <label for="bonus">Bonus Percentage</label>
                                    <input type="number" class="form-control" id="bonus" name="bonus" placeholder="Enter Bonus Pecentage">
                                    <span class="error"><b>
                                         @if($errors->has('bonus'))
                                                {{$errors->first('bonus')}}
                                            @endif</b>
                                        </span>
                                </div>
                      
                       
                                <div class="box-footer">
                                    <button type="submit" name="btnUpdate" class="btn btn-primary">Give Commission</button>
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