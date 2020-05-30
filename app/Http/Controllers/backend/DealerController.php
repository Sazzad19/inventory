<?php

namespace App\Http\Controllers\backend;

use App\Models\Dealer;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class DealerController extends Controller
{
    public function index()
  {

      $this->checkpermission('dealer-list');
    
     $dealer=Dealer::join('customers', 'customers.id', '=', 'dealers.customer_id')
        ->select('dealers.*','customers.name as cust_name','customers.district as cust_district','customers.phone_number as cust_phone')
          ->where('dealers.comp',session()->get('comp'))
        ->orderBy('id', 'asc')
      ->get();



      return view('backend.dealer.list', compact('dealer'));
  }

  public function create()
  {
      
    
      return view('backend.dealer.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
          'customer_id' => 'required',
          'area' => 'required',
          'selltarget' => 'required',
          
          
      ]);
      $dealer = Dealer::create([
          'customer_id' => $request->customer_id,
          'aria' => $request->area,
          'selltarget' => $request->selltarget,
        
          'comp' => session()->get('comp'),
        
          'created_at' => date('Y-m-d H:i:s'),
      ]);
      if ($dealer) {

            $customer=Customer::find($dealer->customer_id);
            $customer->customer_type=1;
            if($customer->update()){
          return redirect()->route('dealer.list')->with('success_message', 'Dealer is successfully created');
      }
      else {
          return redirect()->route('dealer.create')->with('error_message', 'Con not create rignt now');
      }
  }
  }

  public function edit($id)
  {
    
      $dealer = Dealer::find($id);

      return view('backend.dealer.edit', compact('dealer'));
  }



  public function update(Request $request, $id)
  {
    $this->validate($request, [
          'area' => 'required',
          'selltarget' => 'required',
     
    ]);
      $pc = Dealer::find($id);
      $pc->aria = $request->area;
      $pc->selltarget = $request->selltarget;
      
    
      $message = $pc->update();
      if ($message) {
          return redirect()->route('dealer.list')->with('success_message', 'successfully updated');
      } else {
          return redirect()->route('dealer.edit')->with('error_message', 'failed to  update');
      }
  }

  public function destroy($id)
  {
    $check = $this->checkpermission('dealer-delete');
    if ($check) {
        $this->checkpermission('dealer-delete');
    } else {
        $dealer= Dealer::find($id);
        $customer=Customer::find($dealer->customer_id);
         $customer->customer_type=0;

        $message = $dealer->delete();
        if ($message) {
            if($customer->update()){
            return redirect()->route('dealer.list')->with('success_message', 'Dealership successfully Deleted');
        }
        } else {
            return redirect()->route('dealer.list')->with('error_message', 'Failed to  Delete');
        }
    }
  }

      public function bonus($id)
  {
    
      $dealer = Dealer::find($id);

      return view('backend.dealer.bonus', compact('dealer'));
  }


  public function store_bonus(Request $request, $id)
  {
    $this->validate($request, [
          'bonus' => 'required',
        
     
    ]);
      $pc = Dealer::find($id);
      $ex=Expense::find(3);


      $sale=Sale::where('customer_id', $pc->customer_id)->get();
      $saleamount=0;
foreach ($sale as $sa) {
     $with=$sa->price;
      $saleamount+= $with;
}
      $amount =   $saleamount*($request->bonus/100);
    $pc->bonus_amount=$amount;
     $ex->totalamount= $ex->totalamount+ $amount;
      $ex->paidamount= $ex->paidamount+ $amount;
       $expense=$ex->update();
      $bonus = $pc->update();
      if ($bonus && $expense) {
          return redirect()->route('dealer.list')->with('success_message', 'successfully updated');
      } else {
          return redirect()->route('dealer.list')->with('error_message', 'failed to  update');
      }
  }
}
