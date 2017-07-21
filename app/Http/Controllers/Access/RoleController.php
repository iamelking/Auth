<?php

namespace App\Http\Controllers\Access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use DB;

class RoleController extends Controller
{
   
    public function index(Request $request)
    {
    	// $roles = Role::latest()->get();
    	// // $permissions = Permission::all();

    	// return view('crud.index',compact('roles'))
     //    ->with('i', ($request->input('page', 1) - 1) * 5);
         $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('role.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(){
    	$permissions = Permission::all();
    	return view('role.create',compact('permissions'));
    }

    public function store(Request $request)
    {
    	$role = new Role();
    	$role->name = $request->name;
    	$role->display_name =$request->display_name;
    	$role->description =$request->description;
    	$role->save();

    	 foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        $message = $request->session()->flash('success','Data successfully Added!');
        return redirect()->route('role.index')->with($message);

    }

    public function show(){
        // $role = Role::find($id);
        // $rolePermissions = Permission::join("permission_role","permission_role.permission_id","=","permissions.id")
        //     ->where("permission_role.role_id",$id)
        //     ->get();

        // return view('roles.show',compact('role','rolePermissions'));
    }
    public function edit($id)
    {
        $roles = Role::find($id);
        $permissions = Permission::all();
        // $role_permissions = $roles->permissions->pluck('id','id')->toArray();
        $role_permissions = DB::table("permission_role")->where("permission_role.role_id",$id)
        ->pluck('permission_role.permission_id','permission_role.permission_id')->toArray();

        // dd($role_permissions);

       
        return view('role.edit',compact('roles','permissions','role_permissions'));
    }
    public function update(Request $request , $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        DB::table('permission_role')->where('permission_role.role_id',$id)->delete();

        foreach ($request->input('permission') as $key => $value) {
            $role->attachPermission($value);
        }

        $message = $request->session()->flash('success','Roles was Successfully updated!');
        return redirect()->route('role.index')->with($message);
    }

    public function destroy($id)

    {
        // Role::find($id)->delete(); 
        DB::table("roles")->where('id',$id)->delete();
        

        $message = Session()->flash('success','Roles was Successfully Deleted!');
        return redirect()->route('role.index')->with($message);

    }
}
