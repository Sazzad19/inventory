<?php

namespace App\Http\Controllers\backend;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class EmployeeController extends Controller
{
     public function index()
  {

      $this->checkpermission('employee_management');
      $employee = Employee::where('comp',session()->get('comp'))->orderBy('name', 'asc')->get();



      return view('backend.employee.list', compact('employee'));
  }

  public function create()
  {
     

      return view('backend.employee.create');
  }

  public function store(Request $request)
  {
      $this->validate($request, [
          'name' => 'required',
          'address' => 'required',
          'phonenumber' => 'required',
          'salary' => 'required',
          
      ]);
      $employee = Employee::create([
          'name' => $request->name,
          'address' => $request->address,
          'phone_number' => $request->phonenumber,
          'salary' => $request->salary,
          
          'comp' => session()->get('comp'),
          'created_by' => Auth::user()->username,
          'created_at' => date('Y-m-d H:i:s'),
      ]);
      if ($employee) {

          return redirect()->route('employee.list')->with('success_message', 'Employee is successfully created');
      } else {
          return redirect()->route('employee.create')->with('error_message', 'Con not create rignt now');
      }
  }

  public function edit($id)
  {
    
      $employee = Employee::find($id);

      return view('backend.employee.edit', compact('employee'));
  }

  public function update(Request $request, $id)
  {
    $this->validate($request, [
          'name' => 'required',
          'address' => 'required',
          'phone_number' => 'required',
          'salary' => 'required',
    ]);
      $pc = Employee::find($id);
      $pc->name = $request->name;
      $pc->address = $request->address;
      $pc->phone_number = $request->phone_number;
      $pc->salary = $request->salary;
      
      $pc->modified_by = Auth::user()->username;
      $pc->updated_at = date('Y-m-d H:i:s');
      $message = $pc->update();
      if ($message) {
          return redirect()->route('employee.list')->with('success_message', 'successfully updated');
      } else {
          return redirect()->route('employee.update')->with('error_message', 'failed to  update');
      }
  }

  public function destroy($id)
  {
    $check = $this->checkpermission('employee-delete');
    if ($check) {
        $this->checkpermission('employee-delete');
    } else {
        $employee= Employee::find($id);
        $message = $employee->delete();
        if ($message) {
            return redirect()->route('employee.list')->with('success_message', 'successfully Deleted');
        } else {
            return redirect()->route('employee.list')->with('error_message', 'failed to  Delete');
        }
    }
  }
}
