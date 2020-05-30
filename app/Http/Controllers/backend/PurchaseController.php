<?php

namespace App\Http\Controllers\backend;

use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PDF;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkpermission('purchase-list');
        $rempurchase = Purchase::orderBy('created_at', 'DEC')->where('comp',session()->get('comp'))->where('dueamount', '>', 0)->get();
        $paidpurchase = Purchase::orderBy('created_at', 'DEC')->where('comp',session()->get('comp'))->where('dueamount', '<=', 0)->get();
        return view('backend.purchase.list', compact('paidpurchase', 'rempurchase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkpermission('purchase-create');
        return view('backend.purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'goods_name' => 'required',
            'party_name' => 'required',
            'totalamount' => 'required',
            'paidamount' => 'required',
        ]);
        $purchase = new Purchase();
        $purchase->goods_name = $request->goods_name;
        $purchase->party_name = $request->party_name;
        $purchase->totalamount = $request->totalamount;
        $purchase->paidamount = $request->paidamount;
        $purchase->dueamount = $request->totalamount - $request->paidamount;
        $purchase->comp = session()->get('comp');
        $purchase->status = $request->status;
        $purchase->purchase_date = date('Y-m-d H:i:s');
        $purchase->created_by = Auth::user()->username;
        $purchase->created_at = date('Y-m-d H:i:s');
        if ($purchase->save()) {
            return back()->with('success_message', 'Success Fully created');
        } else {
            return back()->with('error_message', 'Failed To create');
        }
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
      $purchase=Purchase::find($id);
        return view('backend.purchase.edit', compact('purchase'));
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
            $this->validate($request, [
           
            'payingamount' => 'required',
        ]);

        $check = $this->checkpermission('purchase-update');
        if ($check) {
            $this->checkpermission('purchase-update');
        } else {
            $purchase = Purchase::find($id);
            $purchase->dueamount = $purchase->dueamount- $request->payingamount;
            $purchase->paidamount = $purchase->paidamount+$request->payingamount;
            $purchase->update();
            return redirect()->route('purchase.list')->with('success_message', 'successfully paid');
        }
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

    public function export(Request $request)
    {
        $start = $request->start;
        $end = $request->end;
        $status = $request->status;
        if ($status == 'all'){
            $report = Purchase::orderBy('purchase_date','DEC')->whereBetween('purchase_date', [$start, $end])->get();
            $pdf = PDF::loadview('backend.pdfbill.purchasereport', compact('report', 'start', 'end'));
            if ($pdf){
                return $pdf->download('allpurchasereport.pdf');
            }
            return redirect()->back()->with('error_message', 'Can not Export Report');
        }else {
            $report = Purchase::orderBy('purchase_date','DEC')->whereBetween('purchase_date', [$start, $end])->where('status',[$status])->get();
            $pdf = PDF::loadview('backend.pdfbill.purchasereport', compact('report', 'start', 'end'));
            if ($pdf){
                return $pdf->download('purchasereport.pdf');
            }
            return redirect()->back()->with('error_message', 'Can not Export Report');
        }
    }

          public function purchasereport(Request $request) 
    {
     
        $start = $request->start;
        $end = $request->end;
         $report = Purchase::orderBy('purchase_date','DEC')->where('comp',session()->get('comp'))->whereBetween('purchase_date', [$start, $end])->get();
             return view('backend.pdfbill.purchasereport', compact('report', 'start', 'end'));
        //$pdf = PDF::loadview('backend.pdfbill.allreport', compact('report', 'start', 'end'));
        //return $pdf->download('salesreport.pdf');
     
    }
}
