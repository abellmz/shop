<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleRequest;
use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function Sodium\add;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        检测是否有角色管理的权限（角色管理目前只有站长有这个权利）
        admin_has_permission('Admin-role');

        $roles = Role::paginate(10);
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
//    添加角色
    public function create()
    {
        admin_has_permission('Admin-role');
        return view('admin.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
//    保存添加的角色
    public function store(RoleRequest $request, Role $role)
    {
        admin_has_permission('Admin-role');
//        dd($role->toArray());//guard_name
        $role->title = $request->title;
        $role->name = $request->name;
        $role->guard_name = 'admin';//默认web
        $role->save();
        return redirect()->route('admin.role.index')->with('success', '角色添加成功');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module $module
     * @return \Illuminate\Http\Response
     */
//    角色权限展示
    public function show(Role $role)
    {
        admin_has_permission('Admin-role');
        $modules = Module::all();
        return view('admin.role.set_role_permission', compact('modules', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module $module
     * @return \Illuminate\Http\Response
     */
//    编辑角色 中英文民称
    public function edit(Request $request,Role $role)
    {
        admin_has_permission('Admin-role');
        return view('admin.role.edit',compact('role'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Module $module
     * @return \Illuminate\Http\Response
     */
//    保存更新的角色 中英文名称
    public function update(RoleRequest $request, Role $role)
    {
        admin_has_permission('Admin-role');
        if (!auth('admin')->user()->can('update',$role)){
            return redirect()->back()->with('danger','权限不够');
        }
        $role->title=$request->title;
        $role->name =$request->name;
        $role->save();
        return redirect()->route('admin.role.index')->with('success','角色编辑成功');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module $module
     * @return \Illuminate\Http\Response
     */
//    删除角色
    public function destroy(Role $role)
    {
        admin_has_permission('Admin-role');
        if(!auth('admin')->user()->can('delete',$role)){
            return redirect()->back()->with('success','权限不够哦');
        }
        $role->delete();//删除该条角色
        return redirect()->route('admin.role.index')->with('success','角色删除成功');
    }
//角色权限设置保存
    public function setRolePermission(Role $role, Request $request)
    {
        admin_has_permission('Admin-role');
//        dd(1);
//        dd(auth('admin')->user()->can('delete',$role));//can（）最终放回true或者false
        //两个参数：第一个->策略中的方法	第二个->1、调用模型2、传递的参数
//        判断该管理员是否能够删除该角色，能删除则能赋予
        if (!auth('admin')->user()->can('delete',$role)){
            return redirect()->back()->with('danger','权限不够用');
        }
        $role->syncPermissions($request->permissions);
//        dd($request->toArray());
        return back()->with('success','操作成功');
    }
}
