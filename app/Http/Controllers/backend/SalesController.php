<?php

namespace App\Http\Controllers\backend;
use Redirect;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Salescart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
use App\Models\Customer;
use App\Models\Creditsale;
use PDF;

class SalesController extends Controller
{
    public function index()
                {


                    return view('backend.sales.index');
                }
     public function sales_report()
                {

                     $sales=Sale::join('products', 'products.id', '=', 'sales.product_id')
                        ->select('sales.*','products.name as prod_name')
                         ->where('sales.comp',session()->get('comp'))
                        ->orderBy('id', 'asc')
                      ->get();
                    return view('backend.sales.list', compact('sales'));
                }

    public function add_cash_sale(Request $request)
                {

                    if($_REQUEST['product']>=1)
                    {
                       $Product_Price=DB::table('products')
                       ->select('price','name')
                       ->where('id',$_REQUEST['product'])
                       ->first();
                     }
                    $Product_Name=$Product_Price->name;
                    $Product_Price=$Product_Price->price;

                    if($_REQUEST['quantity']>=1)
                    {
                        $Product_Price_Total= $Product_Price * $_REQUEST['quantity'];
                    }

                    $Seller_Name= Auth::user()->name;

                    $add_cash_saler=DB::insert("insert into cash_sale(product_name,saller_name,customer_name,quantity,total_price) value(?,?,?,?,?)",[$Product_Name,$Seller_Name,$request->input('customer_name'),$request->input('quantity'),$Product_Price_Total]);
                    if ($add_cash_saler)
                    {
                     Session::flash('message', "Sale is added Successfuly");
                     return Redirect::back();
                    }
                    else
                    {
                     Session::flash('message', "Something went Wrong");
                     return Redirect::back();
                    }

                }

    public function add_credit_sale(Request $request)
                {

                    if($_REQUEST['product']>=1)
                    {
                       $Product_Price=DB::table('products')
                       ->select('price','name')
                       ->where('id',$_REQUEST['product'])
                       ->first();
                     }
                    $Product_Name=$Product_Price->name;
                    $Product_Price=$Product_Price->price;

                    if($_REQUEST['quantity']>=1)
                    {
                        $Product_Price_Total= $Product_Price * $_REQUEST['quantity'];
                    }

                    $Seller_Name= Auth::user()->name;

                    $add_credit_saler=DB::insert("insert into credit_sale(product_name,saller_name,customer_id,quantity,total_price) value(?,?,?,?,?)",[$Product_Name,$Seller_Name,$request->input('customer_id'),$request->input('quantity'),$Product_Price_Total]);
                    if ($add_credit_saler)
                    {
                     Session::flash('message', "Sale is added Successfuly");
                     return Redirect::back();
                    }
                    else
                    {
                     Session::flash('message', "Something went Wrong");
                     return Redirect::back();
                    }

                }

    public function create()
    {
        $this->checkpermission('sales-create');
        $salescart = Salescart::all();
        $customer=Customer::all();
        return view('backend.sales.create', compact('salescart', 'customer'));
    }

    public function edit($id)
    {
       
        $sale = Sale::find($id);
        $oldquantity=  $sale->quantity;
   

     
        return view('backend.sales.edit', compact('sale','oldquantity'));
    }
public function update(Request $request, $id)
  {
        $this->validate($request, [
         
            'sales_quantity' => 'required',
            'oldquantity' => 'required',
             'bonus' => 'required',
              'discount' => 'required',
               'commission' => 'required',
         
         
    ]);
$sale=Sale::find($id);
$product=Product::find($sale->product_id);
$product->stock=$product->stock+$request->oldquantity;
$product->update();
  $sale->quantity = $request->sales_quantity;
           $disprice= ($product->price * $request->sales_quantity)-$request->discount;
           if($request->commission <= 0){
            $sale->price= $disprice;
           }
           else{
            $sale->price= $disprice-$disprice*($request->commission/100);
           }
             if ($sale->update()) {
             
                $product->stock = $product->stock -( $request->sales_quantity+$request->bonus);
                if ($product->update()) {
                  return redirect()->route('sales.index')->with('success_message', 'successfully updated');
                }
                else {
          return redirect()->route('sales.index')->with('error_message', 'failed to  update');
      }


  }
}

  public function destroy($id)
  {
    $check = $this->checkpermission('sale-delete');
    if ($check) {
        $this->checkpermission('sale-delete');
    } else {
        $sale= Sale::find($id);
        $message = $sale->delete();
        if ($message) {
            return redirect()->route('sales.index')->with('success_message', 'successfully Deleted');
        } else {
            return redirect()->route('sales.index')->with('error_message', 'failed to  Delete');
        }
    }
  }


    public function store(Request $request)
    {
        $this->validate($request, [
            'customer_id' => 'required',
            'product_id' => 'required',
            'price' => 'required',
            'sales_quantity' => 'required',
            'bonus' => 'required',
            'discount' => 'required',
            'commission' => 'required',

            
        ]);
        if ($request->ajax()) {
            $sales = new Salescart();
            $sales->customer_id = $request->customer_id;
            $sales->product_id = $request->product_id;
            $sales->quantity = $request->sales_quantity;
            $sales->comp = session()->get('comp');
           $disprice= ($request->price * $request->sales_quantity)-$request->discount;
           if($request->commission <= 0){
            $sales->price= $disprice;
           }
           else{
            $sales->price= $disprice-$disprice*($request->commission/100);
           }

            $sales->saller_name = Auth::user()->username;
            $sales->sales_date = date('Y-m-d');
            if ($sales->save()) {
                $product = Product::find($request->product_id);
                $product->stock = $product->stock -( $request->sales_quantity+$request->bonus);
                if ($product->update()) {
                    return response(['success_message' => 'SuccessFully Make sales']);
                }
            }

        } else {
            return response(['error_message' => 'Filed To Make sales']);
        }
    }


    public function sales_return()
    {

          return view('backend.sales.sales_return');

    }

    public function product_exchange(Request $request)
    {
        $this->validate($request, [
            'sale_id' => 'required',
            'product_id' => 'required',
            'price' => 'required',
            'sales_quantity' => 'required',
        ]);

            $sales = Sale::find( $request->sale_id);
            $product = Product::find($sales->product_id );
            $product->stock=  $product->stock+  $sales->quantity;
            if($product->update()){

            $sales->product_id = $request->product_id;
            $sales->quantity = $request->sales_quantity;
            $sales->price = $request->price * $request->sales_quantity;
              if($sales->update()){
                $product = Product::find($request->product_id);
                $product->stock = $product->stock - $request->sales_quantity;
                if ($product->update()) {
                  Session::flash('success_message', "SuccessFully Exchange Product");
                   return redirect()->back();
                }
                else {
                  Session::flash('error_message', "Failed to Exchange Product");
                   return redirect()->back();
                }

              }

    }
}
  public function storepaydue(Request $request,$id)
  {
      $this->validate($request, [
           
            'payingamount' => 'required',
        ]);
            $creditsale = Creditsale::find($id);
            $customer= Customer::find($creditsale->customer_id);
            $customer->due_amount =  $customer->due_amount- $request->payingamount;
            $creditsale->dueamount = $creditsale->dueamount- $request->payingamount;
            $creditsale->paidamount = $creditsale->paidamount+$request->payingamount;
            $creditsale->update();
            $customer->update();

    
    

if($creditsale->dueamount<=0){
      $sale=new Sale();

     $sale->customer_id= $creditsale->customer_id;

     $sale->product_id= $creditsale->product_id;

     $sale->quantity= $creditsale->quantity;

     $sale->price= $creditsale->price;
      $sale->comp= $creditsale->comp;
     $sale->saller_name= $creditsale->saller_name;
     $sale->sales_status= $creditsale->sales_status;
     $sale->sales_date= $creditsale->sales_date;

     if($sale->save()&&$creditsale->delete()){
                  
           return Redirect::route('sales.index')->with('message','Credit sale is cleared & add to sale Successfuly');
       }
    else{
                     Session::flash('message', "Credit sale is cleared & add to sale Failed");
                     return Redirect::back();

    }
  }
  else{
     Session::flash('success_message', "Successfuly Paid");
                     return Redirect::back();
  }
  }
  public function paydue($id)
  {
    
        $creditsale=Creditsale::find($id);
        return view('backend.sales.paydue', compact('creditsale'));
  }

    public function return_payment(Request $request)
    {
        $this->validate($request, [
            'sale_id' => 'required',

        ]);

            $sales = Sale::find( $request->sale_id);
            $product = Product::find($sales->product_id );
            $product->stock=  $product->stock+  $sales->quantity;
            if($product->update()){
              if($sales->delete()){
                Session::flash('success_message', "SuccessFully Return Payment");
                 return redirect()->back();
              }
              else {
                Session::flash('error_message', "Failed to Return Payment");
                 return redirect()->back();
              }
            }


}


    public function pay_due(Request $request)
    {
        $this->validate($request, [
            'sale_id' => 'required',
            'customer_id' => 'required',


        ]);

            $sales = Sale::find( $request->sale_id);
            $product = Product::find($sales->product_id );
            $customer = Customer::find($request->customer_id );
            if($sales->price <=   $customer->due_amount){

              $customer->due_amount=   $customer->due_amount-$sales->price;
              $product->stock=  $product->stock+  $sales->quantity;
              if($customer->update() && $product->update()){
                if($sales->delete()){
                  Session::flash('success_message', "SuccessFully Pay Due");
                   return redirect()->back();
                }
                else {
                  Session::flash('error_message', "Failed to Pay Due");
                   return redirect()->back();
                }

              }
            }
            else{

              $sales->price= $sales->price -$customer->due_amount;
              $customer->due_amount= 0;
              $product->stock=  $product->stock+  $sales->quantity;
              if($sales->update() && $product->update() && $customer->update()){
                Session::flash('success_message', "SuccessFully Pay Due");
                 return redirect()->back();
              }
              else {
                Session::flash('error_message', "Failed to Pay Due");
                 return redirect()->back();
              }
            }

}

    public function credit_store(Request $request)
    {
  $this->validate($request, [
            'customer_id' => 'required',
            'product_id' => 'required',
            'price' => 'required',
            'sales_quantity' => 'required',
            'paid_amount' => 'required',
            'bonus' => 'required',
            'discount' => 'required',
            'commission' => 'required',



        ]);

          $sales = new Creditsale();
          $sales->customer_id = $request->customer_id;
          $sales->product_id = $request->product_id;
          $sales->quantity = $request->sales_quantity;
          $sales->paidamount = $request->paid_amount;
          $sales->comp = session()->get('comp');

          $sales->dueamount = $request->price * $request->sales_quantity-$request->paid_amount;
             $disprice= ($request->price * $request->sales_quantity)-$request->discount;
           if($request->commission <= 0){
            $sales->price= $disprice;
            $sales->dueamount = $disprice-$request->paid_amount;
           }
           else{
            $commprice=$disprice-$disprice*($request->commission/100);
            $sales->dueamount = $commprice-$request->paid_amount;
            $sales->price= $commprice;

           }

          $sales->saller_name = Auth::user()->username;
          $sales->sales_date = date('Y-m-d');
          if ($sales->save()) {
              $product = Product::find($request->product_id);
              $product->stock = $product->stock -( $request->sales_quantity+$request->bonus);
              $customer = Customer::find($request->customer_id);
              $customer->due_amount = $customer->due_amount + $sales->dueamount;
              if ($product->update() && $customer->update() ) {
                 Session::flash('success_message', "SuccessFully Make sales");
                  return redirect()->back();
              }
          }

   else {
                     Session::flash('error_message', "Failed  to Make sales");
                  return redirect()->back();
      }

         // print_r($_REQUEST['products']);


              //  $credit_store=DB::insert("insert into credit_sale(product,price,sales_quantity) value(?,?,?)",[$request->input('products'),$request->input('price'),$request->input('sales_quantity')]);
                //if ($credit_store) {
                //     return Redirect::back()->withErrors(['A Semester has been created successfully ']);
                    // return response(['success_message' => 'SuccessFully Make sales']);
          //      }


        //         if ($product->update()) {
        //             return response(['success_message' => 'SuccessFully Make sales']);
        //         }
        //     }

        // } else {
        //     return response(['error_message' => 'Filed To Make sales']);
        // }

    }

public function credit_edit($id)
    {
       $creditsale = Creditsale::find($id);
     
        return view('backend.sales.creditedit', compact('creditsale'));

    }
    public function credit_update(Request $request, $id)
  {

     $this->validate($request, [
         
            'sales_quantity' => 'required',
         
             'bonus' => 'required',
              'discount' => 'required',
               'commission' => 'required',
               'paid_amount' => 'required',
         
         
    ]);
      $creditsale = Creditsale::find($id);
      $product=Product::find($creditsale->product_id);
       $customer = Customer::find($creditsale->customer_id);
      $product->stock=$product->stock+$creditsale->quantity;
      $customer->due_amount = $customer->due_amount - $creditsale->dueamount;

      $product->update();
      $creditsale->quantity = $request->sales_quantity;
       $creditsale->paidamount = $request->paid_amount;
           $disprice= ($product->price * $request->sales_quantity)-$request->discount;
           if($request->commission <= 0){
            $creditsale->price= $disprice;
            $creditsale->dueamount = $disprice-$request->paid_amount;
           }
           else{
             $commprice=$disprice-$disprice*($request->commission/100);
            $creditsale->dueamount = $commprice-$request->paid_amount;
            $creditsale->price= $commprice;
           }
             if ($creditsale->update()) {
                $customer->due_amount = $customer->due_amount + $creditsale->dueamount;
                $product->stock = $product->stock -( $request->sales_quantity+$request->bonus);
                if ($product->update() && $customer->update()) {
                  return redirect()->route('sales.index')->with('success_message', 'successfully updated');
                }
                else {
          return redirect()->route('sales.index')->with('error_message', 'failed to  update');
      }


  }

    }


    public function ajaxlist()
    {
        $sales = Salescart::join('products', 'products.id', '=', 'salescarts.product_id')

            ->select('salescarts.*', 'products.name')
            -> where('salescarts.comp',session()->get('comp'))
            ->orderBy('salescarts.created_at', 'DEC')

            ->get();
        return view('backend.sales.ajaxlist', compact('sales'));
    }

    public function ajaxform() 
    {
        $salescart = Salescart::where('comp',session()->get('comp'))->get(); 
        return view('backend.sales.ajaxform', compact('salescart'));
    }

    public function refreshproduct()
    {
        $product = Product::where('stock', '>=', 1)->where('comp',session()->get('comp'))->get();
        return view('backend.sales.refreshproduct', compact('product'));
    }
    public function refreshsale()
    {
      $sale = Sale::join('products', 'products.id', '=', 'sales.product_id')
          ->select('sales.*','products.name')
          ->where('sales.comp',session()->get('comp'))
          ->get();
        return view('backend.sales.refreshsale', compact('sale'));
    }

    public function refreshcustomer()
    {
      $customer= Customer::where('comp',session()->get('comp'))->get();
        return view('backend.sales.refreshcustomer', compact('customer'));
    }

    public function getquantity(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo $product[0]->stock;

    }
   public function getquantityedit(Request $request)
    {
        $product = Product::where('id', $request->product_id1)->get();
        echo $product[0]->stock;

    }
    public function getprice(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo $product[0]->price;
    }

    public function getsaleprice(Request $request)
    {
        $sale = Sale::where('id', $request->sale_id)->get();
        echo $sale[0]->price;
    }
    public function getproductname(Request $request)
    {
        $product = Product::where('id', $request->product_id)->get();
        echo $product[0]->name;
    }
    public function getcustomerdue(Request $request)
    {
        $customer = Customer::where('id', $request->customer_id)->get();
        echo $customer[0]->due_amount;
    }
    public function getallpdf()
    {
        $report = Salescart::join('products', 'products.id', '=', 'salescarts.product_id')
            ->select('salescarts.*', 'products.name')
            ->where('salescarts.comp',session()->get('comp'))
             ->get();
        return view('backend.pdfbill.salesbill', compact('report')); 
    }


    public function getdatereport(Request $request)
    {
      if($request->ajax()){
        $start = $request->start;
        $end = $request->end;
        $report = Sale::join('products', 'products.id', 'sales.product_id')
            ->select('sales.*', 'products.name')
            -> where('sales.comp',session()->get('comp'))
            ->whereBetween('sales.sales_date', [$start, $end])
            ->get();
             return view('backend.pdfbill.allreport', compact('report', 'start', 'end'));
        //$pdf = PDF::loadview('backend.pdfbill.allreport', compact('report', 'start', 'end'));
        //return $pdf->download('salesreport.pdf');
      }
    }


      public function getcustomerreport(Request $request)
    {
      if($request->ajax()){
        $code = $request->code;
        $customer=Customer::where('code_number',  $code)->first();
                $report = Sale::join('products', 'products.id', 'sales.product_id')
            ->join('customers', 'customers.id', 'sales.customer_id') 
            ->select('sales.*', 'products.name as prod_name')
            -> where('sales.comp',session()->get('comp'))
            ->where('customers.code_number',  $code)
            ->get();
             return view('backend.pdfbill.custreport', compact('report','customer'));
        //$pdf = PDF::loadview('backend.pdfbill.allreport', compact('report', 'start', 'end'));
        //return $pdf->download('salesreport.pdf');
      }
    }

          public function getproductreport(Request $request)
    {
      if($request->ajax()){
        $code = $request->code;
        $product=Product::where('code',  $code)->first();
                $report = Sale::join('products', 'products.id', 'sales.product_id')
            ->join('customers', 'customers.id', 'sales.customer_id') 
            ->select('sales.*', 'customers.name as cust_name',)
            -> where('sales.comp',session()->get('comp'))
            ->where('products.code',  $code)
            ->get();
             return view('backend.pdfbill.prodreport', compact('report','product'));
        //$pdf = PDF::loadview('backend.pdfbill.allreport', compact('report', 'start', 'end'));
        //return $pdf->download('salesreport.pdf');
      }
    }


    public function savetosales(Request $request)
    {
        for ($i = 0; $i < $request->input('total_product'); $i++) {
            $od = [
               'customer_id' => $request['customer_id'][$i],
                'product_id' => $request['product_id'][$i],
                'quantity' => $request['quantity'][$i],
                'price' => $request['price'][$i],
                'sales_status' => $request['sales_status'][$i],
                'saller_name' => Auth::user()->username,
                 'comp' => $request['comp'][$i],
                'sales_date' => date('Y-m-d'),
               

            ];
            Sale::create($od);
        }
        $salescarts=Salescart::where('comp',session()->get('comp'))->get();
        foreach ($salescarts as $salescart) {
          $salescart->delete();
        }
  
       // DB::table('salescarts')->delete();
        return redirect()->back()->with('success_message', 'Successfuly Clear Your Bucket and Sales Item store in Sales Record');

    }

    public function deletecart($id, $pid)
    {
        $product = Product::find($pid);
        $salescart = Salescart::find($id);
        $product->stock = $product->stock + $salescart->quantity;
        if ($product->update()) {
            $salescart->delete();
            return redirect()->back()->with('success_message', 'Seccessfully deleted Item');
        }else {
            return redirect()->back()->with('error_messsage', 'Failed To Delete Item');
        }
    }
}
