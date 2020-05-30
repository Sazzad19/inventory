@extends('backend.layouts.master')
@section('title')
   Make Sales Listing Page
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
                    <h3>Sales Management</h3> 
                </div>
                    <div class="title_right">
                    <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 100px;">
                            <div class="input-group">
                                <a href="{{route('sales.create')}}" class="btn btn-success">Make New Sales</a>
                            </div>

                        </div>

                    </div>
                     <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 100px;">
                            <div class="input-group">
                                <a href="{{route('sales.list')}}" class="btn btn-success">View Sales Report</a>
                            </div>
                        </div>
                    </div>
                       <div class="col-md-4 col-sm-4 col-xs-12 form-group pull-right top_search">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group top_search" style="padding-left: 100px;">
                            <div class="input-group">
                                <a href="{{route('sales.return')}}" class="btn btn-success">Sales Return</a>
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
		  <div class="container">
		  <ul class="nav nav-tabs">
		    <li class="active"><a data-toggle="tab" href="#cash_sale">Cash Sale</a></li>
		    <li><a data-toggle="tab" href="#credit_sale">Credit Sale</a></li>
		  </ul>

		  <div class="tab-content">
			    <div id="cash_sale" class="tab-pane fade in active">
			      <p>
			      	@if (Session::has('message'))
					   <div class="alert alert-info">{{ Session::get('message') }}</div>
					@endif
			      

					<table class="table table-dark" id="cashTable">
					  <thead>
					    <tr>
					      <th scope="col">S.L</th>
					      <th scope="col">Invoice No.</th>
					      <th scope="col">Seller</th>
					      <th scope="col">Customer</th>
					      <th scope="col">Product</th>
					      <th scope="col">Quantity</th>
					      <th scope="col">Total Price</th>
					      <th scope="col">Date</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
						  	<?php
							  $sales = DB::table('sales')
							  		
						            ->join('customers', 'customers.id', '=', 'sales.customer_id')
                                    ->join('products', 'products.id', '=', 'sales.product_id')
						            ->select('sales.*','products.name as prod_name','customers.name as cust_name')
						            ->where('sales.comp',session()->get('comp'))
						            ->orderBy('id', 'asc')
							        ->get();
					        foreach ($sales as $key => $sales) {?>
					    <tr>
					          <th scope="row"><?php echo $key++ + 1;?></th>
					          <td><?php echo $sales->id;?></td>
					          <td><?php echo $sales->saller_name;?></td>
					          <td><?php echo $sales->cust_name;?></td>
					          <td><?php echo $sales->prod_name;?></td>
					          <td><?php echo $sales->quantity;?></td>
					           <td><?php echo $sales->price;?></td>

					            <td><?php echo $sales->sales_date;?></td>


					  

					        
					          <td>

					           <div class="row">
                                                <div class="col-md-4">
                                                    <a href="{{route('sales.edit',$sales->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                                </div>
                                                <div class="col-md-4">
                                                    <form action="{{route('sales.delete',$sales->id)}}" method="post">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{ csrf_field()}}
                                                        <button class="btn btn-danger" type="submit" onclick= "return confirm('are you sure to delete?')"><i class="fa fa-trash-o"></i> Delete</button>
                                                    </form>
                                                </div>
                                            </div>
					          </td>
					    </tr>
					    <?php }?>
					  </tbody>
					</table>
				  </p>
			    </div>



			    <div id="credit_sale" class="tab-pane fade">
			      <p>
			      	@if (Session::has('message'))
					   <div class="alert alert-info">{{ Session::get('message') }}</div>
					@endif
			      
			      	<table class="table table-dark" id="creditTable">
					  <thead>
					    <tr>
					      <th scope="col">S.L</th>
					      <th scope="col">Invoice No.</th>
					      <th scope="col">Seller</th>
					      <th scope="col">Customer</th>
					      <th scope="col">Product</th>
					      <th scope="col">Quantity</th>
					      <th scope="col">Total Price</th>
					      <th scope="col">Paid Amount</th>
					      <th scope="col">Due Amount</th>
					      <th scope="col">Date</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
						  	<?php
							 $creditsale = DB::table('creditsales')
							 ->join('customers', 'customers.id', '=', 'creditsales.customer_id')
				             ->join('products', 'products.id', '=', 'creditsales.product_id')
				             ->select('creditsales.*', 'customers.name as cust_name','products.name as prod_name')
				             ->where('creditsales.comp',session()->get('comp'))
				             ->orderBy('id', 'asc')
				        	 ->get();
					        foreach ($creditsale as $key => $creditsale) {?>
					    <tr>
					          <th scope="row"><?php echo $key++ + 1;?></th>
					           <td><?php echo $creditsale->id;?></td>
					          <td><?php echo $creditsale->saller_name;?></td>
					          <td><?php echo $creditsale->cust_name;?></td>
					          <td><?php echo $creditsale->prod_name;?></td>
					          <td><?php echo $creditsale->quantity;?></td>
					          <td><?php echo $creditsale->price;?></td>
					          <td><?php echo $creditsale->paidamount;?></td>
					          <td><?php echo $creditsale->dueamount;?></td>
					          <td><?php echo $creditsale->sales_date;?></td>
					       
					  
					          <td>
					          	 <div class="row">
                                                <div class="col-md-3">
                                                    <a href="{{route('creditsale.edit',$creditsale->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i> Edit</a>
                                                </div>
                                             {{--   <div class="col-md-3">
                                                    <form action="{{route('sales.delete',$sales->id)}}" method="post">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        {{ csrf_field()}}
                                                        <button class="btn btn-danger" type="submit" onclick= "return confirm('are you sure to delete?')"><i class="fa fa-trash-o"></i> Delete</button>

                                                    </form>
                                                </div> --}}
                                               <div class="col-md-3"></div>
                                                 <div class="col-md-3">
                                                   <a href="{{route('creditsale.paydue',$creditsale->id)}}" class="btn btn-info"><i class="fa fa-check-circle"></i> Pay due</a>
                                                </div>
                                            </div>
					      

					          </td>
					    </tr>
					    <?php }?>
					  </tbody>
					</table>
			      </p>
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
    $('#cashTable').DataTable();
     $('#creditTable').DataTable();
} );
    </script>

@endsection
