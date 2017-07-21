<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Hash;
use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct(){
        $this->middleware('auth');
    }
    public function index()
    {
         $users = User::latest()->get();
         return view('users.user',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user =  User::create($input);

        foreach ($request->input('role') as $key => $value) {
            $user->attachRole($value);
        }

        $message = Session()->flash('success','successfully added');

        return redirect()->route('user.index')->with($message);
        // return dd($user);
        // return response()->json($message);
        // $input = $request->all();
        // $input['password'] = Hash::make($input['password']);

        // $user = User::create($input);
        // foreach ($request->input('roles') as $key => $value) {
        //     $user->attachRole($value);
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $user_roles = $user->roles->pluck('id','id')->toArray();

        // dd($user_roles);
        return view('users.edit',compact('user','roles','user_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        DB::table('role_user')->where('user_id',$id)->delete();

        foreach ($request->input('role') as $key => $value){
            $user->attachRole($value);
        }


        $message = Session()->flash('success','Data was successfully updated!');
        return redirect()->route('user.index')->with($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        DB::table('role_user')->where('user_id',$id)->delete();

        $message = Session()->flash('success','User was successfully deleted!');
        return redirect()->back()->with($message);
        // return "delete";
    }
}
