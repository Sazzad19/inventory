<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
class CustomerController extends Controller
{
  public function index()
  {

      $this->checkpermission('customers-list');
      $customer = Customer::where('comp',session()->get('comp'))->orderBy('name', 'asc')->get();



      return view('backend.customers.list', compact('customer'));
  }

  public function create()
  {
      $this->checkpermission('customers-list');

      return view('backend.customers.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
          'name' => 'required',
          'district' => 'required',
          'phonenumber' => 'required',
          'codenumber' => 'required',
         

      ]);
      $customer = Customer::create([
          'name' => $request->name,
          'district' => $request->district,
          'phone_number' => $request->phonenumber,
          'code_number' => $request->codenumber,
          'customer_type' => $request->customer_type,
          'comp' => session()->get('comp'),
          'created_by' => Auth::user()->username,
          'created_at' => date('Y-m-d H:i:s'),
      ]);
      if ($customer) {

          return redirect()->back()->with('success_message', 'Customer successfully created');
      } else {
          return redirect()->back()->with('error_message', 'Failed to create');
      }
  }

  public function edit($id)
  {
      $this->checkpermission('customer-edit');
      $customer = Customer::find($id);

      return view('backend.customers.edit', compact('customer'));
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
        'name' => 'required',
        'district' => 'required',
        'phonenumber' => 'required',
        'codenumber' => 'required',
        'due_amount' => 'required',
    ]);
      $pc = Customer::find($id);
      $pc->name = $request->name;
      $pc->district = $request->district;
      $pc->phone_number = $request->phonenumber;
      $pc->code_number = $request->codenumber;
      $pc->due_amount = $request->due_amount;
      $pc->modified_by = Auth::user()->username;
      $pc->updated_at = date('Y-m-d H:i:s');
      $message = $pc->update();
      if ($message) {
          return redirect()->route('customer.list')->with('success_message', 'successfully updated');
      } else {
          return redirect()->route('customer.update')->with('error_message', 'failed to  update');
      }
  }

  public function destroy($id)
  {
    $check = $this->checkpermission('customer-delete');
    if ($check) {
        $this->checkpermission('customer-delete');
    } else {
        $customer= Customer::find($id);
        $message = $customer->delete();
        if ($message) {
            return redirect()->route('customer.list')->with('success_message', 'successfully Deleted');
        } else {
            return redirect()->route('customer.update')->with('error_message', 'failed to  Delete');
        }
    }
  }
}
