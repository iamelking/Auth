<?php

namespace App\Http\Controllers\Access;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perms = Permission::orderBy('id', 'DESC')->get();;
        return view('permissions.permission',compact('perms'));
    }

}
