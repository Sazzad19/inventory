<?php

namespace App\Http\Controllers\backend;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\RoleModule;
use App\Models\Product;
use Carbon;
class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $this->checkpermission('module-list');
        $module = Module::orderBy('name', 'asc')->paginate(10);



        return view('backend.module.list', compact('module'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkpermission('module-create');
        $role = Role::all();
        return view('backend.module.create', compact('role'));
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
            'name' => 'required',
            'module_key' => 'required|unique:modules',
            'module_url' => 'required',
            'module_rank' => 'required',

        ]);
        $module = Module::create([
            'name' => $request->name,
            'module_key' => $request->module_key,
            'module_url' => $request->module_url,
            'view_sidebar' => $request->view_sidebar,
            'module_icon' => $request->module_icon,
            'module_rank' => $request->module_rank,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        if ($module) {
            foreach ($request->roles as $role) {
                $rolemodule = new RoleModule();
                $rolemodule->module_id = $module->id;
                $rolemodule->role_id = $role;
                $rolemodule->save();
            }
            return redirect()->route('module.list')->with('success_message', 'You are successfully created');
        } else {
            return redirect()->route('module.create')->with('error_message', 'You con not create rignt now');
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

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

       $module = Module::find($id);
       $role = Role::all();
       $currentrole = RoleModule::where('module_id',$module->id)->get();
       return view('backend.module.edit',compact('module','role','currentrole'));
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
            'name' => 'required',
            
         
            'module_rank' => 'required',
        ]);
       $pc = Module::find($id);
      
      $pc->name = $request->name;
      $pc->module_rank = $request->module_rank;
      $pc->module_icon = $request->module_icon;
      $pc->view_sidebar = $request->view_sidebar;
      $message = $pc->update();
        if ($message) {
                 $data['module_id'] = $id;
                $rp = RoleModule::where('module_id', '=', $id)->get();
        foreach ($rp as $r) {
            $r->delete();
        }
        if (isset($request->roles)) {
            foreach ($request->roles as $p) {
                $data['role_id'] = $p;
                RoleModule::create($data);
            }
        }

            return redirect()->route('module.list')->with('success_message', 'Successfully Updated');
        } else {
            return redirect()->route('module.list')->with('error_message', 'Failed to Update');
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
             $check = $this->checkpermission('module-delete');
        if ($check) {
            $this->checkpermission('module-delete');
        } else {
            $module = Module::find($id);
            $rolemodule=RoleModule::where('module_id',$module->id)->get();
            $message = $module->delete();
            if ($message) {
                  foreach ($rolemodule as $rm) {
                $rm->delete();
                }
                return redirect()->route('module.list')->with('success_message', 'successfully Deleted');
            } else {
                return redirect()->route('module.list')->with('error_message', 'failed to  Delete');
            }
        } 


    }
}
