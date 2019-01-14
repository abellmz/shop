<?php

namespace App\Policies;

use App\Models\Admin;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function delete(Admin $admin, Role $role)
    {
//        dd('1');策略是需要注册的
        return $role['name'] != 'webmaster';//成立返回ture,否则false
    }

    public function update(Admin $admin,Role $role)
    {
        return $role['name']!='webmaster';
    }
}
