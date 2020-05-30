<?php

namespace App\Http\Controllers\backend;

use App\Models\Pettycash;
use App\Models\Preorder;
use App\Models\Product;
use App\Models\Expense;
use App\Models\Productcategory;
use App\Models\Sale;
use App\Models\Salescart;
use App\Models\Withdraw;
use App\Models\Creditsale;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon;
use Session;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //$birthday = Sale::whereMonth('sales_date', '=', date('m'))->whereDay('sales_date', '=', date('d')+1)->get();

        $salesamount = Sale::where('comp',session()->get('comp'))->get();
        $totalsaleamount = 0;
        if ($salesamount) {
            foreach ($salesamount as $w) {
                $with = $w->price;
                $totalsaleamount += $with;
            }
        }

        $creditsalespaid = Creditsale::where('comp',session()->get('comp'))->get();
        $totalcreditsalespaid = 0;
        if ($creditsalespaid) {
            foreach ($creditsalespaid as $w) {
                $with = $w->paidamount;
                $totalcreditsalespaid += $with;
            }
        }

            $creditsalesdue = Creditsale::where('comp',session()->get('comp'))->get();
        $totalcreditsalesdue = 0;
        if ($creditsalesdue) {
            foreach ($creditsalesdue as $w) {
                $with = $w->dueamount;
                $totalcreditsalesdue += $with;
            }
        }

        $purchasesamount = Purchase::where('comp',session()->get('comp'))->get();
        $totalpurchasesamount = 0;
        if ($purchasesamount) {
            foreach ($purchasesamount as $w) {
                $with = $w->paidamount;
                $totalpurchasesamount += $with;
            }
        }

            $purchasesamountdue = Purchase::where('comp',session()->get('comp'))->get();
        $totalpurchasedue = 0;
        if ($purchasesamountdue) {
            foreach ($purchasesamountdue as $w) {
                $with = $w->dueamount;
                $totalpurchasedue += $with;
            }
        }



             $expenseamount = Expense::where('comp',session()->get('comp'))->get();
        $totalexpenseamount = 0;
        if ($expenseamount) {
            foreach ($expenseamount as $w) {
                $with = $w->paidamount;
                $totalexpenseamount += $with;
            }
        }

               $expenseamountdue = Expense::where('comp',session()->get('comp'))->get();
        $totalexpenseamountdue = 0;
        if ($expenseamountdue) {
            foreach ($expenseamountdue as $w) {
                $with = $w->dueamount;
                $totalexpenseamountdue += $with;
            }
        }
        $totaldue_to_pay= $totalexpenseamountdue+$totalpurchasedue;

    

        if($totalsaleamount + $totalcreditsalespaid >= $totalpurchasesamount+ $totalexpenseamount) {
         // $status='Profit';
            Session::put('status','Profit');
          $amount=($totalsaleamount + $totalcreditsalespaid)-($totalpurchasesamount+ $totalexpenseamount);
          Session::put('amount',$amount);
        }
        else {
          //$status='Loss';
          Session::put('status','Loss');
          $amount=($totalpurchasesamount+ $totalexpenseamount) - ($totalsaleamount + $totalcreditsalespaid);
           Session::put('amount',$amount);
        }


        $creditsale = Creditsale::join('customers', 'customers.id', '=', 'creditsales.customer_id')
             ->join('products', 'products.id', '=', 'creditsales.product_id')
            ->select('creditsales.*', 'customers.name as cust_name','products.name as prod_name')
            ->where('creditsales.comp',session()->get('comp'))
            ->orderBy('id', 'asc')
            ->get();

        $creditpusrchase = Purchase::where('comp',session()->get('comp'))->where('dueamount','>',0)
            ->orderBy('id', 'asc')
            ->get();

        $productcategory = Productcategory::where('comp',session()->get('comp'))->get();




        return view('backend.dashboard.index', compact('totalsaleamount', 'totalcreditsalesdue', 'totalpurchasesamount', 'totaldue_to_pay','creditsale','creditpusrchase','productcategory'));
    }

        public function al_safa(Request $request)
    {
       
       $request->session()->put('comp','al_safa');
       $message=session()->get('comp');
    
       return redirect()->back();

    }

public function pioneer(Request $request)
    {
               $request->session()->put('comp','pioneer'); 
               $message=session()->get('comp');
            
               return redirect()->back();

    }

    public function safa(Request $request)
    {
               $request->session()->put('comp','safa'); 
               $message=session()->get('comp');
            
               return redirect()->back();

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
