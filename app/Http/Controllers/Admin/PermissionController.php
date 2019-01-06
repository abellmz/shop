<?php

namespace App\Http\Controllers\Admin;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index(){
        admin_has_permission('Admin-permission');
        $modules=Module::all();
//        dd('5');
        return view('admin.permission.index',compact('modules'));
    }

    public function forgetPermissionCache(){

    }
}
