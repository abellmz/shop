<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    管理员首页 - 管理员管理
    public function index()
    {
        admin_has_permission('Admin-index');
        $admins = Admin::paginate(5);
//        dd($admins);
        return view('admin.admin.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    添加管理员
    public function create()
    {
//        dd('2');
        admin_has_permission('Admin-index');
        return view('admin.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//    管理员信息存储
    public function store(Request $request,Admin $admin)
    {
        admin_has_permission('Admin-index');
        $admin->username=$request->username;
        $admin->password=bcrypt($request->password);
        $admin->save();
//        dd($admin->toArray());
        return redirect()->route('admin.admin.index')->with('success','管理员添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
//    编辑管理员账号和密码
    public function edit(Admin $admin)
    {
//        dd('1');
        admin_has_permission('Admin-index');
        return view('admin.admin.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
//    更新管理员账号和密码
    public function update(Request $request, Admin $admin)
    {
        admin_has_permission('Admin-index');
//        dd($request->toArray());
//        dd($admin->username);//和user类似，对应用户，进而更新
        $admin->username=$request->username;
        $admin->password=bcrypt( $request->password );
        $admin->save();
        return redirect()->route('admin.admin.index')->with('success','编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
//管理员设置角色
    public function adminSetRoleCreate(Admin $admin)
    {
        admin_has_permission('Admin-index');
        //获得所有角色
        $roles = Role::all();
        return view('admin.admin.set_role', compact('admin', 'roles'));
    }
//管理员角色保存
    public function adminSetRoleStore(Admin $admin,Request $request)
    {
        admin_has_permission('Admin-index');
//        dd($request->roles);
        $admin->syncRoles($request->roles);
        return back()->with('success','设置成功');
    }

}
